@extends('adminlte::page')
@section('title', 'Merchant')

@section('content_header')
    <h1>Pegawai</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('pegawai.update', $data->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="card-header">
                Daftar Pegawai
                <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-save"></i>
                    Simpan</button>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-6">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            value="{{ $data->biodata->name }}">
                    </div>
                    <div class="col-6">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control"
                            value="{{ $data->email }}">
                    </div>
                    <div class="col-6">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control" value="">
                    </div>
                    <div class="col-6">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control">
                            <option selected value="{{ $data->biodata->jk }}">
                                {{ $data->biodata->jk = 'L' ? 'Pria' : 'Wanita' }}
                            </option>
                            <option selected value="{{ $data->biodata->jk = 'L' ? 'W' : 'L' }}">
                                {{ $data->biodata->jk = 'L' ? 'Wanita' : 'Pria' }}
                            </option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" class="form-control"
                            value="{{ $data->biodata->jabatan }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('js')
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
    </script>
@stop
