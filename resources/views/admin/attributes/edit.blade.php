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
            <ul class="nav flex-column nav-tabs user-tabs" id="tabIds">
                <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab" role="tab">General</a></li>
                <li class="nav-item"><a class="nav-link" href="#values" data-toggle="tab" role="tab">Attribute Values</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane  <?= isset($_GET['id']) ? '' : 'active' ?>" id="general">
                <div class="tile">
                    <form action="{{ route('admin.attributes.update') }}" method="POST" role="form">
                        @csrf
                        <h3 class="tile-title">Attribute Information</h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="code">Code</label>
                                <input class="form-control" type="text" placeholder="Enter attribute code" id="code" name="code" value="{{ old('code', $attribute->code) }}" />
                            </div>
                            <input type="hidden" name="id" value="{{ $attribute->id }}">
                            <div class="form-group">
                                <label class="control-label" for="name">Name</label>
                                <input class="form-control" type="text" placeholder="Enter attribute name" id="name" name="name" value="{{ old('name', $attribute->name) }}" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="frontend_type">Frontend Type</label>
                                @php $types = ['select' => 'Select Box', 'radio' => 'Radio Button', 'text' => 'Text Field', 'text_area' => 'Text Area']; @endphp
                                <select name="frontend_type" id="frontend_type" class="form-control">
                                    @foreach($types as $key => $label)
                                    @if ($attribute->frontend_type == $key)
                                    <option value="{{ $key }}" selected>{{ $label }}</option>
                                    @else
                                    <option value="{{ $key }}">{{ $label }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Attribute</button>
                                    <a class="btn btn-danger" href="{{ route('admin.attributes.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane <?= (isset($_GET['id']))||(old('tab') == 'values') ? 'active' : 'null' ?>" id="values" role="tabpanel">
                <div class="tile">
                    <form action="{{ route('admin.attributes.value.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="attribute_id" value="{{$attribute->id}}">
                        <input type="hidden" name="value_id" value="<?= isset($av) ? $av->id : '' ?>">
                        <h3 class="tile-title">Attribute Values</h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="value">Value</label>
                                <input class="form-control" value="<?= isset($av) ? $av->value : '' ?>" type="text" placeholder="Enter attribute value" id="value" name="value" required />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="name">Price</label>
                                <input class="form-control" type="number" placeholder="Enter attribute value price" value="<?= isset($av) ? $av->price : '' ?>" id="price" name="price" required />
                            </div>
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <?php
                                    $valueId = isset($av) ? $av->id : null;
                                    ?>
                                    @if($valueId)
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('admin.attributes.edit', ['attribute_id' => $attribute->id]) }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                </div>
                                @else
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                </button>
                                @endif
                            </div>
                        </div>
                </div>
                </form>
            </div>
            <div class="tile">
                <h3 class="tile-title">Option Values</h3>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Value</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $value)
                                <tr v-for="value in values">
                                    <td style="width: 25%" class="text-center">{{ $value->id}}</td>
                                    <td style="width: 25%" class="text-center">{{ $value->value}}</td>
                                    <td style="width: 25%" class="text-center">{{ $value->price}}</td>
                                    <td style="width: 25%" class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.attributes.edit', ['attribute_id' => $attribute->id, 'id' => $value->id]) }}" class="btn btn-sm btn-primary" id="values"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.attributes.value.delete', $value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure delete the attribute value?')"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#tabIds a[href="#{{ old('tab') }}"]').tab('show');
    });
</script>
@endpush