<?php

namespace App\Http\Controllers;


use App\Mail\SendEmail;
use App\Models\About;
use App\Models\Blog;
use App\Models\HomeSlider;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class BerandaPembeliController extends Controller


/* ============== Khusus beranda ============== */
{
    public function index()
    {

        $slidershome = HomeSlider::all();
        $reviews = Rating::all();
        return view('pembeli.beranda_index', [
            'title' => 'Selamat Datang Di Morrah Farm',
            'sliders' => $slidershome,
            'reviews' => $reviews,
        ]);
    }


    /* ============== Khusus Produk ============== */
    public function product()
    {
        $produks = Produk::all();
        $produkData = [];

        foreach ($produks as $produk) {
            $jumlahTerjual = Pesanan::where('produk_id', $produk->id)->where('status', '>', 5)->sum('jumlah_pesan');

            $ratingSum = Rating::where('produk_id', $produk->id)->sum('rating');
            $ratingCount = Rating::where('produk_id', $produk->id)->count();
            $ratingValue = $ratingCount > 0 ? $ratingSum / $ratingCount : 0;

            $produkData[] = [
                'produk' => $produk,
                'jumlahTerjual' => $jumlahTerjual,
                'ratingValue' => $ratingValue,
            ];
        }

        return view('pembeli.produk_index', [
            'title' => 'Produk Morrah Farm',
            'produkData' => $produkData,
        ]);
    }
    // public function product()
    // {
    //     $produks = Produk::all();
    //     return view('pembeli.produk_index', [
    //         'title' => 'Produk Morrah Farm',
    //         'produks' => $produks,
    //     ]);
    // }


    /* ============== Khusus Blog ============== */
    public function blog()
    {
        $blogs = Blog::all();
        return view('pembeli.blog_index', [
            'title' => "Blog Pembeli"
        ], compact('blogs'));
    }

    public function blogdetail($id)
    {
        $products = Produk::take(3)->get();
        $blog = Blog::where('id', $id)->first();
        return view('pembeli.detail_blog', [
            'title' => 'Detail Blog',
            'blog' => $blog,
            'produks' => $products
        ]);
    }
    /* ============== Khusus About ============== */
    public function about()
    {
        $abouts = About::all();
        return view('pembeli.about_index', [
            'title' => 'About Morrah Farm',
            'abouts' => $abouts
        ]);
    }

    /* ============== Khusus visi dan misi ============== */
    public function visimisi()
    {
        return view('pembeli.visimisi', [
            'title' => 'Visi dan Misi Morrah Farm'
        ]);
    }

    /* ============== Khusus Penilain ============== */
    public function review()
    {
        return view('pembeli.rivew_pembeli', [
            'title' => 'Review Pembeli'
        ]);
    }

    public function galeri()
    {
        return view('pembeli.galeri', [
            'title' => 'Galeri Morrah Farm'
        ]);
    }

    /* ============== Khusus Kontak ============== */
    public function contact()
    {
        return view('pembeli.contact_index', [
            'title' => 'Contact Us by Email'
        ]);
    }

    public function kirimemail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pesan' => 'required'
        ]);

        if ($this->isOnline()) {
            $mail_data = [
                'recipient' => 'otnielkalit25@gmail.com',
                'fromEmail' => $request->email,
                'fromMessage' => $request->pesan
            ];

            Mail::send([], $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                    ->subject('Customer Morrah Farm')
                    ->setBody($mail_data['fromMessage']);
            });

            Alert::success('Berhasil', 'Pesan Anda Berhasil Terkirim Ke email kami');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Cek Koneksi Internet Anda');
            return redirect()->back();
        }
    }
    public function isOnline($site = "https://youtube.com/")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
}
