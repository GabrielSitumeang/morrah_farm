@extends('layouts.app_Coza')
@section('content')
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10"></div>

            <div class="flex-w flex-c-m m-tb-10"></div>
        </div>
    </div>
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image:url('assetuser/images/bg-02.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            Blog
        </h2>
    </section>
    <!-- Content page -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!-- item blog -->
                        @foreach ($blogs as $blog)
                            <div class="p-b-63">
                                <a href="{{ url('blogdetail/') }}/{{ $blog->id }}" class="hov-img0 how-pos5-parent">
                                    <img src="{{ url('blogFotos') }}/{{ $blog->gambar }}" alt="IMG-BLOG">
                                    <div class="flex-col-c-m size-123 bg9 how-pos5">
                                        <span class="ltext-107 cl2 txt-center">
                                            {{ $blog->created_at->format('d') }}

                                        </span>
                                        <span class="stext-109 cl3 txt-center">
                                            {{ $blog->created_at->format('M y') }}
                                        </span>
                                    </div>
                                </a>
                                <div class="p-t-32">
                                    <h4 class="p-b-15">
                                        <a href="{{ url('blogdetail/') }}/{{ $blog->id }}" class="ltext-108 cl2 hov-cl1 trans-04">
                                            {{ $blog->judul }}
                                        </a>
                                    </h4>
                                    <div class="flex-w flex-sb-m">
                                        <span class="flex-w flex-m stext-111 cl2 p-r-30">
                                            <span>
                                                <span class="cl4">By</span>
                                                {{ $blog->user->name }}
                                                <span class="cl12 m-l-4 m-r-6">|</span>
                                            </span>
                                            <a href="{{ url('blogdetail/') }}/{{ $blog->id }}"
                                                class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                                Continue Reading
                                                <i class="fa fa-long-arrow-right m-l-9"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

