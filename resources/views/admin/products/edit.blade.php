@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
=@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} - {{ $subTitle }}</h1>
    </div>
</div>
@include('admin.partials.flash')
<div class="row user">
    <div class="col-md-3">
        <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
                <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Images</a></li>
                <li class="nav-item"><a class="nav-link" href="#attributes" data-toggle="tab">Attributes</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div class="tile">
                    <form action="{{ route('admin.products.update') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        <h3 class="tile-title">Product Information</h3>
                        <hr>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter attribute name" id="name" name="name" value="{{ old('name', $product->name) }}" />
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('name') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="sku">SKU</label>
                                        <input class="form-control @error('sku') is-invalid @enderror" type="text" placeholder="Enter product sku" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" />
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> @error('sku') <span>{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="brand_id">Brand</label>
                                        <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                            <option value="0">Select a brand</option>
                                            @foreach($brands as $brand)
                                            @if ($product->brand_id == $brand->id)
                                            <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                            @else
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> @error('brand_id') <span>{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="categories">Categories</label>
                                        <select name="categories[]" id="categories" class="form-control" multiple>
                                            @foreach($categories as $category)
                                            @php $check = in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : ''@endphp
                                            <option value="{{ $category->id }}" {{ $check }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="price">Price</label>
                                        <input class="form-control @error('price') is-invalid @enderror" type="text" placeholder="Enter product price" id="price" name="price" value="{{ old('price', $product->price) }}" />
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> @error('price') <span>{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="sale_price">Sale Price</label>
                                        <input class="form-control" type="text" placeholder="Enter product special price" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="quantity">Quantity</label>
                                        <input class="form-control @error('quantity') is-invalid @enderror" type="number" placeholder="Enter product quantity" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" />
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> @error('quantity') <span>{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="weight">Weight</label>
                                        <input class="form-control" type="text" placeholder="Enter product weight" id="weight" name="weight" value="{{ old('weight', $product->weight) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="description">Description</label>
                                <textarea name="description" id="description" rows="8" class="form-control">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" {{ $product->status == 1 ? 'checked' : '' }} />Status
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="featured" name="featured" {{ $product->featured == 1 ? 'checked' : '' }} />Featured
                                    </label>
                                </div>
                            </div> -->
                        </div>
                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Product</button>
                                    <a class="btn btn-danger" href="{{ route('admin.products.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane" id="images">
                <div class="tile">
                    <h3 class="tile-title">Upload Image</h3>
                    <hr>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('admin.products.images') }}" enctype="multipart/form-data" method="POST">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="file" name="image" placeholder="Choose image" id="images">
                                                @error('image')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if ($product->images)
                        <hr>
                        <div class="row">
                            @foreach($product->images as $image)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <a class="card-link float-right text-danger" onclick="return confirm('Are you sure?')" href="{{ route('admin.products.images.delete', $image->id) }}">
                                            <i class="fa fa-fw fa-lg fa-trash"></i>
                                        </a>
                                        <img src="{{ asset('storage/'.$image->full) }}" id="brandLogo" class="img-fluid" alt="img">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="attributes">
                <div class="tile">
                    <h3 class="tile-title">Attributes</h3>
                    <hr>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="control-label" for="attribute_id">Select an Attribute <span class="m-l-5 text-danger"> *</span> </label>
                                        <select name="attribute_id" id="attribute_id" class="form-control select-attr @error('attribute_id') is-invalid @enderror">
                                            <option value="0">Select a attribute</option>
                                            @foreach($attributes as $attribute)
                                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> @error('attribute_id') <span>{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile d-none attributeSelectedContainer" v-if="attributeSelected">
                    <form action="{{ route('admin.product.attribute') }}" method="POST" role="form">
                        @csrf
                        <input type="hidden" name="pro_id" value="{{$product->id}}">
                        <h3 class="tile-title">Add Attributes To Product</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="values">Select an Value <span class="m-l-5 text-danger"> *</span></label>
                                    <select name="attribute_value" id="attribute_value" class="form-control @error('attribute_value') is-invalid @enderror">
                                    </select>
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('attribute_value') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="valueSelected">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="pro_quantity">Quantity</label>
                                    <input class="form-control" type="number" id="pro_quantity" name="pro_quantity" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">Price</label>
                                    <input class="form-control" type="text" id="price" name="price" required />

                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tile">
                    <div>
                        <div class="tile">
                            <h3 class="tile-title">Product Attributes</h3>
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Value</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($productAttributes as $data)
                                            <tr v-for="pa in productAttributes">
                                                <td style="width: 25%" class="text-center">{{$data->value}}</td>
                                                <td style="width: 25%" class="text-center">{{$data->quantity}}</td>
                                                <td style="width: 25%" class="text-center">{{$data->price}}</td>
                                                <td style="width: 25%" class="text-center">
                                                    <a href="{{ route('admin.product.attribute.delete', $data->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure delete the product attribute?')"><i class="fa fa-trash"></i></a>
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
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select-attr').on('change', function() {
            $('.attributeSelectedContainer').removeClass('d-none');
            $('#attribute_value').find('option').remove();
            var attrVal = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.attribute.getvalue') }}",
                data: {
                    id: attrVal
                },
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, value) {
                        console.log(index, value);
                        var $option = $("<option></option>");
                        $option.val(index);
                        $option.text(value);
                        $('#attribute_value').append($option);
                    });
                }
            });
        });
    });
</script>
@endpush