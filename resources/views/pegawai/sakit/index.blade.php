@extends('adminlte::page')
@section('title', 'Presensi App')

@section('content_header')
    <h1>Presensi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Data Presensi
            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                Tidak Hadir
            </button>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>
                                {{ $item->keterangan }}
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('sakit.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <select name="keterangan" id="keterangan" class="form-control">
                                <option selected disabled>Pilih Keterangan</option>
                                <option value="sakit">Sakit</option>
                                <option value="izin">Izin</option>
                            </select>
                        </div>
                        <label for="file">Surat</label>
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
