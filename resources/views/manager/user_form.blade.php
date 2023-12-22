@extends('layouts.app_LTE')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>
                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'autofocus']) !!}
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="nohp">Nomor HandPhone</label>
                            {!! Form::number('nohp', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nohp') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            {!! Form::select(
                                'role',
                                [
                                    'manager' => 'Manager',
                                    'produksi' => 'Produksi',
                                    'peternak' => 'Peternak',
                                ],
                                null,
                                ['class' => 'form-control', 'placeholder' => 'Pekerjaan'],
                            ) !!}
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit($button, ['class' => 'btn btn-primary btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
@endsection
