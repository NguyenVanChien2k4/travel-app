@extends('layouts.pages')

@section('content')

<link rel="stylesheet" href="{{ asset('./css/contacts.css') }}">

<div class="body">
    <div class="body__header">
        <h1>Liên hệ</h1>
        <p>Nếu bạn cần hỗ trợ hãy nhập đầy đủ thông tin theo yêu cầu
             và chúng tôi có thể giải đáp cho bạn</p>
    </div>
    <form class="form" id="form" action="/contacts/save" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body__content grid">
            <div class="body__content-input grid__column-6 sm-1">
                <h3>Thông tin</h3>
                <div class="body__content-input--item">
                    <div class="form-items">
                        <p>Họ tên*</p>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" placeholder="............">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items">
                        <p>Email*</p>
                        <input type="text" name="email" id="email" value="{{ $user->email }}" placeholder="............">
                        <span class="form-message"></span>
                    </div>
                </div>
                <div class="body__content-input--item">
                    <div class="form-items">
                        <p>Số điện thoại*</p>
                        <input type="text" name="phone" id="phone" value="" placeholder="...........">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items">
                        <p>Địa chỉ</p>
                        <input type="text" name="address" id="address" value="{{ $user->address }}" placeholder="............">
                        <span class="form-message"></span>
                    </div>
                </div>
                <p>Nội dung*</p>
                <div class="form-items">
                    <textarea name="content" id="content" placeholder="Nội dung cần gửi ...."></textarea>
                    <span class="form-message"></span>
                </div>
                <center>
                    <button type="submit">
                        <p>Gửi đi</p>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </center>
            </div>
            <div class="body__content-list grid__column-6 sm-1">
                <h3>Tư vấn</h3>
                <div class="">
                    <div class="body__content-list--items">
                        <h2>Trung tâm chăm sóc</h2>
                        <div class="">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>426 Trần Đại Nghĩa, Hòa Hải, Ngũ Hành Sơn, Tp Đà Nẵng</p>
                        </div>
                        <div class="">
                            <i class="fa-solid fa-phone"></i>
                            <p>(+84) 123 456 789</p>
                        </div>
                        <div class="">
                            <i class="fa-solid fa-fax"></i>
                            <p>Hotline: 1900 1900</p>
                        </div>
                        <div class="">
                            <i class="fa-solid fa-envelope"></i>
                            <p>pheronguyens2k4@gmail.com  -  reviewtravel@gmail.com</p>
                        </div>
                    </div>
                    <div class="body__content-list--items">
                        <h2>Câu hỏi thường gặp</h2>
                        <div class="">
                            <i class="fa-solid fa-circle-question"></i>
                            <a href="">
                                <p>Tôi muốn biết về cách thức hoạt động của các bạn</p>
                            </a>
                        </div>
                        <div class="">
                            <i class="fa-solid fa-circle-question"></i>
                            <a href="">
                                <p>Bạn có thể tư vấn cho tôi về 1 vài nơi được không</p>
                            </a>
                        </div>
                        <div class="">
                            <i class="fa-solid fa-circle-question"></i>
                            <a href="">
                                <p>Sắp tới gia đình chúng tôi muốn đi đâu đó, hãy cho tôi biết nơi nào là sự lựa chọn tốt nhất</p>
                            </a>
                        </div>
                        <div class="">
                            <p><span>Lưu ý quan trọng: </span>Các tư vấn trên có giá trị tham khảo. Quý khách vui lòng để lại lời nhắn hoặc liên hệ Tổng đài 1900 1900 để được giải đáp thắc mắc.</p>
                        </div>
                    </div>
                    <center>
                        <p>1900 1900</p>
                    </center>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="./js/handlepages.js"></script>

<script src="./js/login.js"></script>
    <script>
        Validate({
            form: '.form',
            formParrent: '.form-items',
            rules: [
                Validate.isRequet('#name'),
                Validate.isRequet('#email'),
                Validate.isEmail('#email'),
                Validate.isPassword('#phone', 9),
            ],
            errorMessage: '.form-message',
            onSubmit: function(data) {
                if(document.getElementById('content').value == '') {
                    alert('Bạn cần nhập nội dung thắc mắc của bạn!!!!');
                } else {
                    document.querySelector('.form').submit();
                }
            }
        })
    </script>

@include('layouts.footer');

@endsection