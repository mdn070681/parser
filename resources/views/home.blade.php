@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <form action="{{ route('shops') }}" method="post" class="shops-parser">
                    {{ csrf_field() }}
                <h1>Парсить магазины</h1>
                    <div class="shops-inner clearfix">
                        @if(!empty($shops))
                            @foreach($shops as $shop)
                                <p>
                                    <input type="checkbox" name="{{ $shop->id }}" id="shop{{ $shop->id }}"><label for="shop{{ $shop->id }}">{{ $shop->name }}</label>
                                </p>
                            @endforeach
                        @endif
                    </div>
                <input type="submit" value="Отправить" class="submit">
            </form>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <form action="{{ route('catalog') }}" method="post">
                    {{ csrf_field() }}
                <div class="panel-heading"><span class="panel-btn"><i class="fa fa-arrow-down" aria-hidden="true"></i><i class="fa fa-arrow-up" aria-hidden="true"></i></span> Admin panel <input type="submit" class="submit" value="Отправить"></div>
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    <table class="table category-product">
                        <thead>
                            <tr>
                                <th>Продукт</th>
                                <th>Магазин</th>
                                <th>Название</th>
                                <th>Цена (грн)</th>
                                <th>Категория</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($data))
                            @foreach($data as $product)
                            <tr>
                                <td class="table-img"><img src="{{ $product->img }}" alt=""></td>
                                <td class="table-shop"><img src="{{ $product->shop }}" alt=""></td>
                                <td>{{ $product->name }} <input type="hidden" name="id{{ $product->id}}" value="{{ $product->id}}"></td>
                                <td class="table-price">{{ $product->price_sale }} грн</td>
                                <td>
                                    <select class="selectpicker" name="category{{ $product->id}}">
                                        <option value="0">---</option>
                                        @if(!empty($catalog))
                                            @foreach($catalog as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


