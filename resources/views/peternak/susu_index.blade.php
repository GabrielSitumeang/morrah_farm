@extends('layouts.peternak')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="text-center">{{ $title }}</h1>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <a href="{{ route($routePrefix . '.create') }}">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-user-plus"></i>Laporkan Susu</button></a>
                <div class="mt-3"></div>
                <div class="row">
                    @foreach ($susus as $susu)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            {{-- <h2 class="lead"><b>{{ $susu->pelapor }}</b></h2>
                                            <p class="text-muted text-sm"><b>Pelapor: </b>{{ $susu->pelapor }}</p>
                                            <p class="text-muted text-sm"><b>Tanggal: </b>{{ $susu->tanggal }}</p>
                                            <p class="text-muted text-sm"><b>Jumlah Susu: </b>{{ $susu->jumlah_susu }}</p> --}}

                                            <td>{{ $susu->pelapor }}</td>
                                            <td>{{ $susu->tanggal }}</td>
                                            <td>{{ $susu->jumlah_susu }}</td>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">


                                        {!! Form::open([
                                            'route' => ['susu.destroy', $susu->id],
                                            'method' => 'DELETE',
                                        ]) !!}
                                        <a href="{{ route('susu.edit', $susu->id) }}"
                                            class="btn btn-success btn-sm text-center"><i class="fas fa-edit"></i></a>

                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm text-center btndelete', 'id' => 'delete']) }}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
