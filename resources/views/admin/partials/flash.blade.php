@php
    $errors = Session::get('error');
    $messages = Session::get('success');
    $info = Session::get('info');
    $warnings = Session::get('warning');
@endphp
@if ($errors) @foreach((array)$errors as $key => $value)
    <div class="alert alert-danger alert-dismissible" role="alert" style="width:310px">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Error!</strong> {{ $value }}
    </div>
@endforeach @endif

@if ($messages) @foreach((array)$messages as $key => $value)
    <div class="alert alert-success alert-dismissible" role="alert" style="width:310px">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Success!</strong> {{ $value }}
    </div>
@endforeach @endif

@if ($info) @foreach((array)$info as $key => $value)
    <div class="alert alert-info alert-dismissible" role="alert" style="width:310px">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Info!</strong> {{ $value }}
    </div>
@endforeach @endif

@if ($warnings) @foreach((array)$warnings as $key => $value)
    <div class="alert alert-warning alert-dismissible" role="alert" style="width:310px">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Warning!</strong> {{ $value }}
    </div>
@endforeach @endif