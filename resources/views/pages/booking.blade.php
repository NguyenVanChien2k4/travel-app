@extends('layouts.pages')

@section('content')

<link rel="stylesheet" href="{{ asset('./css/booking.css') }}">

<?php 
    $currentDate = new DateTime();
?>

<div class="body grid">
    <div class="body__heading">
        <div class="body__heading-img">
            <img src="./storage/danmach.jpg" alt="">
        </div>
        <div class="grid__column-8">
            <p class="title">
                {{$tour->type_tour}}
                @if($tour->sale > 0)
                    <span> Giảm {{$tour->sale}} %</span>
                @endif
            </p>
            <h3>{{$tour->name}}</h3>
            <div class="body__heading-inf">
                <div class="body__heading-inf--content">
                    <div class="left">
                        <p>Mã tour:</p>
                        <p>Lịch trình:</p>
                        <p>Khởi hành:</p>
                        <p>Nơi khởi hành:</p>
                        <p>Số chỗ còn trống:</p>
                    </div>
                    <div class="right">
                        <p>{{$tour->id}}</p>
                        <p>{{$tour->schedule}} ngày {{$tour->schedule - 1}} đêm</p>
                        <p>{{$tour->start_time}}    {{\Carbon\Carbon::parse($tour->start_day)->format('d-m-Y')}}</p>
                        <p>{{$tour->desstination}}</p>
                        <p class="total">{{$tour->seat - $tour->ordered}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body__main">
        <h2>Tổng quan chuyến đi</h2>
        <form class="form" id="form" action="/bookings" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="wrapper">
                <div class="grid__column-7 left">
                    <h3>Thông tin cá nhân</h3>
                    <div class="wrapper__inf">
                        <div class="form-items grid__column-6">
                            <p><span>*</span>Họ tên</p>
                            <input type="text" id="name" name="name" value="{{$user->name}}" placeholder="Nguyen Van A">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-items grid__column-6">
                            <p><span>*</span>Email</p>
                            <input type="text" id="email" name="email" value="{{$user->email}}" placeholder="abc@gmail.com">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-items grid__column-6">
                            <p><span>*</span>Số điện thoại</p>
                            <input type="text" id="sdt" name="phone" value="{{$user->phone}}" placeholder="0123456789">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-items grid__column-6">
                            <p>Địa chỉ</p>
                            <input type="text" id="address" name="address" value="{{$user->address}}" placeholder="">
                            <span class="form-message"></span>
                        </div>
                    </div>
                    <h3>Khách hàng</h3>
                    <div class="wrapper__client">
                        <div class="wrapper__client-item">
                            <div class="left">
                                <p>Người lớn</p>
                                <span>> 12 tuổi</span>
                            </div>
                            <div class="right 1">
                                <i class="minus fa-solid fa-minus"></i>
                                <span class="quantity">1</span>
                                <i class="plus fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="wrapper__client-item">
                            <div class="left">
                                <p>Trẻ em</p>
                                <span>Từ 5-11 tuổi</span>
                            </div>
                            <div class="right 2">
                                <i class="minus fa-solid fa-minus"></i>
                                <span class="quantity">0</span>
                                <i class="plus fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="wrapper__client-item">
                            <div class="left">
                                <p>Trẻ nhỏ</p>
                                <span>Từ 2-4 tuổi</span>
                            </div>
                            <div class="right 3">
                                <i class="minus fa-solid fa-minus"></i>
                                <span class="quantity">0</span>
                                <i class="plus fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="wrapper__client-item">
                            <div class="left">
                                <p>Em bé</p>
                                <span>Từ 0-2 tuổi</span>
                            </div>
                            <div class="right 4">
                                <i class="minus fa-solid fa-minus"></i>
                                <span class="quantity">0</span>
                                <i class="plus fa-solid fa-plus"></i>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper__oldLimit">
                        <div class="grid__column-6">
                            <p>- Người lớn sinh trước ngày <span>{{ $currentDate->sub(new DateInterval('P12Y'))->format("d-m-Y") }}</span></p>
                        </div>
                        <div class="grid__column-6">
                            <p>- Trẻ em sinh từ <span>{{ $currentDate->format("d-m-Y") }}</span> đến <span>{{ $currentDate->add(new DateInterval('P7Y'))->format("d-m-Y") }}</span></p>
                        </div>
                        <div class="grid__column-6">
                            <p>- Trẻ con sinh từ <span>{{ $currentDate->format("d-m-Y") }}</span> đến <span>{{ $currentDate->add(new DateInterval('P3Y'))->format("d-m-Y") }}</span></p>
                        </div>
                        <div class="grid__column-6">
                            <p>- Em bé sinh từ <span>{{ $currentDate->format("d-m-Y") }}</span> đến <span>{{ $currentDate->add(new DateInterval('P2Y'))->format("d-m-Y") }}</span></p>
                        </div>
                    </div>
                    <div class="wrapper__note">
                        <h3>Lưu ý thêm</h3>
                        <textarea name="note" id="" placeholder="Vui lòng nhập nội dung ..... "></textarea>
                    </div>
                </div>
                <div class="grid__column-5 right">
                    <div class="wrapper__pay form-items">
                        <h3>Chọn hình thức thanh toán</h3>
                        <div class="wrapper__pay-item">
                            <input id="pay" type="radio" name="pay" value="live"><span>Thanh toán trực tiếp tại các văn phòng thuộc công ty</span>
                        </div>
                        <div class="wrapper__pay-item">
                            <input id="pay" type="radio" name="pay" value="momo"><span>Thanh toán qua MOMO</span>
                        </div>
                        <div class="wrapper__pay-item">
                            <input id="pay" type="radio" name="pay" value="vietelpay"><span>Thanh toán qua Vietel Pay</span>
                        </div>
                        <div class="wrapper__pay-item">
                            <input id="pay" type="radio" name="pay" value="banks"><span>Thanh toán trực tuyến qua hệ thống liên ngân hàng</span>
                        </div>
                        <div class="wrapper__pay-item">
                            <input id="pay" type="radio" name="pay" value="mbbank"><span>Thanh toán trực tuyến qua ngân hàng MB Bank</span>
                        </div>
                        <span class="form-message"></span>
                    </div>
                    <div class="wrapper__detail">
                        <h4>Hành khách</h4>
                        <div class="wrapper__detail-list">
                            <div class="left">
                                <p>Người lớn</p>
                                <p>Trẻ em</p>
                                <p>Trẻ con</p>
                                <p>Em bé</p>
                            </div>
                            <div class="right">
                                <p class="right__1">1 x {{ number_format($tour->price)}} đ</p>
                                <p class="right__2">0 đ</p>
                                <p class="right__3">0 đ</p>
                                <p class="right__4">0 đ</p>
                            </div>
                        </div>
                        <input type="text" hidden value="{{ $tour->price}}" id="price_system">
                        @foreach ($typePrices as $typePrice)
                            <input type="text" hidden value="{{ $typePrice->precent}}" id="type__price-{{$typePrice->id}}">
                            <input type="text" name="type_{{ $typePrice->id}}" hidden value="0" id="type_{{ $typePrice->id}}">
                        @endforeach
                        <input type="text" name="id_tour" hidden value="{{ $tour->id}}">
                        <input type="text" id="price" hidden value="{{ $tour->price}}" name="price">
                        <input type="text" id="price_sale" hidden value="{{ $tour->sale + $precent}}" name="price_sale">
                        <div class="line"></div>
                        <div class="wrapper__detail-total">
                            <h3>Tổng cộng</h3>
                            <div class="content__list-items--price">
                                @if($tour->sale + $precent > 0)
                                    <p class="price__custom">{{number_format($tour->price)}} đ<span> - {{ $tour->sale + $precent}} %</span></p>
                                @endif
                                <p class="price_now">{{ number_format($tour->price - ($tour->price * $tour->sale / 100))}} đ</p>
                            </div>
                        </div>
                        <div class="wrapper__detail-button">
                            <button type="submit">Đặt ngay</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
            Validate.isPassword('#sdt', 9),
            Validate.isRequet('input[name="pay"]')
        ],
        errorMessage: '.form-message',
        onSubmit: function(data) {
            document.querySelector('.form').submit();
        }
    })
</script>

@include('layouts.footer')

@endsection