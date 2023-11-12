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
        <span style="font-size: 0.9em">
            REKAPITULASI KEHADIRAN TENAGA PENUNJANG KEGIATAN DAERAH BULAN NOVEMBER <br>
            DINAS PERHUBUNGAN KOTA GORONTALO <br>
            TAHUN {{ date('Y') }}
        </span>
    </div>
    {{-- <div class="card table-responsive-xl"> --}}
    <table class="table-bordered text-center mt-4" style="font-size: 0.7em; width: 100%">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Jenis <br>
                    Kelamin
                </th>
                <th rowspan="2">Jabatan</th>
                <th colspan="{{ count($data[0]->presensi->where('periode', $bulan)) }}">Tanggal</th>
            </tr>
            <tr>
                @foreach ($data[0]->presensi as $item)
                    @if ($item->periode === $bulan)
                        <th class="text-center p-1" style="width: 15px">
                            @php
                                $tgl = explode('-', $item->tanggal);
                                echo $tgl[2];
                            @endphp
                        </th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td class="p-1">
                        {{ $item->biodata->name }}
                    </td>
                    <td>
                        {{ $item->biodata->jk }}
                    </td>
                    <td>
                        {{ $item->biodata->jabatan }}
                    </td>
                    @foreach ($item->presensi as $a)
                        @if ($a->periode === $bulan)
                            <td class="text-center">
                                @if (isset($a->apelPagi->waktu))
                                    H
                                @else
                                    TK
                                @endif
                            </td>
                        @endif
                    @endforeach
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
