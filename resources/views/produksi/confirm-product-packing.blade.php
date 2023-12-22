@extends('layouts.produksi')

@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Upload Bukti Packing Produk</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Kode</th>
                                    <th>Jumlah Harga</th>
                                    <th>Tanggal</th>
                                    <th>Detail Pembelian</th>
                                    <th>Upload Bukti Produk</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($dataConfirmPhoto as $index => $data)
                                    <form action="{{ route('confirm.photo.process', $data->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <tr>
                                            <td>{{ $index + $dataConfirmPhoto->firstItem() }}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td>{{ $data->kode }}</td>
                                            <td>Rp{{ number_format($data->jumlah_harga, 0, ',', '.') }}</td>
                                            <td>{{ $data->updated_at->isoFormat('dddd, D MMM Y') }}</td>
                                            <td><a href="{{ route('produksi.detail.pembelian', $data->id) }}" class="nav-link">
                                                    <i class="fas fa-eye"></i>
                                                </a></td>
                                            <td>
                                                <input type="file" name="img">
                                                @error('img')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $dataConfirmPhoto->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
