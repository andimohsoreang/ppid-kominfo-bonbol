<section id="contact" class="section pb-3">

    <div class="container">
        @if(!request()->routeIs('home'))
        <h6>Tentang Kami</h6>
        <p class="text-dark text-justify">{{ $profilkantor->tentang }}</p>
        @endif
        @if(request()->routeIs('home'))
        @include('sweetalert::alert')
        <h6 class="xs-font mb-0">Form Kontak Kami</h6>
        <h3 class="section-title mb-5">Kontak Kami</h3>

        <div class="row align-items-center justify-content-between">
            <div class="col-md-8 col-lg-7">

                <form action="{{ route('kontakkami') }}" method="post" class="contact-form">
                    @csrf
                    <div class="form-row">
                        <div class="col form-group">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap">
                            @error('div')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="pesan" cols="30" rows="5" class="form-control @error('pesan') is-invalid @enderror" placeholder="Pesan Anda"></textarea>
                        @error('pesan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Kirim Pesan">
                    </div>
                </form>
            </div>
            <div class="col-md-4 d-none d-md-block order-1">
                <ul class="list">
                    <li class="list-head">
                        <h6>INFO KONTAK</h6>
                    </li>
                    <li class="list-body">
                        <p class="py-2"><i class="ti-location-pin"></i> {{ $profilkantor->alamat ?? ''  }}</p>
                        <p class="py-2"><i class="ti-email"></i>  {{ $profilkantor->email ?? '' }}</p>
                        <p class="py-2"><i class="ti-microphone"></i> {{ $profilkantor->telepon ?? '' }}</p>
                    </li>
                </ul> 
            </div>
        </div>
        @endif

        <footer class="footer mt-5 border-top">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6 text-center text-md-left">
                    <p class="mb-0">Copyright <script>document.write(new Date().getFullYear())</script> &copy; <a target="_blank" href="http://www.devcrud.com">PPID Bone Bolango</a></p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="social-links">
                        <a href="{{ $profilkantor->fb ?? '' }}" class="link" target="_blank"><i class="ti-facebook"></i></a>
                        <a href="{{ $profilkantor->tw ?? '' }}" class="link" target="_blank"><i class="ti-twitter-alt"></i></a>
                        <a href="{{ $profilkantor->ig ?? '' }}" class="link" target="_blank"><i class="ti-instagram"></i></a>
                    </div>
                </div>
            </div> 
        </footer>
    </div>
</section>