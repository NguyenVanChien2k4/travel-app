@extends('layouts.pages')

@section('content')

<link rel="stylesheet" href="{{ asset('./css/travel.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="body grid">
    <div class="body__link">
        <div class="body__link-item">
            <p>Trang chủ</p>
            <i class="fa-solid fa-caret-right"></i>
        </div>
        <div class="body__link-item">
            <p>Du lịch</p>
            <i class="fa-solid fa-caret-right"></i>
        </div>
        <div class="body__link-item">
            <p>{{ $title }}</p>
        </div>
    </div>
    <div class="body__mid">
        <div class="body__navbar grid__column-3">
            <div class="body__navbar-list">
                <h3>Kết quả</h3>
                <div class="body__navbar-list--item">
                    <p>{{ $title }}</p>
                </div>
            </div>
            <div class="body__navbar-list">
                <h3>Điểm đi</h3>
                <select name="start_places" id="start_places" class="start_places" onchange="updateLink('start', 'start_places', null)">
                    <option value="null">-- Chọn điểm đi --</option>
                    @foreach($start_place as $place)
                        <option value="{{ $place->departure }}" {{ $place->departure == $start ? 'selected' : '' }}>
                            {{ $place->departure }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="body__navbar-list">
                <h3>Điểm đến</h3>
                <select name="end_places" id="end_places" class="end_places" onchange="updateLink('seach', 'end_places', null)">
                    <option value="null">-- Chọn điểm đến --</option>
                    @foreach($end_place as $place)
                        @if($place->desstination) 
                            <option value="{{$place->desstination}}" {{ $place->desstination == $desstination ? 'selected' : '' }}>{{$place->desstination}}</option>
                        @endif
                        @if($place->name) 
                            <option value="{{$place->name}}" {{ $place->name == $desstination ? 'selected' : '' }}>{{$place->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="body__navbar-list">
                <h3>Số ngày</h3>
                <div class="body__navbar-list--item number_day">
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $SoNgay == '1-3' ? 'active' : ''}}" value="1-3" id="SoNgay" onclick="updateLink('SoNgay', 'SoNgay', this)">1-3 ngày</button>
                    </div>
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $SoNgay == '4-7' ? 'active' : ''}}" value="4-7" id="SoNgay" onclick="updateLink('SoNgay', 'SoNgay', this)">4-7 ngày</button>
                    </div>
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $SoNgay == '8-14' ? 'active' : ''}}" value="8-14" id="SoNgay" onclick="updateLink('SoNgay', 'SoNgay', this)">8-14 ngày</button>
                    </div>
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $SoNgay == '15' ? 'active' : ''}}" value="15" id="SoNgay" onclick="updateLink('SoNgay', 'SoNgay', this)">trên 14 ngày</button>
                    </div>
                </div>
            </div>
            <div class="body__navbar-list">
                <h3>Thời gian</h3>
                <div class="body__navbar-list--item calendar">
                    <i class="fa-solid fa-calendar"></i>
                    <input type="text" id="datepicker" value="{{ $day == 'null' ? '' : $day}}" placeholder="15-06-2005">
                    <script>
                        var selectedDateValue = "";

                        flatpickr("#datepicker", {
                            dateFormat: "Y-m-d",
                            onChange: function(selectedDates, dateStr, instance) {
                                selectedDateValue = dateStr;
                                updateLink('day', 'datepicker', null);
                            }
                        });
                    </script>
                </div>
            </div>
            <div class="body__navbar-list">
                <h3>Số người</h3>
                <div class="body__navbar-list--item number_day">
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $SoNguoi == '1' ? 'active' : ''}}" value="1" id="SoNguoi" onclick="updateLink('SoNguoi', 'SoNguoi', this)">1 người</button>
                    </div>
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $SoNguoi == '2' ? 'active' : ''}}" value="2" id="SoNguoi" onclick="updateLink('SoNguoi', 'SoNguoi', this)">2 người</button>
                    </div>
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $SoNguoi == '3' ? 'active' : ''}}" value="3" id="SoNguoi" onclick="updateLink('SoNguoi', 'SoNguoi', this)">3-5 người</button>
                    </div>
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $SoNguoi == '5' ? 'active' : ''}}" value="5" id="SoNguoi" onclick="updateLink('SoNguoi', 'SoNguoi', this)">trên 5 người</button>
                    </div>
                </div>
            </div>
            <div class="body__navbar-list">
                <h3>Dòng tour</h3>
                <div class="body__navbar-list--item number_day">
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $Dongtour == 'Cao cấp' ? 'active' : ''}}" value="Cao cấp" id="Dongtour" onclick="updateLink('Dongtour', 'Dongtour', this)">cao cấp</button>
                    </div>
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $Dongtour == 'Tiêu chuẩn' ? 'active' : ''}}" value="Tiêu chuẩn" id="Dongtour" onclick="updateLink('Dongtour', 'Dongtour', this)">tiêu chuẩn</button>
                    </div>
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $Dongtour == 'Tiết kiệm' ? 'active' : ''}}" value="Tiết kiệm" id="Dongtour" onclick="updateLink('Dongtour', 'Dongtour', this)">tiết kiệm</button>
                    </div>
                    <div class="grid__column-6">
                        <button type="button" class="btn {{ $Dongtour == 'Giá tốt' ? 'active' : ''}}" value="Giá tốt" id="Dongtour" onclick="updateLink('Dongtour', 'Dongtour', this)">giá tốt</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="body__content grid__column-9 sm-1">
            <h1>{{ $title }}</h1>
            @if($desc)
                <p>{{ $desc->desc }}</p>
            @elseif($desc_type)
                <p>{{ $desc_type }}</p>
            @endif
            <div class="body__content-list">
                @foreach ($tours as $tour)
                    <div class="body__content-list--items grid__column-4 sm-1">
                        <a href="/tour?id={{ $tour->id}}">
                            <img src="{{ $tour->img}}" alt="">
                        </a>
                        <div class="content__list-items--dicrip">
                            <p>{{ $tour->start_day}}   {{ $tour->start_time}}</p>
                            <p><span>{{ $tour->name}}</span></p>
                            <p><i class="fa-solid fa-ticket"></i></i><span>Mã tour: </span> {{ $tour->id}}</p>
                            <p><i class="fa-solid fa-location-dot"></i><span>Nơi khởi hành: </span>{{ $tour->departure}}</p>
                            <p><i class="fa-regular fa-clock"></i><span>Lịch trình: </span>{{ $tour->schedule}}</p>
                        </div>
                        <div class="content__list-items--price">
                            <p>{{ number_format($tour->price - ($tour->price * $tour->sale / 100))}} đ</p>
                            @if($tour->sale > 0)
                                <div class="content__list-items--price-sale">
                                    <div class="precent"><p>Giảm {{$tour->sale}} %</p></div>
                                    <p class="price__custom">{{number_format($tour->price)}} đ</p>
                                </div>
                            @endif
                        </div>
                        <div class="content__list-items--btn">
                            <a class="" href="/booking?id={{ $tour->id}}">
                                <button type="button" id="btn_book" class="btn_book"><i class="fa-solid fa-cart-shopping"></i> Đặt ngay</button>
                            </a>
                            <a class=""href="/tour?id={{ $tour->id}}">
                                <button type="button" id="btn_detail" class="btn_detail">Xem chi tiết</button>
                            </a>
                        </div>
                        <div class="content__list-items--empty">
                            <p>Số chỗ trống </p><span>{{ $tour->seat - $tour->ordered}}</span>
                        </div>
                        <div class="content__list-items--status action">
                            <i class="fa-solid fa-wifi"></i>
                            <p>{{ $tour->type_tour}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="body__order">
                <?php 
                    if($page > 1 && $totalPage > 1) {
                        echo '<div class="body__order-items">
                                <button id="NumberPages" value="' . ($page - 1) . '" onclick="updateLink(\'page\', \'NumberPages\', this)">
                                    <i class="fa-solid fa-caret-left"></i>
                                </button>
                            </div>';
                    }
                    for ($i = 1; $i <= $totalPage; $i++){ 
                        if ($i == $page) {
                            if($page > 1) {
                                echo '<div class="body__order-items action">
                                        <button id="NumberPages" value="' . $i . '" onclick="updateLink(\'page\', \'NumberPages\', this)">' . $i . '</button>
                                    </div>'; 
                            }
                        } else { 
                            echo '<div class="body__order-items">
                                <button id="NumberPages" value="' . $i . '" onclick="updateLink(\'page\', \'NumberPages\', this)">' . $i . '</button>
                            </div>';
                        }
                    }
                    if ($page < $totalPage && $totalPage > 1){ 
                        echo '<div class="body__order-items">
                                <button id="NumberPages" value="' . ($page + 1) . '" onclick="updateLink(\'page\', \'NumberPages\', this)">
                                    <i class="fa-solid fa-caret-right"></i>
                                </button>
                            </div>'; 
                    }
                                        
                ?>
            </div>
            <div class="body__popular">
                <h2>Được tìm kiếm phổ biến</h2>
                <div class="">
                    @foreach($picks as $pick)
                        <div class="body__popular-items">
                            <a href="/travel?seach={{$pick->name}}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <p>{{ $pick->name }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn.active {
        background-color: #1262e4;
        color: #fff;
    }
</style>

<script src="./js/handlepages.js"></script>

<script>
    
    var currentURL = window.location.href;

    function updateLink(key, id, button) {
        var updatedURL = updateURLParameter(key.trim(), id, button);

        window.location.href = updatedURL;
    }

    function updateURLParameter(key, id, button) {

        var regex = new RegExp('([?&])' + key + '=.*?(&|$)', 'i');
        var separator = currentURL.indexOf('?') !== -1 ? '&' : '?';

        if(button) {
            var value = button.value;
            console.log(value);
        } else {
            var value = document.getElementById(id).value;
        }
        
        if (currentURL.match(regex)) {
            return currentURL.replace(regex, '$1' + key + '=' + value + '$2');
        } else {
            if(key == 'seach') {
                return currentURL + separator + key + '=' + value;
            } else {
                return currentURL + "&" + key + "=" + value;
            }
        }

    }

</script>

@include('layouts.footer');

@endsection