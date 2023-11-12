<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"> --}}

    <title>Cetak Laporan Bulan {{ date('m') }}</title>
</head>

<body>
    <div class="text-center " style="width: 100%">
        <img src="{{ public_path('img/logo.png') }}" alt="" width="45px" class="float-left">
        <span style="font-size: 0.7em">
            PEMERINTAH KOTA GORONTALO <br>
            DINAS PERHUBUNGAN
            KOTA GORONTALO <br>
            Jl. apa stau depe nama
        </span>
    </div>
    <div class="w-100 bg-dark" style="height: 0.1%"></div>
    <div class="text-left  mt-3">
        <span>Hari/Tanggal : {{ $waktu }}</span>
    </div>
    {{-- <div class="card table-responsive-xl"> --}}
    <table class="table-bordered text-center mt-1" style="font-size: 0.7em; width: 100%">
        <thead>
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Nama</th>
                <th rowspan="3">Jenis <br>
                    Kelamin
                </th>
                <th colspan="8">Tanggal</th>
                <th rowspan="3">KET</th>
            </tr>
            <tr>
                <th colspan="2">
                    Apel Pagi
                </th>
                <th colspan="2">
                    Dalam Ruangan
                </th>
                <th colspan="2">
                    Istrahat
                </th>
                <th colspan="2">
                    Apel Sore
                </th>
            </tr>
            <tr>
                <th>
                    Jam
                </th>
                <th>
                    TTD
                </th>
                <th>
                    Jam
                </th>
                <th>
                    TTD
                </th>
                <th>
                    Jam
                </th>
                <th>
                    TTD
                </th>
                <th>
                    Jam
                </th>
                <th>
                    TTD
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->biodata->name }}</td>
                    <td>{{ $item->user->biodata->jk }}</td>
                    <td>{{ $item->apelPagi->waktu }}</td>
                    <td>H</td>
                    <td>{{ $item->dalamRuangan->waktu }}</td>
                    <td>H</td>
                    <td>{{ $item->setelahIshoma->waktu }}</td>
                    <td>H</td>
                    <td>{{ $item->apelSore->waktu }}</td>
                    <td>H</td>
                    <td>Hadir</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
