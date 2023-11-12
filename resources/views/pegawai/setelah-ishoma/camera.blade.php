@extends('adminlte::page')
@section('title', 'Merchant')

@section('content_header')
    <h1>Presensi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary w-100" onclick="camera()"><i class="fas fa-camera"></i> Buka Kamera</button>
        </div>
        <div class="card-body">
            <video id="video" width="100%" height="480" autoplay></video>
            <center>
                <canvas id="canvas" width="640" height="480"></canvas>
            </center>
            <button id="snap" class="btn btn-success w-100">Presensi Sekarang</button>
        </div>
    </div>
@stop

@section('js')
    <script>
        function camera() {
            // CSRF token untuk AJAX request
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Dapatkan akses ke kamera
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                    video: true
                }).then(function(stream) {
                    document.getElementById('video').srcObject = stream;
                });
            }

            // Tangkap gambar dan kirim ke server
            document.getElementById('snap').addEventListener('click', function() {
                const canvas = document.getElementById('canvas');
                const context = canvas.getContext('2d');
                context.drawImage(document.getElementById('video'), 0, 0, 640, 480);

                // Konversi gambar ke data URI
                const imageDataURI = canvas.toDataURL('image/png');

                // Setup data yang akan dikirim
                let formData = new FormData();
                formData.append('image', imageDataURI);

                // Kirim gambar ke server dengan AJAX
                fetch("{{ route('setelah-ishoma.image') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        window.location.href = "{{ url('pegawai/setelah-ishoma/success') }}";
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            });
        }
    </script>
@stop
