@extends('layouts.app_Coza')
@section('content')
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10"></div>

            <div class="flex-w flex-c-m m-tb-10"></div>
        </div>
    </div>

    <!-- Content page -->
    <section class="bg0 p-t-52 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!--  -->
                        <div class="wrap-pic-w how-pos5-parent">
                            <img src="{{ url('blogFotos') }}/{{ $blog->gambar }}" alt="IMG-BLOG">
                            <div class="flex-col-c-m size-123 bg9 how-pos5">
                                <span class="ltext-107 cl2 txt-center">
                                    {{ $blog->created_at->format('d') }}
                                </span>
                                <span class="stext-109 cl3 txt-center">
                                    {{ $blog->created_at->format('M Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="p-t-32">
                            <span class="flex-w flex-m stext-111 cl2 p-b-19">
                                <span>
                                    <span class="cl4">By</span>
                                    {{ $blog->user->name }}
                                    <span class="cl12 m-l-4 m-r-6">|</span>
                                </span>
                                <span>
                                    {{ $blog->created_at->format('d M Y') }}
                                    <span class="cl12 m-l-4 m-r-6">|</span>
                                </span>
                            </span>
                            <h4 class="ltext-109 cl2 p-b-28">
                                {{ $blog->judul }}
                            </h4>
                            <p class="stext-117 cl6 p-b-26">
                                {{ $blog->isi }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <div class="p-t-0">
                            <h4 class="mtext-112 cl2 p-b-33">
                               Produk Terbaru
                            </h4>
                            <ul>
                                @foreach ($produks as $produk)
                                    <li class="flex-w flex-t p-b-30">
                                        <a href="{{ route('pembeli.produk') }}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                            <img width="90" height="100" src="{{ url('productimage') }}/{{ $produk->gambar }}" alt="PRODUCT">
                                        </a>
                                        <div class="size-215 flex-col-t p-t-8">
                                            <a href="#" class="stext-116 cl8 hov-cl1 trans-04">
                                               {{ $produk->nama_produk }}
                                            </a>
                                            <span class="stext-116 cl6 p-t-20">
                                                {{ formatRupiah($produk->harga) }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
