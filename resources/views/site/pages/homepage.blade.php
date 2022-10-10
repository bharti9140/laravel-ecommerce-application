@extends('site.app')
@section('title', 'Homepage')
@section('seo_meta_description')
    <meta property="og:description" content="{{ config('settings.seo_meta_description') }}">
@endsection
@section('content')
<div>
    <marquee class="marq" behavior=alternate direction="right">
        <h1 style="color:grey;">Ecommerc Homepage</h1>
    </marquee>
    <div>
        <img src="images/img.jpg" class="w3-round-large" alt="Nature" style="width: 100%">
    </div>
    @stop