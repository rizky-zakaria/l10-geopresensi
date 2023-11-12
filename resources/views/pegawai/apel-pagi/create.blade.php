@extends('adminlte::page')
@section('title', 'Merchant')

@section('content_header')
    <h1>Presensi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('apel-pagi.postLokasi') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <label for="lat">Latitude: </label>
                        <input type="text" name="lat" id="lat" readonly class="form-control">

                        <label for="long">Longitude: </label>
                        <input type="text" name="long" id="long" readonly class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="button" onclick="getLocation()" class="btn btn-warning w-100">Pindai Lokasi</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success w-100">Kirim Lokasi</button>
                    </div>
                </div>
            </form>
            {{-- <br><br> --}}

            {{-- <video id="video" width="640" height="480" autoplay></video>
            <button id="snap">Ambil Gambar</button>
            <canvas id="canvas" width="640" height="480"></canvas> --}}

        </div>
    </div>
@stop
@section('js')
    @include('sweetalert::alert')
    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {

            $("#lat").val(position.coords.latitude);
            $("#long").val(position.coords.longitude);
        }
    </script>
@stop
