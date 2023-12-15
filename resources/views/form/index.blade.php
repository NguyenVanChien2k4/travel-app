<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('./css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Document</title>
</head>
<body>
    <div>
        <div class="body">
            <form class="form" id="form" action="/account-edit" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="header">
                    <h2>Thông tin cá nhân</h2>
                </div>
                <div class="form-body">
                    <div class="form-items form__name">
                        <label for="name">Họ tên</label>
                        <input id="name" value="{{$user->name}}" type="text" name="name" placeholder="VD: Truong Thi Thanh Lam">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__email">
                        <label for="email">Email</label>
                        <input id="email" value="{{$user->email}}" type="email" name="email" placeholder="VD: lam@gmail.com" readonly>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__password">
                        <label for="password">Mật khẩu</label>
                        <input id="password" value="{{$user->password}}" type="password" name="password" placeholder="Mật khẩu">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__password-again">
                        <label for="password-again">Nhập lại mật khẩu</label>
                        <input id="password-again" value="{{$user->password}}" type="password" name="password-again" placeholder="VD: Nhập lại mật khẩu">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items">
                        <label for="provinse">Tỉnh/TP</label>
                        <select name="province" id="province" class="province">
                            <option value="">-- Chọn Tỉnh/TP --</option>
                            <option {{ $user->address === 'An Giang' ? 'selected' : '' }} value="An Giang">An Giang</option>
                            <option {{ $user->address === 'Bạc Liêu' ? 'selected' : '' }} value="Bạc Liêu">Bạc Liêu</option>
                            <option {{ $user->address === 'Bà Rịa - Vũng Tàu' ? 'selected' : '' }} value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                            <option {{ $user->address === 'Bắc Giang' ? 'selected' : '' }} value="Bắc Giang">Bắc Giang</option>
                            <option {{ $user->address === 'Bắc Kạn' ? 'selected' : '' }} value="Bắc Kạn">Bắc Kạn</option>
                            <option {{ $user->address === 'Bắc Ninh' ? 'selected' : '' }} value="Bắc Ninh">Bắc Ninh</option>
                            <option {{ $user->address === 'Bến Tre' ? 'selected' : '' }} value="Bến Tre">Bến Tre</option>
                            <option {{ $user->address === 'Bình Dương' ? 'selected' : '' }} value="Bình Dương">Bình Dương</option>
                            <option {{ $user->address === 'Bình Định' ? 'selected' : '' }} value="Bình Định">Bình Định</option>
                            <option {{ $user->address === 'Bình Phước' ? 'selected' : '' }} value="Bình Phước">Bình Phước</option>
                            <option {{ $user->address === 'Bình Thuận' ? 'selected' : '' }} value="Bình Thuận">Bình Thuận</option>
                            <option {{ $user->address === 'Cà Mau' ? 'selected' : '' }} value="Cà Mau">Cà Mau</option>
                            <option {{ $user->address === 'Cao Bằng' ? 'selected' : '' }} value="Cao Bằng">Cao Bằng</option>
                            <option {{ $user->address === 'Cần Thơ' ? 'selected' : '' }} value="Cần Thơ">Cần Thơ</option>
                            <option {{ $user->address === 'Đà Nẵng' ? 'selected' : '' }} value="Đà Nẵng">Đà Nẵng</option>
                            <option {{ $user->address === 'Đắk Lắk' ? 'selected' : '' }} value="Đắk Lắk">Đắk Lắk</option>
                            <option {{ $user->address === 'Đắk Nông' ? 'selected' : '' }} value="Đắk Nông">Đắk Nông</option>
                            <option {{ $user->address === 'Điện Biên' ? 'selected' : '' }} value="Điện Biên">Điện Biên</option>
                            <option {{ $user->address === 'Đồng Nai' ? 'selected' : '' }} value="Đồng Nai">Đồng Nai</option>
                            <option {{ $user->address === 'Đồng Tháp' ? 'selected' : '' }} value="Đồng Tháp">Đồng Tháp</option>
                            <option {{ $user->address === 'Gia Lai' ? 'selected' : '' }} value="Gia Lai">Gia Lai</option>
                            <option {{ $user->address === 'Hà Giang' ? 'selected' : '' }} value="Hà Giang">Hà Giang</option>
                            <option {{ $user->address === 'Hải Dương' ? 'selected' : '' }} value="Hải Dương">Hải Dương</option>
                            <option {{ $user->address === 'Hải Phòng' ? 'selected' : '' }} value="Hải Phòng">Hải Phòng</option>
                            <option {{ $user->address === 'Hà Nam' ? 'selected' : '' }} value="Hà Nam">Hà Nam</option>
                            <option {{ $user->address === 'Hà Nội' ? 'selected' : '' }} value="Hà Nội">Hà Nội</option>
                            <option {{ $user->address === 'Hà Tĩnh' ? 'selected' : '' }} value="Hà Tĩnh">Hà Tĩnh</option>
                            <option {{ $user->address === 'Hậu Giang' ? 'selected' : '' }} value="Hậu Giang">Hậu Giang</option>
                            <option {{ $user->address === 'Hòa Bình' ? 'selected' : '' }} value="Hòa Bình">Hòa Bình</option>
                            <option {{ $user->address === 'Hưng Yên' ? 'selected' : '' }} value="Hưng Yên">Hưng Yên</option>
                            <option {{ $user->address === 'Khánh Hòa' ? 'selected' : '' }} value="Khánh Hòa">Khánh Hòa</option>
                            <option {{ $user->address === 'Kiên Giang' ? 'selected' : '' }} value="Kiên Giang">Kiên Giang</option>
                            <option {{ $user->address === 'Kon Tum' ? 'selected' : '' }} value="Kon Tum">Kon Tum</option>
                            <option {{ $user->address === 'Lai Châu' ? 'selected' : '' }} value="Lai Châu">Lai Châu</option>
                            <option {{ $user->address === 'Lạng Sơn' ? 'selected' : '' }} value="Lạng Sơn">Lạng Sơn</option>
                            <option {{ $user->address === 'Lào Cai' ? 'selected' : '' }} value="Lào Cai">Lào Cai</option>
                            <option {{ $user->address === 'Lâm Đồng' ? 'selected' : '' }} value="Lâm Đồng">Lâm Đồng</option>
                            <option {{ $user->address === 'Long An' ? 'selected' : '' }} value="Long An">Long An</option>
                            <option {{ $user->address === 'Nam Định' ? 'selected' : '' }} value="Nam Định">Nam Định</option>
                            <option {{ $user->address === 'Nghệ An' ? 'selected' : '' }} value="Nghệ An">Nghệ An</option>
                            <option {{ $user->address === 'Ninh Bình' ? 'selected' : '' }} value="Ninh Bình">Ninh Bình</option>
                            <option {{ $user->address === 'Ninh Thuận' ? 'selected' : '' }} value="Ninh Thuận">Ninh Thuận</option>
                            <option {{ $user->address === 'Phú Thọ' ? 'selected' : '' }} value="Phú Thọ">Phú Thọ</option>
                            <option {{ $user->address === 'Phú Yên' ? 'selected' : '' }} value="Phú Yên">Phú Yên</option>
                            <option {{ $user->address === 'Quảng Bình' ? 'selected' : '' }} value="Quảng Bình">Quảng Bình</option>
                            <option {{ $user->address === 'Quảng Nam' ? 'selected' : '' }} value="Quảng Nam">Quảng Nam</option>
                            <option {{ $user->address === 'Quảng Ngãi' ? 'selected' : '' }} value="Quảng Ngãi">Quảng Ngãi</option>
                            <option {{ $user->address === 'Quảng Ninh' ? 'selected' : '' }} value="Quảng Ninh">Quảng Ninh</option>
                            <option {{ $user->address === 'Quảng Trị' ? 'selected' : '' }} value="Quảng Trị">Quảng Trị</option>
                            <option {{ $user->address === 'Sóc Trăng' ? 'selected' : '' }} value="Sóc Trăng">Sóc Trăng</option>
                            <option {{ $user->address === 'Sơn La' ? 'selected' : '' }} value="Sơn La">Sơn La</option>
                            <option {{ $user->address === 'Tây Ninh' ? 'selected' : '' }} value="Tây Ninh">Tây Ninh</option>
                            <option {{ $user->address === 'Thái Bình' ? 'selected' : '' }} value="Thái Bình">Thái Bình</option>
                            <option {{ $user->address === 'Thái Nguyên' ? 'selected' : '' }} value="Thái Nguyên">Thái Nguyên</option>
                            <option {{ $user->address === 'Thanh Hóa' ? 'selected' : '' }} value="Thanh Hóa">Thanh Hóa</option>
                            <option {{ $user->address === 'Thành phố Hồ Chí Minh' ? 'selected' : '' }} value="Thành phố Hồ Chí Minh">Thành phố Hồ Chí Minh</option>
                            <option {{ $user->address === 'Thừa Thiên Huế' ? 'selected' : '' }} value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                            <option {{ $user->address === 'Tiền Giang' ? 'selected' : '' }} value="Tiền Giang">Tiền Giang</option>
                            <option {{ $user->address === 'Trà Vinh' ? 'selected' : '' }} value="Trà Vinh">Trà Vinh</option>
                            <option {{ $user->address === 'Tuyên Quang' ? 'selected' : '' }} value="Tuyên Quang">Tuyên Quang</option>
                            <option {{ $user->address === 'Vĩnh Long' ? 'selected' : '' }} value="Vĩnh Long">Vĩnh Long</option>
                            <option {{ $user->address === 'Vĩnh Phúc' ? 'selected' : '' }} value="Vĩnh Phúc">Vĩnh Phúc</option>
                            <option {{ $user->address === 'Yên Bái' ? 'selected' : '' }} value="Yên Bái">Yên Bái</option>
                        </select>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-items form__password">
                        <label for="phone">Số điện thoại</label>
                        <input id="phone" value="{{$user->phone}}" type="phone" name="phone" placeholder="0123456789">
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
                            <input type="radio" value="male" name="gender" {{ $user->gender === 'male' ? 'checked' : '' }}> Nam
                        </div>
                        <div class="check">
                            <input type="radio" value="female" name="gender" {{ $user->gender === 'female' ? 'checked' : '' }}> Nữ
                        </div>
                        <span class="form-message"></span>
                    </div>
                    <button type="submit">Update</button>
                </div>
            </form>
            <div class="contact">
                <div class="contact-hr">
                    <hr>
                    <span>Hoặc</span>
                    <hr>
                </div>
                <button class="contact_register"><a href="/account">Quay lại</a></button>
            </div>
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
</body>
</html>