<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkunPembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail(Auth::id());
        return view('pembeli.akun_pembeli', compact('user'), [
            'title' => 'Akun Pembeli'
        ]);
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

        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->alamat = $request->input('alamat');
        $user->nohp = $request->input('nohp');
        $user->email = $request->input('email');
        // $user->password = Hash::make($request->input('password'));

        // Upload gambar
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('profileFoto', $request->file('foto')->getClientOriginalName());
            $user->foto = $request->file('foto')->getClientOriginalName();
            $user->update();
        }

        // cek apakah password dan password_confirmation sama
        if ($request->filled('password')) {
            if ($request->input('password') === $request->input('password_confirmation')) {
                $user->password = Hash::make($request->input('password'));
            } else {
                return redirect()->route('akun-pembeli.edit', $user->id)->with('error', 'Password confirmation does not match');
            }
        }


        return redirect()->route('akun-pembeli.edit', $user->id)->with('success', 'Profile Pembeli Update successfully');
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