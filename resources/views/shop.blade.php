@extends('index')

@section('head')
    @parent
@endsection

@section('main')
    <main>
        <section class="main">
            <div class="container">
                @if(!empty($data[0]))
                <h1>Акции и скидки {{ $shop }}</h1>
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
                                                <span class="sale">{{ $product->name_action }}</span><br>
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
                    @if(!empty($text))
                        <h1>{{ $text }}</h1>
                    @endif
                @endif
            </div>
            <div class="container">
                <div class="paginate">
                        @if(!empty($data))
                            {{ $data->links() }}
                        @endif
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @parent
@endsection