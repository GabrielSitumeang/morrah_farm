@extends('layouts.app_Coza')

@section('content')
    <div class="container">
    </div>
    <div class="bg0 m-t-15 p-b-50"></div>
    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form action="{{ route('kirim.email') }}" method="POST">
                        @csrf
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Kirim Pesan Kepada Kami
                        </h4>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email"
                                placeholder="Alamat Email Anda">
                            <img class="how-pos4 pointer-none" src="assetuser/images/icons/icon-email.png" alt="ICON">
                        </div>
                        <div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="bor8 m-b-30">
                            <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="pesan" placeholder="Ketik pesan anda di sini"></textarea>
                        </div>
                        <div>
                            @error('pesan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-map-marker"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Alamat kami atau lihat peta di bawah
                            </span>

                            <p class="stext-115 cl6 size-213 p-t-18">
                                Bahal Batu I, Kec. Siborongborong, Kabupaten Tapanuli Utara, Sumatera Utara
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-phone-handset"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                WhatsApp
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                +1 800 1236879
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Email
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                contact@example.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Map -->
    <div id="map-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15844.06257951733!2d99.0074771!3d2.1641674!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e13fd3eaabb85%3A0xa9e690d292f758ea!2sMorrah%20Farm!5e1!3m2!1sid!2sid!4v1684720122940!5m2!1sid!2sid"
            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
    <script src="assetuser/js/map-custom.js"></script>
    <script>
        // Mengubah ukuran peta saat ukuran layar berubah
        function resizeMap() {
            var mapContainer = document.getElementById("map-container");
            var aspectRatio = 56.25; // Aspek rasio lebar dan tinggi 16:9

            var width = mapContainer.offsetWidth;
            var height = width / aspectRatio;

            mapContainer.style.height = height + "px";
        }

        // Panggil fungsi resizeMap saat halaman dimuat dan saat ukuran layar berubah
        window.onload = resizeMap;
        window.onresize = resizeMap;
    </script>
@endsection
