<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\User as Model;
use RealRashid\SweetAlert\Facades\Alert;

class BerandaPeternakController extends Controller
{
    private $viewIndex = 'user_index';
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('peternak.beranda_index',[
            'title' => 'Dahsboard Peternak'
        ]);
    }

    public function kerbau(){
        return view('peternak.kerbau' , [
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
}
