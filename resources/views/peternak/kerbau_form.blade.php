@extends('layouts.peternak')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form tambah data Kerbau Jantan</h3>
                    </div>
                    {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true], ) !!}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Melapor</label>
                            {!! Form::date('tanggal', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_kerbau">Jumlah Kerbau</label>
                            {!! Form::number('jumlah_kerbau', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('jumlah_kerbau') }}</span>
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
