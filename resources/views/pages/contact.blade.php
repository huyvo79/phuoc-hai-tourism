@extends('layouts.layouts')

@section('title', 'Contact')

@section('body_class', 'contact-page')

@section('content')
<div class="contact-container">
    <div class="contact-header">
        <h2>Liên Hệ Với Chúng Tôi</h2>
        <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn. Hãy gửi tin nhắn ngay!</p>
    </div>

    <div class="row g-4">
        {{-- Thông tin liên hệ --}}
        <div class="col-lg-6">
            <div class="contact-card">
                <div class="d-flex align-items-center">
                    <div class="contact-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div class="contact-details">
                        <h5>Email</h5>
                        <a href="mailto:contact@example.com">contact@example.com</a>
                    </div>
                </div>
            </div>

            <div class="contact-card">
                <div class="d-flex align-items-center">
                    <div class="contact-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div class="contact-details">
                        <h5>Điện Thoại</h5>
                        <a href="tel:+84123456789">+84 123 456 789</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form liên hệ --}}
        <div class="col-lg-6">
            <form method="POST" action="#">
                @csrf

                <div class="mb-3 form-floating">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Họ và Tên" required>
                    <label for="name">Họ và Tên</label>
                </div>

                <div class="mb-3 form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    <label for="email">Email</label>
                </div>

                <div class="mb-4 form-floating">
                    <textarea name="message" class="form-control" id="message" placeholder="Tin Nhắn"
                              style="height:120px" required></textarea>
                    <label for="message">Tin Nhắn</label>
                </div>

                <button type="submit" class="btn btn-submit">
                    Gửi Tin Nhắn
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
