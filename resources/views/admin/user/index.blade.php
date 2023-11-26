@extends('adminlte::page')
@section('title', 'Merchant')

@section('content_header')
    <h1>Pegawai</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Daftar Pegawai
            <a href="{{ route('pegawai.create') }}" class="btn btn-sm btn-primary float-right"><i
                    class="fa fa-plus-circle"></i> Tambah</a>
        </div>
        <div class="card-body table-responsive">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->biodata->name }}
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if ($item->biodata->jk === 'L')
                                    Pria
                                @else
                                    Wanita
                                @endif
                            </td>
                            <td>{{ $item->biodata->jabatan }}</td>
                            <td>
                                <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-sm btn-success"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ route('pegawai.destroy', $item->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit"><i
                                            class="fa fa-trash"></i></button>
                                </form>
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
