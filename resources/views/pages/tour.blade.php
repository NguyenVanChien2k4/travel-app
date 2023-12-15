@extends('layouts.pages')

@section('content')

<link rel="stylesheet" href="{{ asset('./css/tour.css') }}">

<div class="body grid">
    <div class="top">
        <div class="grid__column-6">
            <div class="top__name">
                <p><i class="fa-solid fa-ticket"></i>{{$tours->id}}</p>
                <h2>{{$tours->name}}</h2>
            </div>
        </div>
        <div class="grid__column-6">
            <div class="top__price">
                <div class="top__price-sale">
                    @if($tours->sale > 0)
                        <div class="top__price-sale--item">
                            <div class="precent"><p>Giảm {{$tours->sale}} %</p></div>
                            <p class="price__custom">{{number_format($tours->price)}} đ</p>
                        </div>
                    @endif
                    <p class="price__sale">{{number_format($tours->price - ($tours->price * $tours->sale / 100))}} đ</p>
                </div>
                <div class="top__price-handle">
                    <a class="btn_booking" href="/booking?id={{$tours->id}}"><i class="fa-solid fa-cart-shopping"></i> Đặt ngay</a>
                    <a class="btn_contact" href="/contacts">Liên hệ tư vấn</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="main__inf">
            <div class="grid__column-6">
                <img src="{{$tours->img}}" alt="">
                <div class="main__inf-places">
                    <h3>Những địa điểm tham quan</h4>
                    <div class="main__inf-places--list">
                        @foreach ($toursDetails as $tourDetails)
                            @if($tourDetails->img_1 != null)
                                <div class="grid__column-3">
                                    <img src="{{ $tourDetails->img_1}}" alt="">
                                </div>
                            @endif
                            @if($tourDetails->img_2 != null)
                                <div class="grid__column-3">
                                    <img src="{{ $tourDetails->img_2}}" alt="">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="grid__column-6 right">
                <p class="desc">{{$desc}}</p>
                <div class="main__inf-content">
                    <div class="left">
                        <p>Mã tour:</p>
                        <p>Lịch trình:</p>
                        <p>Khởi hành:</p>
                        <p>Tập trung:</p>
                        <p>Nơi khởi hành:</p>
                        <p>Vận chuyển:</p>
                        <p>Mã chuyến bay:</p>
                        <p>Số chỗ còn trống:</p>
                    </div>
                    <div class="right">
                        <p>{{$tours->id}}</p>
                        <p>{{$tours->schedule}} ngày {{$tours->schedule - 1}} đêm</p>
                        <p>{{$tours->start_time}}    {{ \Carbon\Carbon::parse($tours->start_day)->format('d-m-Y')}}</p>
                        <p>{{$tours->rally_time}}    {{ \Carbon\Carbon::parse($tours->start_day)->format('d-m-Y')}}</p>
                        <p>{{$tours->desstination}}</p>
                        <p>{{$tours->transport}}</p>
                        <p>{{$tours->flight}}</p>
                        <p>{{$tours->seat - $tours->ordered}}</p>
                    </div>
                </div>
                <div class="main__inf-convenient">
                    <div class="grid__column-4">
                        <img src="./storage/time.png" alt="">
                        <p>Thời gian</p>
                        <span>{{$tours->schedule}} ngày {{$tours->schedule - 1}} đêm</span>
                    </div>
                    <div class="grid__column-4">
                        <img src="./storage/transport.png" alt="">
                        <p>Phương tiện di chuyển</p>
                        <span>{{$tours->transport}}</span>
                    </div>
                    <div class="grid__column-4">
                        <img src="./storage/visit_places.png" alt="">
                        <p>Điểm tham quan</p>
                        <span>Đại Nội, Chùa Thiên Mụ, Động Phong Nha, Khu du lịch Bà Nà, Phố cổ Hội An</span>
                    </div>
                    <div class="grid__column-4">
                        <img src="./storage/cuisine.png" alt="">
                        <p>Ẩm thực</p>
                        <span>Theo thực đơn</span>
                    </div>
                    <div class="grid__column-4">
                        <img src="./storage/hotel.png" alt="">
                        <p>Khách sạn</p>
                        <span>Khách sạn {{$tours->hotel}} sao</span>
                    </div>
                    <div class="grid__column-4">
                        <img src="./storage/time_ratinal.png" alt="">
                        <p>Thời gian lý tưởng</p>
                        <span>quanh năm</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="main__schedule">
            <h2>Lịch trình</h2>
            <div class="main__schedule-content">
                <div class="grid__column-5 left">
                    <?php $i=1; ?>
                    @foreach ($toursDetails as $tourDetails)
                        <div class="main__schedule-content--item">
                            <div class="wrapper">
                                <span class="day">Ngày </span>
                                <span class="active">{{ $i++ }}</span>
                                <div class="schedule__content-item-day">
                                    <span>{{ \Carbon\Carbon::parse($tourDetails->day)->format('d-m-Y')}}</span>
                                    <h4>{{ $tourDetails->title}}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="grid__column-7 right">
                    <?php $t=1; ?>
                    @foreach ($toursDetails as $tourDetails)
                        <div>
                            <h3>Ngày {{ $t++ }} - {{ $tourDetails->title}}</h3>
                            <div class="main__schedule-content--detail">
                                <span class="line"></span>
                                <div class="" style="text-align: justify">
                                    <div class=""><?php echo  $tourDetails->descrip; ?></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="main__note">
            <div class="grid__column-6">
                <h2>Giá tour</h2>
                <div class="main__note-content">
                    <div class="item item_left">
                        <p class="title">Độ tuổi</p>
                        <p>Người lớn (Từ 12 tuổi trở lên)</p>
                        <p>Trẻ em (Từ 5 - 11 tuổi)</p>
                        <p>Trẻ nhỏ (Từ 2 - 4 tuổi)</p>
                        <p>Em bé ( Dưới 2 tuổi )</p>
                    </div>
                    <div class="item item_right">
                        <p class="title">Giá tour</p>
                        @foreach ($priceTypes as $priceType)
                            <p>{{ number_format($priceType->precent * $tours->price / 100)}} đ</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="grid__column-6">
                <h2>Thông tin hướng dẫn viên</h2>
                <div class="main__note--right">
                    <span>HDV dẫn đoàn<h3>{{ $guide_1->name}}</h3></span>
                    <p></p>
                    <p>{{ $guide_1->address}}</p>
                    <p>{{ $guide_1->phone}}</p>
                    <span>HDV tiễn<h3>{{ $guide_2->name}}</h3></span>
                    <br>
                    <p>{{ $guide_2->address}}</p>
                    <p>{{ $guide_2->phone}}</p>
                </div>
            </div>
        </div>
        <div class="main__relation">
            <h2>Có thể bạn sẽ thích</h2>
            <div class="main__relation-list">
                @foreach($toursPropose as $tourProp)
                    <div class="main__relation-list--items grid__column-2 sm-1">
                        <a class="" href="/booking?id={{ $tourProp->id}}">
                            <img src="{{$tourProp->img}}" alt="">
                        </a>
                        <div class="relation__list-items--dicrip">
                            <p>{{ \Carbon\Carbon::parse($tourProp->start_day)->format('d-m-Y')}}   {{ $tourProp->start_time}}   {{ $tourProp->schedule}}</p>
                            <p><span>{{ $tourProp->name}}</span></p>
                            <p><i class="fa-solid fa-location-dot"></i><span>Nơi khởi hành: </span>{{ $tourProp->departure}}</p>
                        </div>
                        <div class="relation__list-items--price">
                            <p>{{ number_format($tourProp->price)}}</p>
                        </div>
                        <div class="relation__list-items--btn">
                            <a class="" href="/booking?id={{ $tourProp->id}}">
                                <button type="button" id="btn_book" class="btn_book"><i class="fa-solid fa-cart-shopping"></i> Đặt ngay</button>
                            </a>
                            <a class="" href="/tour?id={{ $tourProp->id}}">
                                <button type="button" id="btn_detail" class="btn_detail">Xem chi tiết</button>
                            </a>
                        </div>
                        <div class="relation__list-items--status action">
                            <i class="fa-solid fa-wifi"></i>
                            <p>{{ $tourProp->type_tour}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</div>

<script src="./js/handlepages.js"></script>

@include('layouts.footer')

@endsection