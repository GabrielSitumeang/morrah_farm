<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sliders = HomeSlider::all();
        $postCount = HomeSlider::count();

        // Tentukan batas maksimum untuk jumlah post
        $maxPostCount = 3;
        return view('manager.home_slider.home_slider_index', [
            'title' => 'Slider di beranda User',
            'sliders' => $sliders,
            'postCount' => $postCount,
            'maxPostCount' => $maxPostCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.home_slider.home_slider_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_slider' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images'), $imageName);

        HomeSlider::create([
            'nama_slider' => $request->nama_slider,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imageName,
        ]);

        return redirect()->route('home-sliders.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function show(HomeSlider $homeSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeSlider $homeSlider)
    {
        return view('manager.home_slider.home_slider_form', [
            'title' => 'Edit Home Slider',
            'homSlider' => $homeSlider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeSlider $homeSlider)
    {
        $request->validate([
            'nama_slider' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
            Storage::delete(public_path('images/' . $homeSlider->gambar));

            $homeSlider->gambar = $imageName;
        }

        $homeSlider->nama_slider = $request->nama_slider;
        $homeSlider->deskripsi = $request->deskripsi;
        $homeSlider->save();

        return redirect()->route('home-sliders.index')->with('success', 'Slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeSlider $homeSlider)
    {
        Storage::delete(public_path('images/' . $homeSlider->gambar));
        $homeSlider->delete();

        return redirect()->route('home-sliders.index')->with('success', 'Slider deleted successfully');
    }
}
