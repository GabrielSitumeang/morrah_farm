<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User as Model;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    private $viewIndex = 'user_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'user_show';
    private $routePrefix = 'user';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.' . $this->viewIndex, [
            'models' => Model::where('role', '<>', 'pembeli')
            ->latest()
            ->paginate(30),
            'title' => 'Data Karyawan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model'     => new Model(),
            'method'    => 'POST',
            'route'     => $this->routePrefix .'.store',
            'button'    => 'SIMPAN',
            'title'     => 'Form tambah data pegawai',
        ];

        return view('manager.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'nohp'      => 'required|unique:users',
            'role'      => 'required|in:manager,produksi,peternak',
            'password'  =>  'required'
        ]);
        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        $requestData['nohp_verified_at'] = now();
        Model::create($requestData);
        return redirect()->route('user.index')->with('success','Sukses menambah Pegawai!');
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
        $data = [
            'model'     => Model::findOrFail($id),
            'method'    => 'PUT',
            'route'     => [$this->routePrefix . '.update', $id],
            'button'    => 'UPDATE',
            'title'     => 'Update Data Pegawai'
        ];

        return view('manager.' . $this->viewEdit, $data);
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
        $requestData = $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email,' . $id,
            'nohp'      => 'required|unique:users,nohp,' . $id,
            'role'      => 'required|in:manager,produksi,peternak',
            'password'  =>  'nullable'
        ]);
        $model = Model::findOrFail($id);
        if($requestData['password'] == ""){
            unset($requestData['password']);
        }else{
            $requestData['password'] = bcrypt($requestData['password']);
        }
        $model->fill($requestData);
        $model->save();
        return redirect()->route('user.index')->with('success','Data Pegawai Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Model::findOrFail($id);
        if($model->email == 'manager@gmail.com'){
            Alert::error('Tidak Boleh Menghapus Akun ini!');
            return back();  
        }
        $model->delete();
        return back();
    }
}
