@extends('site.app')
@section('title', 'Checkout')
@section('content')
@include('site.partials.flash')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">Checkout</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
            </div>
        </div>
        <form action="{{ route('checkout.place.order') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <header class="card-header">
                            <h4 class="card-title mt-2">Billing Details</h4>
                        </header>
                        <article class="card-body">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="first_name">First name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                     value="{{ auth()->user()->first_name }}">
                                     <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('first_name') <span>{{ $message }}</span> @enderror
                                </div>
                                </div>
                                <div class="col form-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                     value="{{ auth()->user()->last_name }}">
                                     <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('last_name') <span>{{ $message }}</span> @enderror
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" 
                                value="{{ auth()->user()->address }}">
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('address') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for = "city">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" 
                                    value="{{ auth()->user()->city }}">
                                    <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('city') <span>{{ $message }}</span> @enderror
                                </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror" name="country"
                                     value="{{ auth()->user()->country }}">
                                     <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('country') <span>{{ $message }}</span> @enderror
                                </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="post_code">Post Code</label>
                                    <input type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code">
                                    <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('post_code') <span>{{ $message }}</span> @enderror
                                </div>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number">
                                    <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('phone_number') <span>{{ $message }}</span> @enderror
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" disabled required>
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label>Order Notes</label>
                                <textarea class="form-control" name="notes" rows="6"></textarea>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <header class="card-header">
                                    <h4 class="card-title mt-2">Your Order</h4>
                                </header>
                                <article class="card-body">
                                    <dl class="dlist-align">
                                        <dt>Total cost: </dt>
                                        <dd class="text-right h5 b"> {{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }} </dd>
                                    </dl>
                                </article>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-success">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@stop