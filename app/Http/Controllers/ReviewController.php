<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $reviewer = Pesanan::where('status', 6)->get();
        return view('pembeli.review', [
            "title" => 'Review'
        ], compact('reviewer'));
    }

    public function store($id) {
        $feedback = Pesanan::where('id', $id)->first();
        return view('pembeli.feedback', [
            "title" => 'Berikan Ulasan'
        ], compact('feedback'));
    }

    public function storeReviewProcess(Request $request, $id) {
        $request->validate([
            'img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'nullable|mimes:mp4,ogx,oga,ogv,ogg,webm',
            'review' => 'required|String|min:3'
        ]);

        $reviewers = Pesanan::where('id', $id)->first();
        if($request->hasFile('img2')) {
            $request->file('img2')->move('productimage/', $request->file('img2')->getClientOriginalName());
            $reviewers->img2 = $request->file('img2')->getClientOriginalName();
        }
        if($request->hasFile('video')) {
            $request->file('video')->move('upload/', $request->file('video')->getClientOriginalName());
            $reviewers->video = $request->file('video')->getClientOriginalName();
        }
        $reviewers->review = $request->review;
        $reviewers->status = 6;
        $reviewers->save();
        Alert::success('Terima kasih', 'Review anda berhasil di tambahkan');
        return redirect()->route('review');
    }
}
