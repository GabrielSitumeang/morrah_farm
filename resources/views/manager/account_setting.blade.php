@extends('layouts.app_LTE')

@section('content')
<div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10"></div>

            <div class="flex-w flex-c-m m-tb-10"></div>
        </div>
    </div>

<div class="container rounded bg-white mt-5 mb-5">
        <form action="{{ route('akun-manager.update', $manager->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3 ">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div style="margin-top: 110px;">
                    </div>
                    
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img src="{{ asset('profileFoto/') }}/{{ $manager->foto }}" alt="Profile-img"
                            style="border-radius: 140px; width: 250px; height: 270px;">

                    </div>

                    </div>
                </div>

                <div class="col-md-5 ">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12"><label class="labels">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $manager->name }}" />
                            </div>
                            <div class="col-md-12"><label class="labels">Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="{{ $manager->alamat }}">
                            </div>
                            <div class="col-md-12"><label class="labels">No Telepon</label>
                                <input type="text" class="form-control" name="nohp" value="{{ $manager->nohp }}">
                            </div>
                            <div class="col-md-12"><label class="labels">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $manager->email }}">
                            </div>
                            <div class="col-md-12"><label class="labels">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col-md-12"><label class="labels">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_confirmation"/>
                            </div>
                            <div class="col-md-12"><label class="labels">Upload Foto </label>
                            <br>
                                <input type="file" name="foto">
                            </div>
                        </div>
                        <div class="mt-5 text-center"><button type="submit" class="btn btn-primary profile-button">Save
                                Profile</button></div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <br><br>

@endsection

<!-- 
    <div class="container mt-5">
        <form action="{{ route('akun-manager.update', $manager->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <table border="1">
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="name" value="{{ $manager->name }}" /></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" value="{{ $manager->alamat }}" /></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td><input type="number" name="nohp" value="{{ $manager->nohp }}" /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" value="{{ $manager->email }}" /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td>Confirmasi Password</td>
                    <td><input type="password" name="password_confirmation" /></td>
                </tr>
                <tr>
                    <td>Foto Profil</td>
                    <td>
                        <div class="mb-3">
                            <input type="file" name="foto">
                        </div>
                        {{-- @if ($manager->photo)
                        <img src="{{ route('user.photo', ['id' => $manager->id]) }}" alt="Foto Profil" width="100">
                    @else
                        <span>Belum ada foto profil</span>
                    @endif
                    <input type="file" name="photo"> --}}
                    </td>
                </tr>
            </table>


            Tombol submit untuk mengirim form 
            <button type="submit" class="btn-primary mt-3 mb-3">Update</button>
        </form>
    </div> -->
