@extends('layouts.master')
@section('title') @lang('') @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('Product') @endslot
        @slot('title')@lang('Product edit') @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">@lang('Edit User')</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                    <form class="row g-3" action="{{route('products.update', $product->id)}}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                            <div class="col-md-6">
                                <label for="validationDefault01" class="form-label">@lang('Product code')</label>
                            <input name="product_code" type="text" class="form-control" id="validationDefault01" value="{{$product->product_code}}" required>
                                @if($errors->has('product_code'))
                                    <div class="alert alert-danger mb-xl-0" role="alert">
                                        {{ $errors->first('product_code') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label">@lang('Product name')</label>
                                <input name="product_name" type="text" class="form-control" id="validationDefault02" value="{{$product->product_name}}" required>
                                @if($errors->has('product_name'))
                                    <div class="alert alert-danger mb-xl-0" role="alert">
                                        {{ $errors->first('product_name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefaultEmail" class="form-label">@lang('Price')</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2">vnđ</span>
                                    <input name="price" type="text" class="form-control" id="validationDefaultEmail" aria-describedby="inputGroupPrepend2" value="{{$product->price}}"
                                        required>
                                    @if($errors->has('price'))
                                        <div class="alert alert-danger mb-xl-0" role="alert">
                                            {{ $errors->first('price') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefaultPhoneNumber" class="form-label">@lang('Image Path')</label>
                                <div class="input-group">
                                    <input name="image_path" type="text" class="form-control" id="validationDefaultPhoneNumber" aria-describedby="inputGroupPrepend2" value="{{$product->image_path}}">
                                    @if($errors->has('image_path'))
                                        <div class="alert alert-danger mb-xl-0" role="alert">
                                            {{ $errors->first('image_path') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <a href="{{route('products.index')}}" class="btn btn-warning waves-effect waves-light">@lang('Cancel')</a>
                                <button class="btn btn-success" type="submit">@lang('Update')</button>
                            </div>
                        </form>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
