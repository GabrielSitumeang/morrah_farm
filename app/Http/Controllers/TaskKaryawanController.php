<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\TaskKaryawan;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TaskKaryawanController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tugass = Tugas::all();
        $tasks = TaskKaryawan::all();
        return view('peternak.task.index', [
            'title' => "Tugas Karyawan",
            'tugass' => $tugass,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peternak.task.create', [
            'title' => 'Tambah Detail Pekerjaan'
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
            'nama_tugas' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'gambar' => 'required',


            // Anda bisa menambahkan validasi lain sesuai kebutuhan
        ]);

        // Simpan file gambar ke dalam folder public
        $gambar = $request->file('gambar');
        $gambarName = time() . '.' . $gambar->getClientOriginalExtension(); // Nama file unik dengan timestamp
        $gambar->move('blogFotos', $gambarName); // Menyimpan file gambar ke dalam folder public

        // Simpan data blog ke dalam database
        TaskKaryawan::create([
            'nama_tugas' => $request->nama_tugas,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'gambar' => $gambarName

            // Menyimpan foreign key (user_id) sesuai dengan pengguna yang sedang login
            // 'user_id' => auth()->user()->id
        ]);

        // Redirect ke halaman blog manager atau halaman lain yang diinginkan
        return redirect()->route('task.peternak')->with('success', 'Detail Pekerjaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve the task record from the database using the provided ID
    $task = TaskKaryawan::findOrFail($id);

    // Pass the task data to a view for rendering
    return view('peternak.task.show', [
        'task' => $task,
        'title' => 'Detail Pekerjaan'
    ]);
    }

    public function updateStatus($id)
{
    $tugass = TaskKaryawan::findOrFail($id);
    $tugass->status = 'Selesai';
    $tugass->save();

    return redirect()->route('task.peternak')->with('success', 'Status berhasil!');
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $tugas = Tugas::findOrFail($id);
        // return view('manager.tugas.edit', compact('tugas'), [
        //     'title' => 'Edit Tugas'
        // ]);
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
        // // Validasi inputan pengguna
        // $request->validate([
        //     'nama_tugas' => 'required',
        //     'deskripsi' => 'required',
        //     // Anda bisa menambahkan validasi lain sesuai kebutuhan
        // ]);

        // // // Cari blog berdasarkan ID
        // $tugass = Tugas::findOrFail($id);
        // // $gambar = $request->file('gambar');
        // // $gambarName = time() . '.' . $gambar->getClientOriginalExtension(); // Nama file unik dengan timestamp
        // // $gambar->move('blogFotos', $gambarName); // Menyimpan file gambar ke dalam folder public

        // // Update data blog
        // $tugass->update([
        //     'nama_tugas' => $request->nama_tugas,
        //     'deskripsi' => $request->deskripsi,
        //     // Jika ada gambar yang diinputkan, update juga field gambar
        //     // 'gambar' => $gambarName,
        // ]);



        // // Redirect ke halaman blog manager atau halaman lain yang diinginkan
        // return redirect()->route('tugas.manager')->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // try {
        //     // Cari data yang ingin dihapus berdasarkan ID
        //     $tugass = Tugas::find($id);

        //     if (!$tugass) {
        //         throw new \Exception('Data not found');
        //     }

        //     // Hapus data
        //     $tugass->delete();

        //     return redirect()->route('tugas.manager')->with('success', 'Tugas berhasil didelete!');
        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
    }
}