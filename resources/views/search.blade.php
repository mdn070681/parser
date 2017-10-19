@section('head')
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    @if( isset($title))
        <title>{{ $title }}</title>
    @elseif( isset($page->title))
        <title>{{ $page->title }}</title>
    @else
        <title>Title</title>
    @endif

    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,900" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
<header>
    <div class="container clearfix">
        <a href="{{ route('promotions') }}" class="logo left"><img src="{{asset('images/logo.png')}}" alt=""></a>
        <div class="right head-block">
            <span class="close"><i class="fa fa-times" aria-hidden="true"></i></span>
            <div class="head-block-inner">
                <ul>
                    <li><a href="{{ route('promotions') }}">Главная</a></li>
                    <li><a href="{{ route('parse') }}">Парсить</a></li>
                    <li><a href="{{ route('about') }}">О нас</a></li>
                    <li><a href="{{ route('contact') }}">Связаться с нами</a></li>
                </ul>
                <h3>Выберите супермаркет</h3>
                <div class="market-block">
                    <a href="#"><img src="{{asset('images/atb.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/brusnichka.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/digma.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/fozzy.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/karavan.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/klass.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/metro.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/posad.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/rost.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/silpo.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('images/vostorg.png')}}" alt=""></a>
                </div>
            </div>
        </div>
        <div class="toggle-block right">
            <a href="#" class="toggle-mnu hidden-lg"><span></span></a>
        </div>
        <div class="search">
            <div class="button-search">Поиск товаров</div>
            <form action="{{ route('search') }}" method="post" class="search-block">
                {{ csrf_field() }}
                <div class="search-block-top ui-widget">
                    <input type="text" class="input-search" placeholder="Введите название категории">
                </div>
                <div class="search-block-middle">
                    <div class="category">
                        @if(!empty($catalog))
                            @foreach($catalog as $cat)
                                <p>
                                    <input type="checkbox" name="{{ $cat->id }}" id="category{{ $cat->id }}"><label for="category{{ $cat->id }}">{{ $cat->name }}</label>
                                </p>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="search-block-bottom">
                    <input type="submit" value="Применить"> <a href="#" class="btn-clear">Очистить</a>
                </div>
            </form>
        </div>

    </div>
</header>
@show

@section('main')
    <main>
        <section class="slider">
            <div class="container">
                <div class="slider-title">Выберите супермаркет</div>
                <div class="slider-market">
                    <div><a href="{{ route('atb') }}"><img src="{{asset('images/atb.png')}}" alt=""></a></div>
                    <div><a href="{{ route('brusnichka') }}"><img src="{{asset('images/brusnichka.png')}}" alt=""></a></div>
                    <div><a href="{{ route('antoshka') }}"><img src="{{asset('images/antoshka.png')}}" alt=""></a></div>
                    <div><a href="{{ route('tavria') }}"><img src="{{asset('images/tavria.png')}}" alt=""></a></div>
                    <div><a href="{{ route('klass') }}"><img src="{{asset('images/klass.png')}}" alt=""></a></div>
                    <div><a href="{{ route('velmarket') }}"><img src="{{asset('images/velmart.png')}}" alt=""></a></div>
                    <div><a href="{{ route('posad') }}"><img src="{{asset('images/posad.png')}}" alt=""></a></div>
                    <div><a href="{{ route('silpo') }}"><img src="{{asset('images/silpo.png')}}" alt=""></a></div>
                    <div><a href="{{ route('okwine') }}"><img src="{{asset('images/okwine.png')}}" alt=""></a></div>
                </div>
            </div>
        </section>
        <section class="main">
            <div class="container">
                @if(!empty($data[0]))
                <h1>Акции и скидки супермаркетов Харькова</h1>
                <div class="main-top clearfix">
                    <div class="right tabs"><span class="tab"><i class="fa fa-list" aria-hidden="true"></i> Список акций</span><span
                                class="tab"><i class="fa fa-map-marker" aria-hidden="true"></i> Карта магазинов</span>
                    </div>
                </div>
                <div class="main-content">
                    <div class="tab_item">
                        <div class="product-container">
                                @foreach($data as $product)
                                    <div class="product-block">
                                        <div class="product-top clearfix">
                                            <img src="{{ $product->shop }}" class="left" alt="">
                                            <p>
                                                <span class="sale">{{ $product->name_action }}</span>
                                            </p>
                                        </div>
                                        <div class="product-img">
                                            @if(!empty($product->sale))
                                                <div class="product-sale">-{{ $product->sale }}%</div>
                                            @endif
                                        <span class="inline-popups">
                                            <a href="#popup" data-effect="mfp-zoom-out">
                                                <img src="{{ $product->img }}" alt="">
                                            </a>
                                        </span>
                                        </div>
                                        <div class="product-info">
                                            @if(!empty($product->name))
                                                <div class="product-title">{{ $product->name }}</div>
                                            @endif
                                            @if(!empty($product->name))
                                                <div class="product-desc">{{ $product->description }}</div>
                                            @endif
                                            @if(!empty($product->price_sale))
                                                <div class="price-new">{{ $product->price_sale }} грн.</div>
                                            @endif
                                            @if(!empty($product->price))
                                                <div class="price-old">{{ $product->price }} грн.</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                    <div class="tab_item">
                        <div class="map" id="map"></div>
                    </div>
                </div>
                @else
                    @if(!empty($flag))
                    <h1>{{ $text }}</h1>
                    @endif
                @endif
            </div>
            <div class="container">
                <div class="paginate">
                    @if(!empty($flag))
                        @if(!empty($data))
                        {{ $data->links() }}
                        @endif
                    @endif
                </div>
            </div>
        </section>
        <section class="info">
            <div class="container">
                <p>
                    Если Вы зашли на наш ресурс, значит, Вы знакомы с экономией и предпочитаете обходиться без переплат.
                    Благодаря нам ненужные расходы навсегда уйдут из Вашей жизни, а про постоянную нехватку денег можно
                    будет забыть. На нашем полезном сайте мы собрали актуальные скидки и акции хорошо известных торговых
                    сетей.
                    Регулярно изучая наш веб-сайт, каждый покупатель получает возможность быть в курсе всех интересных
                    предложений
                    его любимых магазинов.</p>
                <p>
                    Акции и скидки супермаркетов обновляются постоянно, а про их начало или окончание всегда можно
                    узнать,
                    если внимательно рассмотреть картинку товара. Там же Вы найдете и миниатюрный будильник. Его роль в
                    том, чтобы
                    показать, сколько дней осталось до завершения акции. Пользуясь нашим сайтом, помните, что мы не
                    представители
                    магазинов, а лишь занимаемся аккумуляцией информации про скидки и распродажи. Наша миссия – помочь
                    Вам быстро
                    найти акции в нужном супермаркете, сэкономить Ваше время и, естественно, деньги.
                </p>
                <p>
                    Отметим, что если регулярно просматривать наш веб-сайт, можно всегда быть в курсе, какие товары в
                    магазинах
                    продаются с дисконтом. Поэтому перестаньте осуществлять необдуманные шопинги – вооружитесь нужной
                    информацией и смелее отправляйтесь за покупками!
                </p>
            </div>
        </section>
    </main>
@show

@section('footer')
    <footer>
        <div class="container">
            <ul>
                <li><a href="{{ route('promotions') }}">Главная</a></li>
                <li><a href="{{ route('about') }}">О нас</a></li>
                <li><a href="{{ route('contact') }}">Связаться с нами</a></li>
            </ul>
            <p>©2017 promotions - акции и скидки супермаркетов Харькова. Все права защищены.</p>
        </div>
    </footer>
    <div class="button-top"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></div>
    <div id="popup" class="white-popup mfp-with-anim mfp-hide">
        <div class="tabs">
            <span class="tab">Обзор</span>
            <span class="tab">Где купить</span>
        </div>
        <div class="tab_content">
            <div class="tab_item">
                <h4></h4>
                <img src="" alt="">
                <div class="price-new"></div>
                <div class="price-old"></div>
            </div>
            <div class="tab_item">
                <div id="popup-map" class="popup-map"></div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="{{asset('js/jquery-1.12.3.min.js')}}"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB40MWdQXFFBPBMeDLfC84waVV7kvf3-qc&callback=initMap"></script>
<script type="text/javascript" src="{{asset('js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.mask.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>

</html>
@show