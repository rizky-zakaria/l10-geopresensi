@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Titik Lokasi Presensi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6496026853483!2d123.05621277404799!3d0.5269177994679298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32792ac2e70506a5%3A0x5ebf9443eac77918!2sDinas%20Perhubungan%20Kota%20Gorontalo!5e0!3m2!1sid!2sid!4v1698424691499!5m2!1sid!2sid"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Titik Lokasi
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <label for="longitude">Longitude</label>
                        <input type="text" name="longitude" id="longitude" class="form-control" value="123.0562128"
                            disabled>
                        <label for="latitude">Latitude</label>
                        <input type="text" name="latitude" id="latitude" class="form-control" value="0.5269178"
                            disabled>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
