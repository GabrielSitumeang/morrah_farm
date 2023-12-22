<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('manager.blogs.index', [
            'title' => "Blog Manager",
            'blogs' => $blogs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.blogs.create', [
            'title' => 'Create Blogs'
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
        // Validasi inputan pengguna
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required',
            // Anda bisa menambahkan validasi lain sesuai kebutuhan
        ]);

        // Simpan file gambar ke dalam folder public
        $gambar = $request->file('gambar');
        $gambarName = time() . '.' . $gambar->getClientOriginalExtension(); // Nama file unik dengan timestamp
        $gambar->move('blogFotos', $gambarName); // Menyimpan file gambar ke dalam folder public

        // Simpan data blog ke dalam database
        Blog::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $gambarName,
            // Menyimpan foreign key (user_id) sesuai dengan pengguna yang sedang login
            'user_id' => auth()->user()->id
        ]);

        // Redirect ke halaman blog manager atau halaman lain yang diinginkan
        return redirect()->route('blog.manager')->with('success', 'Data blog berhasil ditambahkan!');
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
        $blog = Blog::findOrFail($id);
        return view('manager.blogs.edit', compact('blog'), [
            'title' => 'Edit Blog'
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
        // Validasi inputan pengguna
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            // Anda bisa menambahkan validasi lain sesuai kebutuhan
        ]);

        // Cari blog berdasarkan ID
        $blogs = Blog::findOrFail($id);
        $gambar = $request->file('gambar');
        $gambarName = time() . '.' . $gambar->getClientOriginalExtension(); // Nama file unik dengan timestamp
        $gambar->move('blogFotos', $gambarName); // Menyimpan file gambar ke dalam folder public

        // Update data blog
        $blogs->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            // Jika ada gambar yang diinputkan, update juga field gambar
            'gambar' => $gambarName,
        ]);



        // Redirect ke halaman blog manager atau halaman lain yang diinginkan
        return redirect()->route('blog.manager')->with('success', 'Data blog berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Cari data yang ingin dihapus berdasarkan ID
            $blogs = Blog::find($id);

            if (!$blogs) {
                throw new \Exception('Data not found');
            }

            // Hapus data
            $blogs->delete();

            return redirect()->route('blog.manager')->with('success', 'Data blog berhasil didelete!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
