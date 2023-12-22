@extends('layouts.app_LTE')

@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>New Order Details</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mainTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Pesanan</th>
                                    <th>Jumlah</th>
                                    <th>Kode</th>
                                    <th>Jumlah Harga + Ongkir</th>
                                    <th>Tanggal</th>
                                    <th>Alamat Penerima</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Detail Pembelian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($dataOrders as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        {{-- <td>
                                            {{ $data->produk->nama }}
                                        </td> --}}
                                        <td>{{ $data->produk->nama_produk ?? 'Produk tidak tersedia' }}</td>
                                        <td>{{ $data->jumlah_pesan }} Buah</td>
                                        <td>{{ $data->kode }}</td>
                                        <td>Rp{{ number_format($data->jumlah_harga + $data->ongkir->ongkos, 0, ',', '.') }}</td>
                                        <td>{{ $data->updated_at->isoFormat('dddd, D MMM Y') }}</td>
                                        <td>{{ $data->ongkir->lokasi ?? 'lokasi tidak tersedia'}}</td>
                                        <td>
                                            <a href="{{ route('result.file', $data->id) }}" class="nav-link">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('detail.pembelian', $data->id) }}" class="nav-link">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('order.confirm.process', $data->id) }}"><button type="submit"
                                                    class="btn btn-primary">Confirm</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $dataOrders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
