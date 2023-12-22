<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App\Models\AdminAkunSetting;

class AdminAkunSettingController extends Controller
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
     * @param  \App\Models\AdminAkunSetting  $adminAkunSetting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminAkunSetting  $adminAkunSetting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manager = User::findOrFail(Auth::id());
        return view('manager.account_setting', compact('manager'), [
            'title' => 'Akun Manager'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminAkunSetting  $adminAkunSetting
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

        $manager = User::findOrFail($id);
        $manager->name = $request->input('name');
        $manager->alamat = $request->input('alamat');
        $manager->nohp = $request->input('nohp');
        $manager->email = $request->input('email');
        // $user->password = Hash::make($request->input('password'));

        // Upload gambar
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('profileFoto', $request->file('foto')->getClientOriginalName());
            $manager->foto = $request->file('foto')->getClientOriginalName();
            $manager->update();
        }

        // cek apakah password dan password_confirmation sama
        if ($request->filled('password')) {
            if ($request->input('password') === $request->input('password_confirmation')) {
                $manager->password = Hash::make($request->input('password'));
            } else {
                return redirect()->route('akun-manager.edit', $manager->id)->with('error', 'Password confirmation does not match');
            }
        }


        return redirect()->route('akun-manager.edit', $manager->id)->with('success', 'Profile Manager Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminAkunSetting  $adminAkunSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}