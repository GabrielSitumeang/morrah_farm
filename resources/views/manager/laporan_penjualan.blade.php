<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama Produk</th>
            <th>Harga Satuan</th>
            <th>Jumlah Terjual</th>
            <th>Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $item)
            <tr>
                <td>{{ $item->bulan }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ formatRupiah($item->harga) }}</td>
                <td>{{ $item->jumlah_terjual }} Buah</td>
                <td>{{ formatRupiah($item->pendapatan) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
