
@extends('layouts.login')

@section('content')

        @if (session('status'))
            <script>
                alert('{{ session('status') }}');
            </script>
        @endif

        <div class="body">
            <form class="form" id="form" action="/login" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="header">
                    <h2>Đăng nhập</h2>
                    <p>Cùng nhau trải nghiệm những nơi đẹp nhất</p>
                </div>
                <div class="form-body">
                    <div class="form-items form__email">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="VD: chien@gmail.com">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__password">
                        <label for="password">Mật khẩu</label>
                        <input id="password" type="password" name="password" placeholder="Mật khẩu">
                        <span class="form-message"></span>
                    </div>
                    <input type="text" name="starts" value="login" style="display: none">
                    <button>Đăng nhập</button>
                </div>
            </form>
            <div class="contact">
                <div class="contact-hr">
                    <hr>
                    <span>Hoặc</span>
                    <hr>
                </div>
                <button class="contact_register"><a href="{{ route('register') }}">Đăng ký</a></button>
            </div>
        </div>
        <script src="./js/login.js"></script>
    <script>
        Validate({
            form: '.form',
            formParrent: '.form-items',
            rules: [
                Validate.isRequet('#email'),
                Validate.isEmail('#email'),
                Validate.isPassword('#password', 6),
            ],
            errorMessage: '.form-message',
            onSubmit: function(data) {
                document.querySelector('.form').submit();
            }
        })
    </script>

@endsection