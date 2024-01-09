<?php

namespace App\Http\Controllers;

use App\Models\Koordinat;
use Illuminate\Http\Request;

class KoordinatController extends Controller
{
    public function index($latitude, $longitude)
    {
        $data = Koordinat::first();
        $data->latitude = $latitude;
        $data->longitude = $longitude;
        $data->update();
        return redirect('/');
    }
}
