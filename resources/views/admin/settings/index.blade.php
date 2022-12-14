@extends('admin.app')

@section('title') {{ $pageTitle }} @endsection

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-cogs"></i> {{ $pageTitle }}</h1>
    </div>
</div>
@include('admin.partials.flash')
<div class="row user">
    <div class="col-md-3">
        <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs" id="nav-tabs">
                <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                <li class="nav-item"><a class="nav-link" href="#site-logo" data-toggle="tab">Site Logo</a></li>
                <li class="nav-item"><a class="nav-link" href="#footer-seo" data-toggle="tab">Footer &amp; SEO</a></li>
                <li class="nav-item"><a class="nav-link" href="#social-links" data-toggle="tab">Social Links</a></li>
                <li class="nav-item"><a class="nav-link" href="#analytics" data-toggle="tab">Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="#payments" data-toggle="tab">Payments</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                @include('admin.settings.includes.general')
            </div>
            <div class="tab-pane{{old('tab') == 'site-logo' ? ' active' : null}}" id="site-logo" role="tabpanel">
                @include('admin.settings.includes.logo')
            </div>

            <div class="tab-pane{{old('tab') == 'footer-seo' ? ' active' : null}}" id="footer-seo" role="tabpanel">
                @include('admin.settings.includes.footer_seo')
            </div>

            <div class="tab-pane{{old('tab') == 'social-links' ? ' active' : null}}" id="social-links" role="tabpanel">
                @include('admin.settings.includes.social_links')
            </div>
            <div class="tab-pane{{old('tab') == 'analytics' ? ' active' : null}}" id="analytics" role="tabpanel">
                @include('admin.settings.includes.analytics')
            </div>

            <div class="tab-pane{{old('tab') == 'payments' ? ' active' : null}}" id="payments" role="tabpanel">
                @include('admin.settings.includes.payments')
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#nav-tabs a[href="#{{ old('tab') }}"]').tab('show')
        });
</script>
@endpush