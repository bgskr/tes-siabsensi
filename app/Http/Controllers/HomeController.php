<?php

namespace App\Http\Controllers;

use App\Models\AbsensiKaryawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = User::all();
        return view('dashboard.index', [
            'data' => $data,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required|email',
            'id_roles'  => 'required',
            'password'  => 'required|min:8'
        ]);
        $validated['password'] = Hash::make($validated['password']);
        // dd($validated);
        $data = User::create($validated);
        // dd($data);
        if(!$data) {
            return redirect()->back()-with('error', 'Gagal nambahin.');
        }

        return redirect()->back()->with('success', 'Berhasil nambahin.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $validated = $request->validate([
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required'
        ]);

        $data->name = $validated['name'];
        $data->username = $validated['username'];
        $data->email = $validated['email'];
        $data->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $data = User::findOrFail($id);

        $data->delete();
        return redirect()->back();
    }
}
