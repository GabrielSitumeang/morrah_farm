@extends('layouts.app_Coza')
@section('content')
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <div class="tab01">
                    <div class="tab-content p-t-43">
                        <div>
                            <div class="col-sm-10 col-md-8 col-lg-10 m-lr-10">
                                <div class="p-b-30 m-lr-15-sm">
                                    <!-- Review -->
                                    @foreach ($reviewer as $item)
                                        <div class="flex-w flex-t p-b-50">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                <img src="profileFoto/{{ $item->user->foto }}" alt="AVATAR">
                                            </div>
                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-5">
                                                    <span class="mtext-107 cl2 p-r-20">
                                                        {{ $item->user->name }}
                                                    </span>
                                                </div>
                                                <div class="flex-w flex-sb-m p-b-20">
                                                    <span class="stext-100 cl2 p-r-20">
                                                        {{-- <p class="text-muted">diniali tanggal{{ $item->updated_at }} | Variasi : {{ $item->produk->nama_produk }}</p> --}}
                                                        <p class="text-muted">dinilai tanggal :
                                                            {{ $item->created_at->format('d M Y') }}
                                                            Jam {{ $item->created_at->format('H:i:s') }} | Nama Produk :
                                                            {{ $item->produk->nama_produk }}</p>
                                                    </span>
                                                </div>
                                                <p class="stext-102 cl6">
                                                    {{ $item->review }}
                                                </p>
                                                <div class="row mt-2">
                                                    <div class="col-md-2">
                                                        @if ($item->img2 != null)
                                                            <a href="productimage/{{ $item->img2 }}"
                                                                data-sub-html="Demo Description">
                                                                <img class="img-responsive thumbnail"
                                                                    src="productimage/{{ $item->img2 }}" width="100px"
                                                                    alt="{{ $item->img2 }}">
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-2">
                                                        @if ($item->video != null)
                                                            <a href="upload/{{ $item->video }}"
                                                                data-sub-html="Demo Description">
                                                                <video src="upload/{{ $item->video }}" height="100px"
                                                                    width="100px"></video>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Add review -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
