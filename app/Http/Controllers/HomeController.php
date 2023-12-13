<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();

        $jumlahHariBulan = Carbon::create(date('Y'), date('m'))->daysInMonth;
        $jumlahHariTahun = Carbon::create(date('Y'), date('m'))->daysInYear;

        $tanggalAwal = Carbon::parse(date('Y-m-') . '1');
        $tanggalAkhir = Carbon::parse(date('Y-m-') . $jumlahHariBulan);
        $jumlahHariKerja = 0;
        for ($date = $tanggalAwal; $date->lte($tanggalAkhir); $date->addDay()) {
            if (!$date->isWeekend()) {
                $jumlahHariKerja++;
            }
        }

        $jumlahHariKerjaTahun = 0;
        $tanggalAwal = Carbon::createFromDate(date('Y'), 1, 1);
        $tanggalAkhir = Carbon::createFromDate(date('Y'), 12, 31);
        for ($tanggal = $tanggalAwal; $tanggal->lte($tanggalAkhir); $tanggal->addDay()) {
            if (!$tanggal->isWeekend()) {
                $jumlahHariKerjaTahun++;
            }
        }


        return view('home', compact('users', 'jumlahHariKerja', 'jumlahHariKerjaTahun'));
    }
}
