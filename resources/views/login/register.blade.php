
@extends('layouts.login')

@section('content')
        <div class="body">
            <form class="form" id="form" method="POST" action="/" enctype="multipart/form-data">
                @csrf
                <div class="header">
                    <h2>Đăng ký</h2>
                    <p>Cùng nhau trải nghiệm những nơi đẹp nhất</p>
                </div>

                @if (session('status'))
                    <script>
                        alert('{{ session('status') }}');
                    </script>
                @endif

                <div class="form-body">
                    <div class="form-items form__name">
                        <label for="name">Tên đầy đủ</label>
                        <input id="name" type="text" name="name" placeholder="VD: Nguyễn Văn Chiến">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__email">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="VD: chien@gmail.com">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__email">
                        <label for="role">Vai trò</label>
                        <select name="role" id="role" class="province">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__password">
                        <label for="password">Mật khẩu</label>
                        <input id="password" type="password" name="password" placeholder="Mật khẩu">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__password-again">
                        <label for="password-again">Nhập lại mật khẩu</label>
                        <input id="password-again" type="password" name="password-again" placeholder="Nhập lại mật khẩu">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items">
                        <label for="provinse">Tỉnh/TP</label>
                        <select name="province" id="province" class="province">
                            <option value="">-- Chọn Tỉnh/TP --</option>
                            <option value="An Giang">An Giang</option>
                            <option value="Bạc Liêu">Bạc Liêu</option>
                            <option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                            <option value="Bắc Giang">Bắc Giang</option>
                            <option value="Bắc Kạn">Bắc Kạn</option>
                            <option value="Bắc Ninh">Bắc Ninh</option>
                            <option value="Bến Tre">Bến Tre</option>
                            <option value="Bình Dương">Bình Dương</option>
                            <option value="Bình Định">Bình Định</option>
                            <option value="Bình Phước">Bình Phước</option>
                            <option value="Bình Thuận">Bình Thuận</option>
                            <option value="Cà Mau">Cà Mau</option>
                            <option value="Cao Bằng">Cao Bằng</option>
                            <option value="Cần Thơ">Cần Thơ</option>
                            <option value="Đà Nẵng">Đà Nẵng</option>
                            <option value="Đắk Lắk">Đắk Lắk</option>
                            <option value="Đắk Nông">Đắk Nông</option>
                            <option value="Điện Biên">Điện Biên</option>
                            <option value="Đồng Nai">Đồng Nai</option>
                            <option value="Đồng Tháp">Đồng Tháp</option>
                            <option value="Gia Lai">Gia Lai</option>
                            <option value="Hà Giang">Hà Giang</option>
                            <option value="Hải Dương">Hải Dương</option>
                            <option value="Hải Phòng">Hải Phòng</option>
                            <option value="Hà Nam">Hà Nam</option>
                            <option value="Hà Nội">Hà Nội</option>
                            <option value="Hà Tĩnh">Hà Tĩnh</option>
                            <option value="Hậu Giang">Hậu Giang</option>
                            <option value="Hòa Bình">Hòa Bình</option>
                            <option value="Hưng Yên">Hưng Yên</option>
                            <option value="Khánh Hòa">Khánh Hòa</option>
                            <option value="Kiên Giang">Kiên Giang</option>
                            <option value="Kon Tum">Kon Tum</option>
                            <option value="Lai Châu">Lai Châu</option>
                            <option value="Lạng Sơn">Lạng Sơn</option>
                            <option value="Lào Cai">Lào Cai</option>
                            <option value="Lâm Đồng">Lâm Đồng</option>
                            <option value="Long An">Long An</option>
                            <option value="Nam Định">Nam Định</option>
                            <option value="Nghệ An">Nghệ An</option>
                            <option value="Ninh Bình">Ninh Bình</option>
                            <option value="Ninh Thuận">Ninh Thuận</option>
                            <option value="Phú Thọ">Phú Thọ</option>
                            <option value="Phú Yên">Phú Yên</option>
                            <option value="Quảng Bình">Quảng Bình</option>
                            <option value="Quảng Nam">Quảng Nam</option>
                            <option value="Quảng Ngãi">Quảng Ngãi</option>
                            <option value="Quảng Ninh">Quảng Ninh</option>
                            <option value="Quảng Trị">Quảng Trị</option>
                            <option value="Sóc Trăng">Sóc Trăng</option>
                            <option value="Sơn La">Sơn La</option>
                            <option value="Tây Ninh">Tây Ninh</option>
                            <option value="Thái Bình">Thái Bình</option>
                            <option value="Thái Nguyên">Thái Nguyên</option>
                            <option value="Thanh Hóa">Thanh Hóa</option>
                            <option value="Thành phố Hồ Chí Minh">Thành phố Hồ Chí Minh</option>
                            <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                            <option value="Tiền Giang">Tiền Giang</option>
                            <option value="Trà Vinh">Trà Vinh</option>
                            <option value="Tuyên Quang">Tuyên Quang</option>
                            <option value="Vĩnh Long">Vĩnh Long</option>
                            <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                            <option value="Yên Bái">Yên Bái</option>
                        </select>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__password">
                        <label for="phone">Số điện thoại</label>
                        <input id="phone" type="text" name="phone" placeholder="0123456789">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__password">
                        <label for="">Ngày sinh</label>
                        <input type="text" id="datepicker" placeholder="15-06-2005" name="birth">
                        <script>

                            flatpickr("#datepicker", {
                                dateFormat: "Y-m-d",
                                onChange: function(selectedDates, dateStr, instance) {
                                    document.querySelector('#datepicker').value = dateStr;
                                }
                            });
                        </script>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__gender">
                        <label for="password-again">Giới tính</label>
                        <div class="check">
                            <input type="radio" value="male" name="gender"> Nam
                        </div>
                        <div class="check">
                            <input type="radio" value="female" name="gender"> Nữ
                        </div>
                        <span class="form-message"></span>
                    </div>
                    <input type="text" name="starts" value="register" style="display: none">
                    <button class="contact_register">Đăng ký</button>
                </div>
            </form>
            <div class="contact">
                <div class="contact-hr">
                    <hr>
                    <span>Hoặc</span>
                    <hr>
                </div>
                <button><a href="/">Đăng nhập</a></button>
            </div>
        </div>
        <script src="./js/login.js"></script>
    <script>
        Validate({
            form: '.form',
            formParrent: '.form-items',
            rules: [
                Validate.isRequet('#name'),
                Validate.isRequet('#email'),
                Validate.isEmail('#email'),
                Validate.isPassword('#password', 6),
                Validate.isRequet('#password-again'),
                Validate.isAgain('#password-again', function() {
                    return document.querySelector('#password').value;
                }),
                Validate.isRequet('#province'),
                Validate.isRequet('#role'),
                Validate.isPassword('#phone', 9),
                Validate.isRequet('#datepicker'),
                Validate.isRequet('input[name="gender"]'),
            ],
            errorMessage: '.form-message',
            onSubmit: function(data) {
                document.querySelector('.form').submit();
            }
        })
    </script>

@endsection