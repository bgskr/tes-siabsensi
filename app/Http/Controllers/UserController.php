<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'nip'       => '',
            'username'  => 'required',
            'email'     => 'required|email',
            'id_roles'  => 'required',
            'password'  => 'required|min:8'
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['nip'] = '';
        // dd($validated);
        $data = User::create($validated);
        if ($validated['id_roles'] == 1) {
            $data->assignRole('admin');
        }
        if ($validated['id_roles'] == 2) {
            $data->assignRole('karyawan');
        }
        if ($validated['id_roles'] == 3) {
            $data->assignRole('staff');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
