@extends('templates.layout')

@section('title', $menuData['contact']['label'])

@section('breadcrumb-title', $menuData['contact']['label'])
@section('breadcrumbs')
    @include('components.dynamic-breadcrumb', ['breadcrumbKey' => 'contact'])
@endsection

@section('content')
@include('components.breadcrumb')

<div class="site-wrapper-reveal">
    <div class="contact-page-wrapper section-space--pt_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-contact-info">
                        <div class="contact-icon">
                            <i class="flaticon-placeholder"></i>
                        </div>
                        <div class="contact-info">
                            <h4>Alamat</h4>
                            {{ $website_contact_info ?? '' }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-contact-info">
                        <div class="contact-icon">
                            <i class="flaticon-call"></i>
                        </div>
                        <div class="contact-info">
                            <h4>Phone</h4>
                            <p><a href="tel:{{ $website_phone_number ?? '' }}">{{ $website_phone_number ?? '' }} </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-contact-info">
                        <div class="contact-icon">
                            <i class="flaticon-paper-plane-1"></i>
                        </div>
                        <div class="contact-info">
                            <h4>Mail</h4>
                            <p><a href="mailto:{{ $website_mail }}">{{ $website_mail ?? '' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="contact-form-area section-space--ptb_120">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="embed-responsive-item">
                            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDI33BK7-y6bqpyOiFImvWSymq6sofXFwI&zoom=16&q={{ $website_contact_info }}" style="border:0; height: 400px; width: 600px;"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-form-wrap ml-lg-5">
                            <h3 class="title mb-40">Hubungi Kami</h3>
                            <form id="contact" action="{{ route('contact') }}" role="form" method="POST" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input text">
                                        <label>Nama</label>
                                        <input name="name" value="{{ old('name') }}" class="form-control" placeholder="Nama" maxlength="125" type="text" />
                                        @error('name')
                                        <div class="alert alert-danger">
                                            Sebuah entri diperlukan atau memiliki nilai yang tidak valid. Harap perbaiki dan coba lagi.
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input email">
                                        <label>Email</label>
                                        <input name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" maxlength="30" type="email" />
                                        @error('email')
                                        <div class="alert alert-danger">
                                            Sebuah entri diperlukan atau memiliki nilai yang tidak valid. Harap perbaiki dan coba lagi.
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input textarea">
                                        <label>Pesan</label>
                                        <textarea name="message" value="{{ old('message') }}" class="form-control" placeholder="Pesan" cols="30" rows="6"></textarea>
                                        @error('message')
                                        <div class="alert alert-danger">
                                            Sebuah entri diperlukan atau memiliki nilai yang tidak valid. Harap perbaiki dan coba lagi.
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <div class="captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        </button>
                                    </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                        </button>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input id="captcha" type="text" class="form-control" placeholder="Captcha" name="captcha">
                                        @error('message')
                                            <div class="alert alert-danger">
                                                ReCAPTCHA tidak dimasukkan dengan benar. Kembali dan coba lagi.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="submit-btn" type="submit">Submit</button>
                                    <p class="form-messege"></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('extend-scripts')
<!-- Add this code to your existing script -->
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
        type: 'GET',
        url: '{{ route('reload-captcha') }}',
        success: function (data) {
            $(".captcha span").html(data.captcha);
        }
        });
    });
    document.querySelector('#contact').addEventListener('submit', function(e) {
        e.preventDefault();
        var form = this;
        swal({
            title: "Apakah kamu yakin?",
            text: "Pesan anda akan dimasukkan ke kotak masuk kami!",
            icon: "warning",
            buttons: [
                "Tidak, batalkan!",
                "Ya, saya yakin!"
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                swal("Harap tunggu kami sedang memeriksa pesan anda!", {
                    buttons: false,
                    timer: 3000,
                }).then(function() {
                    // Submit the form using AJAX
                    $.ajax({
                        type: 'POST',
                        url: form.action,
                        data: $(form).serialize(),
                        success: function (response) {
                            // Display a success message using SweetAlert
                            swal({
                                title: "Berhasil!",
                                text: "Pesan anda telah terkirim.",
                                icon: "success",
                            }).then(function() {
                                // Redirect to the contact page after the user clicks "OK"
                                window.location.href = "{{ route('contact') }}";
                            });
                        },
                        error: function (error) {
                            // Handle errors if the form submission fails
                            swal("Oops!", "Terjadi kesalahan. Silakan coba lagi.", "error");
                        }
                    });
                });
            } else {
                swal("Dibatalkan", "Pesan anda telah dibatalkan :)", "error");
            }
        });
    });
</script>
@endpush
