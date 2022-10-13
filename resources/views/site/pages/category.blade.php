@extends('site.app')
@section('title', $category->name)
@section('content')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">{{ $category->name }}</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div id="code_prod_complex">
            <div class="row">
                @forelse($category->products as $product)
                <div class="col-md-4">
                    @if($product->status == 1)
                    <a href="{{ route('product.show', $product->slug) }}">
                        <figure class="card card-product">
                            @if ($product->images->count() > 0)
                            <div class="img-wrap padding-y"><img src="{{ asset('storage/'.$product->images->first()->full) }}" alt=""></div>
                            @else
                            <div class="img-wrap padding-y"><img src="https://via.placeholder.com/176" alt=""></div>
                            @endif
                            <figcaption class="info-wrap">
                                <h4 class="title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
                            </figcaption>
                            <div class="bottom-wrap">
                                <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
                                    @csrf
                                    <dl class="dlist-inline">
                                        <dd>
                                            <input type="hidden" type="number" min="1" value="1" max="{{ $product->quantity }}" name="qty" style="width:70px;">
                                            <input type="hidden" name="productId" value="{{ $product->id }}">
                                            <input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">
                                        </dd>
                                    </dl>

                                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
                                </form>
                                @if ($product->sale_price != 0)
                                <div class="price-wrap h5">
                                    <span class="price"> {{ config('settings.currency_symbol').$product->sale_price }} </span>
                                    <del class="price-old"> {{ config('settings.currency_symbol').$product->price }}</del>
                                </div>
                                @else
                                <div class="price-wrap h5">
                                    <span class="price"> {{ config('settings.currency_symbol').$product->price }} </span>
                                </div>
                                @endif
                            </div>
                        </figure>
                    </a>
                    @endif
                </div>
                @empty
                <p>No Products found in {{ $category->name }}.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@stop