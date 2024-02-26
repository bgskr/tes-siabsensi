<?php

namespace App\Http\Controllers;

use App\Models\AbsensiKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiKaryawanController extends Controller
{
    public function index()
    {
        $data = AbsensiKaryawan::all();
        return view('karyawan.index', [
            'data' => $data
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $validated = $request->validate([
            'id_karyawan'       => 'required',
            'tanggal_masuk'     => 'required',
            'keterangan'        => 'required'
        ]);
        // dd($validated)
        $data = AbsensiKaryawan::create($validated);

        if ($data) {
            return redirect()->back()->with('success', 'yeay');
        }

        return redirect()->back();
    }
}
