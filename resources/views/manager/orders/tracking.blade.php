@extends('layouts.app_LTE')

@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tracking Order</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Jumlah Harga</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi Penerima</th>
                                    <th>Isi form</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTracking as $index => $data)
                                    <tr>
                                        <td>{{ $index + $dataTracking->firstItem() }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>{{ $data->kode }}</td>
                                        <td>Rp{{ number_format($data->jumlah_harga, 0, ',', '.') }}</td>
                                        <td>{{ $data->updated_at->isoFormat('dddd, D MMM Y') }}</td>
                                        <td>{{ $data->ongkir->lokasi }}</td>
                                        <td>
                                            <a href="{{ route('form.tracking', $data->id) }}"><button type="button"
                                                    class="btn btn-primary">Form Tracking</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $dataTracking->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
