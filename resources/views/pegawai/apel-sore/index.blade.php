@extends('adminlte::page')
@section('title', 'Presensi App')

@section('content_header')
    <h1>Presensi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Data Presensi
            <a href="{{ route('apel-sore.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-camera"></i>
                Presensi Sekarang</a>
            <button type="button" class="btn btn-warning btn-sm float-right mr-1" data-toggle="modal"
                data-target="#exampleModal">
                Tugas Luar
            </button>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Presensi</th>
                        <th>Dokumentasi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        @if (Auth::user()->id === $item->presensi->user_id)
                            <tr>
                                <td>
                                    {{-- {{ $loop->iteration }} --}}
                                    {{ $item->presensi->tanggal }}
                                </td>
                                <td>
                                    {{ $item->presensi->user->biodata->name }}
                                </td>
                                <td>
                                    @if ($item->waktu == 'tl')
                                        Tugas Luar
                                    @elseif($item->waktu == 'sakit')
                                        Sakit
                                    @elseif($item->waktu == 'izin')
                                        Izin
                                    @else
                                        {{ $item->waktu }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->waktu === 'tl')
                                        <a href="{{ asset($item->path) }}">Tugas Luar</a>
                                    @else
                                        <img id="myImage" src="{{ asset($item->path) }}" alt="" width="100px">
                                    @endif
                                </td>
                                <td>
                                    @if ($item->waktu == 'tl')
                                        Tugas Luar
                                    @elseif($item->waktu == 'sakit')
                                        Sakit
                                    @elseif($item->waktu == 'izin')
                                        Izin
                                    @else
                                        Hadir
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="previewOverlay" style="display:none;">
        <img id="previewImage" src="" alt="Preview">
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('apel-sore.tugas-luar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <select name="keterangan" id="keterangan" class="form-control">
                                {{-- <option selected disabled>Pilih Keterangan</option> --}}
                                <option value="tl" selected>Tugas Luar</option>
                            </select>
                        </div>
                        <label for="file">Dokumentasi</label>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="file" name="file" id="file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
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
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });


        document.getElementById("myImage").addEventListener("click", function() {
            var src = this.src;
            var previewImage = document.getElementById("previewImage");
            var previewOverlay = document.getElementById("previewOverlay");

            previewImage.src = src;
            previewOverlay.style.display = "flex";
        });

        // Menutup pratinjau ketika overlay diklik
        document.getElementById("previewOverlay").addEventListener("click", function() {
            this.style.display = "none";
        });
    </script>
@stop

@section('css')
    <style>
        #previewOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #previewOverlay img {
            max-width: 80%;
            max-height: 80%;
        }
    </style>
@endsection
