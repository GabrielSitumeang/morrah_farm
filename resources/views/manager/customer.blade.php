@extends('layouts.app_LTE')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <h1>{{ $title }}</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">
                                ID User
                            </th>
                            <th class="text-center">
                                Name
                            </th>
                            <th>
                                Foto
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                No HP
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($data as $data)
                            <tr class="text-center">
                                <td class="text-center">{{ $data->id }}</td>
                                <td>
                                    <a>
                                        {{ $data->name }}
                                    </a>
                                    <br>
                                    <small>
                                        Join at {{ $data->created_at->format('d M Y') }}
                                    </small>
                                </td>
                                <td>
                                    <img alt="Avatar" class="table-avatar" src="{{ asset('profileFoto/') }}/{{ $data->foto }}">

                                </td>
                                <td class="project_progress">
                                    <p>{{ $data->email }}</p>
                                </td>
                                <td>
                                    {{ $data->nohp }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Belum Ada Customer</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection
