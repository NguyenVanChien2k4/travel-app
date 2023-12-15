@extends('layouts.pages')

@section('content')

<link rel="stylesheet" href="{{ asset('./css/account.css') }}">

<?php 
    use Carbon\Carbon;

    $currentDate = Carbon::now();
    $threeDaysAgo = $currentDate->subDays(3);
?>

<div class="body grid">
    <div class="body__header">
        <div class="grid__column-3">
            <form class="form" id="form" action="/avatarUpdate" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="avatar-container" style="position: relative">
                    <div class="body__avata">
                        <img id="avatarImage" src="{{$user->avatar}}" alt="">
                    </div>
                    <div class="body__camera">
                        <input type="file" name="avatar" id="avatarInput" style="display: none;">
                        <button type="button" id="uploadButton" onclick="handleImage()">
                            <i class="fa-solid fa-camera"></i>
                        </button>
                    </div>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
                <script>
                    const $ = document.querySelector.bind(document);
                    const $$ = document.querySelectorAll.bind(document);
                    handleImage = function() {
                        const form = $('#form');
                        $('#avatarInput').click();
                        $('#avatarInput').onchange = function() {
                            var valueAvatar = $('#avatarInput').value;
                
                            var input = this;
                            var reader = new FileReader();
                
                            reader.onload = function(e) {
                                document.getElementById('avatarImage').setAttribute('src', e.target.result);
                            };
                            
                            reader.readAsDataURL(input.files[0]);
                            
                            form.submit(function(e) {
                                // console.log(form);
                                // console.log(input);
                                e.preventDefault();
                                var formData = new FormData(this);
                                formData.append('avatar', $('#avatarImage').attr('src'));
                    
                                $.ajax({
                                    method: "POST",
                                    url: $(this).attr('action'),
                                    data: formData,
                                    
                                })
                                .done(function(data) {
                                    alert('Thay đổi ảnh đại diện thành công!!');
                                })
                                .fail(function(data) {
                                });
                                return true;
                            });
                        };
                    
                    };
                
                </script>
            </form>
            <h2>{{$user->name}}</h3>
        </div>
        <div class="body__header-list grid__column-9">
            <h3>Các tour đã đăng ký</h3>
            @foreach ($bookings as $booking)
                <div class="body__header-item">
                    <div class="body__header-item--title">
                        <h4>{{$booking->tour->name}}</h4>
                        <span>{{\Carbon\Carbon::parse($booking->tour->start_day)->format('d-m-Y')}}  đến  {{\Carbon\Carbon::parse($booking->tour->end_day)->format('d-m-Y')}}
                              - Người lớn:{{$booking->adult}} - Trẻ em:{{$booking->children}} - Trẻ con:{{$booking->young}} - Em bé:{{$booking->baby}}</span>
                    </div>
                    <div class="body__header-item--price">
                        @if($booking->sale > 0)
                            <p class="custom">{{number_format($booking->price)}} đ</p>
                        @endif
                        <p class="sale">{{number_format($booking->price - ($booking->price * $booking->sale / 100))}} đ</p>
                    </div>
                    <div class="body__header-item--btn">
                        @php
                            $tourStartDate = Carbon::parse($booking->tour->start_day);
                        @endphp
                        <form action="{{ url('/tour/' . $booking->id) }}" method="post">
                            @csrf
                            @method('delete')
                            @if ($booking->tour->status === 0)
                                <button class="btn btn-over">Hết hạn</button>
                            @elseif($threeDaysAgo->gt($tourStartDate))
                                <button type="submit" class="btn btn-delete active">Hủy</button>
                            @else 
                                <button type="submit" class="btn btn-delete">Hủy</button>
                            @endif
                            <script>
                                var btnDelete3D = document.querySelector('.btn-delete.active');
                                var btnDelete = document.querySelector('.btn-delete');
                                if(btnDelete3D) {
                                    btnDelete3D.addEventListener('click', function(event) {
                                        var confirmRedirect = confirm('Bởi vì thời gian chỉ còn không quá 3 ngày nên nếu bạn hủy thì sẽ mất 50% số tiền!! Bạn xác nhận hủy?');
                                        if (!confirmRedirect) {
                                            event.preventDefault();
                                        }
                                    });
                                } else if(btnDelete) {
                                    btnDelete.addEventListener('click', function(event) {
                                        var confirmRedirect = confirm('Xác nhận hủy?');
                                        if (!confirmRedirect) {
                                            event.preventDefault();
                                        }
                                    });
                                }

                            </script>
                        </form>
                        <a href="/tour?id={{$booking->id}}"><button class="btn btn-show">Xem</button></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="body__content">
        <div class="body__content-inf grid__column-5 sm-1">
            <h2>Thông tin cá nhân</h2>
            <div class="content__inf-list">
                <p><span>Họ tên: </span>{{$user->name}}</p>
                <p><span>Giới tính: </span>{{$user->gender}}</p>
                <p><span>Quê quán: </span>{{$user->address}}</p>
                <p><span>Email: </span>{{$user->email}}</p>
                <p><span>Phone: </span>{{$user->phone}}</p>
                <p><span>Ngày sinh: </span>{{$user->birth}}</p>
                <p><span>Ngày tạo tài khoản: </span>{{\Carbon\Carbon::parse($user->created_at)->format('d-m-Y')}}</p>
                @foreach ($services as $service)
                    @if($user->point >= $service->point_start && $user->point <= $service->point_end)
                        <p><span>Hội viên: </span>{{$service->rank}}</p>
                    @endif
                @endforeach
            </div>
            <center>
                <a href="/accountShow"><button>Chỉnh sửa chi tiết</button></a>
            </center>
        </div>
        <div class="body__content-inf grid__column-5 sm-1">
            <h2>Hội viên</h2>
            @foreach ($services as $service)
                <div class="content__inf-list">
                    @if ($service->sale > 0)
                        <h4>{{$service->rank}}</h4>
                        <div class="">
                            <i class="fa-solid fa-check"></i>
                            <p>Giảm {{$service->sale}}% cho các gói tour</p>
                        </div>
                        <div class="">
                            <i class="fa-solid fa-check"></i>
                            <p>Được miễn phí 1 số dịch vụ như chăm sóc da, matsa (nếu có)</p>
                        </div>
                    @endif
                </div>
            @endforeach
            <p><span>Lưu ý: </span>Hạng của hội viên sẽ được nâng cấp dựa trên sự tương tác và đăng ký các gói tour.</p>
        </div>
    </div>
</div>

@endsection