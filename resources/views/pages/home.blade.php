@extends('layouts.pages')

@section('content')

<link rel="stylesheet" href="{{ asset('./css/home.css') }}">

<div class="header__bg">
    <div class="header__bg-bgtop">
        <img src="./storage/bg_1.1.png" alt="">
        <div class="header__bg-bgtop-content">
            <h4>Go with me</h4>
            <h1>Let's share the great things
                <span>in life</span>
            </h1>
        </div>
        <ul class="header__bg-bgtop-order">
            <li>
                <button class="bgtop__order-btn"></button>
            </li>
            <li>
                <button class="bgtop__order-btn"></button>
            </li>
            <li>
                <button class="bgtop__order-btn"></button>
            </li>
        </ul>
        <div class="header__bg-bgtop-btn right">
            <i class="fa-sharp fa-solid fa-chevrons-left"></i>
        </div>
        <form class="form" id="form" action="/travel" method="GET" enctype="multipart/form-data">
            <div class="header__bg-bgtop-search form-items">
                <input type="text" placeholder="Enter search...." name="seach" class="title">
                <div class="search__items-icon close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="search__items">
                    <div class="search__items-line"></div>
                    <a class="search__items-icon">
                        <i class="fa-solid fa-microphone"></i>
                    </a>
                    <button class="search__items-icon" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <span class="form-message" hidden></span>
            </div>
        </form>
    </div>
    <div class="header__bg-items">
        <div class="header__items-up">
            <i class="fa-solid fa-chevron-up"></i>
        </div>
        <div class="header__items-list action">
            <div class="items-list-icons down">
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="items-list-icons">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <div class="items-list-icons">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <div class="items-list-icons">
                <i class="fa-solid fa-phone-volume"></i>
            </div>
            <div class="items-list-icons">
                <i class="fa-brands fa-youtube"></i>
            </div>
        </div>
        <div class="header__items-message">
            <i class="fa-brands fa-facebook-messenger"></i>
        </div>
    </div>
</div>
<div class="body grid">
    <div class="body__diary">
        @foreach($groups as $group)
            <a class="body__diary-list" href="/travel?type={{$group->id}}">
                <span class="img">
                    <img src="{{$group->icon}}" alt="">
                </span>
                <p>Tour <span> {{$group->name}}</span></p>
            </a>
        @endforeach
    </div>
    <div class="body__event">
        <h2>Ưu đãi lớn</h2>
        @foreach ($sales as $sale)
            <p style="display: none;" class="imgSale" data-mydata="{{ $sale->name }}">{{ $sale->img}}</p>
        @endforeach
        <div class="body__event-list" id="imageContainer"></div>
        <script>
            
            var imageSale = [];
            var imageLinks = [];
            const imageArray = document.querySelectorAll('.imgSale');
    
            imageArray.forEach(function(element) {
                imageSale.push({
                    src: element.innerText,
                    link: element.dataset.mydata
                });
            })

            document.addEventListener("DOMContentLoaded", function () {

                var currentIndex = 2; 
                
                function autoRefresh() {
                    currentIndex = (currentIndex + 1) % imageSale.length;

                    updateImages();

                    setTimeout(autoRefresh, 4000); 
                }

                function updateImages() {
                    var numImagesToShow = 3;
                    var shownImages = [];

                    for (var i = currentIndex; i < currentIndex + numImagesToShow; i++) {
                        var index = i % imageSale.length;
                        shownImages.push(imageSale[index]);
                    }

                    var imageContainer = document.getElementById('imageContainer');
                    imageContainer.innerHTML = '';

                    shownImages.forEach(function (imgPath) {
                        var imageElement = document.createElement('div');
                        imageElement.className = 'body__event-list--item grid__column-4 sm-1';

                        imageElement.innerHTML = '<a href="/travel?seach=' + imgPath.link + '"><img src="' + imgPath.src + '" alt=""></a>';
                        imageContainer.appendChild(imageElement);

                    });
                }

                autoRefresh();

            });
        </script>
    </div>
    <div class="body__tour">
        <h2>Tour giờ chót</h2>
        <div class="body__tour-list">
            @foreach( $tours_near as $tour_near)
                <div class="body__tour-list--item grid__column-4">
                    <div class="tour__list-item--box">
                        <a class="" href="/tour?id={{ $tour_near->id}}">
                            <img src="{{ $tour_near->img }}" alt="">
                            <div class="tour__list-item--box_address">Từ {{ $tour_near->departure }}</div>
                            <div class="tour__list-item--box_time">
                                <i class="fa-solid fa-clock"></i>
                                <p hidden class="time_{{$tour_near->id}}">{{ $tour_near->start_day }}</p>
                                <p id="countdown_{{$tour_near->id}}"></p>
                                <script>

                                    var now = new Date();
                                    var end_{{$tour_near->id}} = new Date(document.querySelector('.time_{{$tour_near->id}}').innerText);
                                
                                    var timeLeft_{{$tour_near->id}} = end_{{$tour_near->id}} - now;
                                
                                    var countdown = setInterval(function() {
                                        timeLeft_{{$tour_near->id}} = timeLeft_{{$tour_near->id}} - 1000;
                                
                                        if (timeLeft_{{$tour_near->id}} <= 0) {
                                            clearInterval(countdown);
                                            document.getElementById("countdown_{{$tour_near->id}}").innerHTML = "Thời gian đã hết";
                                        } else {
                                            var day_{{$tour_near->id}} = Math.floor(timeLeft_{{$tour_near->id}} / (1000 * 60 * 60 * 24));
                                            var hours_{{$tour_near->id}} = Math.floor((timeLeft_{{$tour_near->id}} / (1000 * 60 * 60)) % 24);
                                            var minutes_{{$tour_near->id}} = Math.floor((timeLeft_{{$tour_near->id}} / 1000 / 60) % 60);
                                            var seconds_{{$tour_near->id}} = Math.floor((timeLeft_{{$tour_near->id}} / 1000) % 60);

                                            document.getElementById("countdown_{{$tour_near->id}}").innerText = "Còn " + day_{{$tour_near->id}} + " ngày " + hours_{{$tour_near->id}} + ":" + minutes_{{$tour_near->id}} + ":" + seconds_{{$tour_near->id}};
                                        }
                                    }, 1000);
                                </script>
                            </div>
                        </a>
                    </div>
                    <div class="tour__list-item--inf">
                        <h3>
                            <a>{{ $tour_near->name }}</a>
                        </h3>
                        <div class="btlii__schedule">
                            <div>
                                <i class="fa-regular fa-clock"></i>
                                <p>{{ $tour_near->schedule }} ngày {{ $tour_near->schedule - 1 }} đêm</p>
                            </div>
                            <div>
                                <i class="fa-solid fa-calendar-days"></i>
                                <p>Khởi hành: {{ \Carbon\Carbon::parse($tour_near->start_day)->format('d-m-Y')}}</p>
                            </div>
                            <div>
                                <i class="fa-regular fa-user"></i>
                                <p>Còn <span style="color: red">{{ $tour_near->seat - $tour_near->ordered}}</span> chỗ</p>
                            </div>
                        </div>
                        <div class="btlii__price">
                            @if($tour_near->sale > 0)
                                <p class="price__custom">{{ number_format($tour_near->price)}} đ</p>
                            @endif
                            <p>{{ number_format($tour_near->price - ($tour_near->price * $tour_near->sale / 100))}} đ</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="body__tour domestic">
        <h2>Tour trong nước</h2>
        <div class="body__tour-list">
            @foreach($tours_in as $tour_in)
                <div class="body__tour-list--item grid__column-3">
                    <div class="tour__list-item--box">
                        <a class="" href="/tour?id={{ $tour_in->id}}">
                            <img src="{{ $tour_in->img }}" alt="">
                            <div class="tour__list-item--box_address">Từ {{ $tour_in->departure }}</div>
                        </a>
                    </div>
                    <div class="tour__list-item--inf">
                        <h3>
                            <a>{{ $tour_in->name}}</a>
                        </h3>
                        <div class="btlii__schedule">
                            <div>
                                <i class="fa-regular fa-clock"></i>
                                <p>{{ $tour_in->schedule}} ngày {{ $tour_in->schedule - 1 }} đêm</p>
                            </div>
                            <div>
                                <i class="fa-solid fa-calendar-days"></i>
                                <p>{{ \Carbon\Carbon::parse($tour_in->start_day)->format('d-m-Y')}}</p>
                            </div>
                            <div>
                                <i class="fa-regular fa-user"></i>
                                <p>Còn <span style="color: red">{{ $tour_in->seat - $tour_in->ordered}}</span> chỗ</p>
                            </div>
                        </div>
                        <div class="btlii__price">
                            @if($tour_in->sale > 0)
                                <p class="price__custom">{{ number_format($tour_in->price)}} đ</p>
                            @endif
                            <p>{{ number_format($tour_in->price - ($tour_in->price * $tour_in->sale / 100))}} đ</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="body__interet">
        <h2>Được yêu thích nhất</h2>
        <ul class="body__interet-list">
            @foreach ($picks as $pick) 
                <li class="body__interet-list--items grid__column-3 sm-5">
                    <div class="list__items-img">
                        <img src="{{ $pick->img}}" alt="">
                        <div class="list__items-img--above">
                            <a href="/travel?seach={{ $pick->name}}">Xem thêm</a>
                        </div>
                    </div>
                    <h4>{{ $pick->name}}</h4>
                    <div class="interet__items-content">
                        <i class="fa-solid fa-eye"></i>
                        <span> {{ $pick->picks}} lượt khách</span>
                    </div>
                    {{-- <div class="interet__items-content">
                        <i class="fa-solid fa-heart"></i>
                        <span> 99.999 lượt thích</span>
                    </div> --}}
                </li>
            @endforeach
        </ul>
    </div>
</div>
<script src="./js/handlepages.js"></script>

<script>
    const form = document.getElementById('form');
    form.onsubmit = (e) => {
        const value = document.querySelector('.form-items input').value;
        if (value != '') {
            form.submit();
        } else {
            e.preventDefault();
            alert('Please enter');
        }
    }
</script>

@include('layouts.footer')

@endsection