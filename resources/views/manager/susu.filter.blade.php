@foreach ($laporan as $lap)
<p>{{ $lap->nama_laporan }} - {{ $lap->tanggal }}</p>
@endforeach