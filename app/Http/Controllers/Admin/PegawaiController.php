<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('biodata')->where('role', 'pegawai')->get();
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = User::create([
            'email' => $request->email,
            'role' => 'pegawai',
            'password' => $request->password
        ]);
        Biodata::create([
            'name' => $request->nama,
            'jk' => $request->jk,
            'jabatan' => $request->jabatan,
            'user_id' => $data->id
        ]);

        return redirect(url('admin/data-master/pegawai/'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('admin.user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::whereId($id)->first();
        $data->email = $request->email;
        if (isset($request->password)) {
            $data->passowrd = $request->passowrd;
        }
        $data->update();

        $bio = Biodata::where('user_id', $id)->first();
        $bio->jk = $request->jk;
        $bio->jabatan = $request->jabatan;
        $bio->name = $request->nama;
        $bio->update();

        return redirect(url('admin/data-master/pegawai/'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bio = Biodata::where('user_id', $id)->first();
        $bio->delete();
        $user = User::find($id);
        $user->delete();
        return redirect(url('admin/data-master/pegawai/'));
    }
}
