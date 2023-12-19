@extends('adminlte::page')
@section('title', 'Presensi App')

@section('content_header')
    <h1>Presensi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ url('admin/presensi/cetak') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-5">
                        <select name="jenis" id="jenis" class="form-control float-right" onchange="changeJenis()"
                            required>
                            <option value="harian">Laporan Harian</option>
                            <option value="bulanan">Laporan Bulanan</option>
                        </select>
                    </div>
                    <div class="col-5" id="col-waktu">
                        <input type="date" name="waktu" id="waktu" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-warning w-100"><i class="fa fa-print"></i>
                            Cetak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-header">
            Data Presensi
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Pagi</th>
                        <th>Sore</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{ $item->tanggal }}
                                {{-- {{ $loop->iteration }} --}}
                            </td>
                            <td>
                                {{ $item->user->biodata->name }}
                            </td>
                            <td class="text-center">
                                @if ($item->apelPagi->waktu === '-')
                                    -
                                @elseif($item->apelSore->waktu === 'tl')
                                    Tugas Luar
                                @else
                                    @isset($item->apelPagi->waktu)
                                        <img src="{{ asset($item->apelPagi->path) }}" alt="" width="100px">
                                        <br> {{ $item->apelPagi->waktu }}
                                    @endisset
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->apelSore->waktu === '-')
                                    -
                                @elseif($item->apelSore->waktu === 'tl')
                                    Tugas Luar
                                @else
                                    @isset($item->apelSore->waktu)
                                        <img src="{{ asset($item->apelSore->path) }}" alt="" width="100px">
                                        <br> {{ $item->apelSore->waktu }}
                                    @endisset
                                @endif
                            </td>
                            <td class="text-center">
                                @isset($item->apelSore->waktu)
                                    @if ($item->apelPagi->waktu === 'sakit')
                                        Sakit
                                    @elseif($item->apelPagi->waktu === 'izin')
                                        Izin
                                    @elseif($item->apelPagi->waktu && $item->apelSore->waktu)
                                        Hadir
                                    @else
                                        Bolos
                                    @endif
                                @endisset
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('js')
    @include('sweetalert::alert')
    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });

        const changeJenis = () => {
            hapsuForm()
            const jenis = $("#jenis").val();
            if (jenis == 'bulanan') {
                $("#col-waktu").append(`
                <select name="waktu" id="waktu" class="form-control float-right" required>
                    <option selected disabled>Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            `);
            } else {
                $("#col-waktu").append(`
                 <input type="date" name="waktu" id="waktu" class="form-control">
                `);
            }
        };

        const hapsuForm = async () => {
            $("#waktu").remove();
        }
    </script>
@stop
