
<header class="header">
    <label for="mobile-menu-checkbox" class="header__mobile-menu">
        <i class="fa-solid fa-bars"></i>
    </label>
    <input type="checkbox" hidden id="mobile-menu-checkbox" class="header__menu-checkbox">

    <label for="mobile-menu-checkbox" class="header__mobile-overlay"></label>

    <nav class="header__mobile-nav">
        <label for="mobile-menu-checkbox" class="header__mobile-close">
            <i class="fas fa-close"></i>
        </label>
        <ul class="header__mobile-nav-list">
            <li>
                <i class="header__mobile-icon fa-solid fa-house"></i>
                <a href="home" class="header__mobile-nav-link {{ request()->is('home') ? 'action' : '' }}">Trang chủ</a>
            </li>
            <li>
                <i class="header__mobile-icon fa-solid fa-suitcase-rolling"></i>
                <a href="travel" class="header__mobile-nav-link {{ request()->is('travel') ? 'action' : '' }}">Du lịch</a>
            </li>
            <li>
                <i class="header__mobile-icon fa-solid fa-phone-volume"></i>
                <a href="contacts" class="header__mobile-nav-link {{ request()->is('contacts') ? 'action' : '' }}">Liên hệ</a>
            </li>
            <li class="header__list-items mobile">
                <div class="">
                    <img src="{{ Session::get('avatar') }}" alt="">
                </div>
                <a href="account" class="header__mobile-nav-link {{ request()->is('account') ? 'action' : '' }}" style="margin-left: 10px;">Tài khoản</a>
            </li>
        </ul>
    </nav>
    <div class="header__logo">
        <p>NC<span> travel.com</span></p>
    </div>
    <ul class="header__list">
        <a class="{{ request()->is('home') ? 'action' : ''}}" href="home">
            <li class="header__list-items">
                <i class="fa-solid fa-house-chimney"></i>
            </li>
        </a>
        <li class="header__list-items next">
            <p>Du lịch</p>
            <i class="fa-solid fa-caret-down"></i>
        </li>
        <a class="{{ request()->is('contacts') ? 'action' : ''}}" href="contacts">
            <li class="header__list-items">
                <p>Liên hệ</p>
            </li>
        </a>
        <a class="{{ request()->is('account')}}" href="account">
            <li class="header__list-items">
                <div class="">
                    <img src="{{ Session::get('avatar') }}" alt="">
                </div>
            </li>
        </a>
    </ul>

</header>

<div class="book action">
    <div class="book__nav">
        <div class="book__nav-header">
            <div class="book__nav-header--item active">
                <p>Du lịch trong nước</p>
            </div>
            <div class="book__nav-header--item_out">
                <p>Du lịch nước ngoài</p>
            </div>
        </div>
        <div class="book__list active">
            <div class="book__list-item grid__column-3">
                <h4>MIỀN BẮC</h4>
                @foreach($places as $place)
                    <?php $i=1 ?>
                        @if($place->area == 'Miền Bắc') 
                            <a href="/travel?seach={{ $place->name}}">
                                <p>{{ $place->name}}</p>
                            </a>
                            <?php $i++ ?>
                                @if($i == 6)
                                    <a class="over_places" href="/travel?seach={{ $place->area }}">
                                        <p>Xem thêm</p>
                                    </a>
                                    @break
                                @endif
                        @endif
                @endforeach
            </div>
            <div class="book__list-item grid__column-3">
                <h4>MIỀN TRUNG</h4>
                @foreach($places as $place)
                    <?php $i=1 ?>
                        @if($place->area == 'Miền Trung') 
                            <a href="/travel?seach={{ $place->name}}">
                                <p>{{ $place->name}}</p>
                            </a>
                            <?php $i++ ?>
                                @if($i == 6)
                                    <a class="over_places" href="/travel?seach={{ $place->area }}">
                                        <p>Xem thêm</p>
                                    </a>
                                    @break
                                @endif
                        @endif
                @endforeach
            </div>
            <div class="book__list-item grid__column-3">
                <h4>MIỀN TÂY</h4>
                @foreach($places as $place)
                    <?php $i=1 ?>
                        @if($place->area == 'Miền Tây') 
                            <a href="/travel?seach={{ $place->name}}">
                                <p>{{ $place->name}}</p>
                            </a>
                            <?php $i++ ?>
                                @if($i == 6)
                                    <a class="over_places" href="/travel?seach={{ $place->area }}">
                                        <p>Xem thêm</p>
                                    </a>
                                    @break
                                @endif
                        @endif
                @endforeach
            </div>
            <div class="book__list-item grid__column-3">
                <h4>MIỀN NAM</h4>
                @foreach($places as $place)
                    <?php $i=1 ?>
                        @if($place->area == 'Miền Nam') 
                            <a href="/travel?seach={{ $place->name}}">
                                <p>{{ $place->name}}</p>
                            </a>
                            <?php $i++ ?>
                                @if($i == 6)
                                    <a class="over_places" href="/travel?seach={{ $place->area }}">
                                        <p>Xem thêm</p>
                                    </a>
                                    @break
                                @endif
                        @endif
                @endforeach
            </div>
        </div>
        <div class="book__list">
            <div class="book__list-item grid__column-3">
                <h4>CHÂU Á</h4>
                @foreach($places as $place)
                    <?php $i=1 ?>
                        @if($place->continent == 'Châu Á') 
                            <a href="/travel?seach={{ $place->name}}">
                                <p>{{ $place->name}}</p>
                            </a>
                            <?php $i++ ?>
                                @if($i == 6)
                                    <a class="over_places" href="/travel?seach={{ $place->continent }}">
                                        <p>Xem thêm</p>
                                    </a>
                                    @break
                                @endif
                        @endif
                @endforeach
            </div>
            <div class="book__list-item grid__column-3">
                <h4>CHÂU ÂU</h4>
                @foreach($places as $place)
                    <?php $i=1 ?>
                        @if($place->continent == 'Châu Âu') 
                            <a href="/travel?seach={{ $place->name}}">
                                <p>{{ $place->name}}</p>
                            </a>
                            <?php $i++ ?>
                                @if($i == 6)
                                    <a class="over_places" href="/travel?seach={{ $place->continent }}">
                                        <p>Xem thêm</p>
                                    </a>
                                    @break
                                @endif
                        @endif
                @endforeach
            </div>
            <div class="book__list-item grid__column-3">
                <h4>NAM MỸ</h4>
                @foreach($places as $place)
                    <?php $i=1 ?>
                        @if($place->continent == 'Nam Mỹ') 
                            <a href="/travel?seach={{ $place->name}}">
                                <p>{{ $place->name}}</p>
                            </a>
                            <?php $i++ ?>
                                @if($i == 6)
                                    <a class="over_places" href="/travel?seach={{ $place->continent }}">
                                        <p>Xem thêm</p>
                                    </a>
                                    @break
                                @endif
                        @endif
                @endforeach
            </div>
            <div class="book__list-item grid__column-3">
                <h4>CHÂU PHI</h4>
                @foreach($places as $place)
                    <?php $i=1 ?>
                        @if($place->continent == 'Châu Phi') 
                            <a href="/travel?seach={{ $place->name}}">
                                <p>{{ $place->name}}</p>
                            </a>
                            <?php $i++ ?>
                                @if($i == 6)
                                    <a class="over_places" href="/travel?seach={{ $place->continent }}">
                                        <p>Xem thêm</p>
                                    </a>
                                    @break
                                @endif
                        @endif
                @endforeach
            </div>
        </div>
        <div class="book__btn">
            <a href="/travel?seach=null">
                <p>Xem tất cả</p>
            </a>
        </div>
        <div class="book__close">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
</div>