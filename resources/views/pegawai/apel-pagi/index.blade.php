@extends('adminlte::page')
@section('title', 'Presensi App')

@section('content_header')
    <h1>Presensi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Data Presensi
            <a href="{{ route('apel-pagi.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-camera"></i>
                Presensi Sekarang</a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Presnsi</th>
                        <th>Dokumentasi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->presensi->user->biodata->name }}
                            </td>
                            <td>{{ $item->presensi->keterangan }}</td>
                            <td class="text-center">
                                <img id="myImage" src="{{ asset($item->path) }}" alt="" width="100px">
                            </td>
                            <td>
                                {{ $item->presensi->keterangan }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="previewOverlay" style="display:none;">
        <img id="previewImage" src="" alt="Preview">
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
