<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class AboutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();

        return view('manager.about.about_index', [
            'title' => 'About Morrah Farm',
            'abouts' => $abouts
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.about.about_form', [
            'title' => 'Create About Morrah Farm',
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public');
            $validatedData['gambar'] = $gambarPath;
        }

        About::create($validatedData);
        Alert::success('Success Title', 'Success Message');
        return redirect()->route('about.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $about = About::findOrFail($id);

        return view('manager.about.about_show',[
            'title' => 'Tampilan Detail Abouts',
            'about' => $about
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('manager.about.about_edit', [
            'title' => 'Edit About Morrah Farm',
            'about' => $about
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hapus gambar lama jika ada gambar baru diunggah
        if ($request->hasFile('gambar') && !empty($about->gambar)) {
            Storage::delete($about->gambar);
        }

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public');
            $validatedData['gambar'] = $gambarPath;
        }

        $about->update($validatedData);

        return redirect()->route('about.index')->with('success', 'Blog berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        // Hapus gambar dari folder jika ada
        if (!empty($about->gambar)) {
            Storage::delete($about->gambar);
        }

        $about->delete();
        Alert::success('Success', 'Data Terhapus');
        return redirect()->route('about.index');
    }
}
