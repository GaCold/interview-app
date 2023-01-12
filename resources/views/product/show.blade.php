@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('Product') @endslot
        @slot('title') @lang('Product Detail') @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">@lang('User Information')</h4>
                </div><!-- end card header -->

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">@lang('Info')</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th class="ps-0" scope="row">@lang('Product code') :</th>
                                    <td class="text-muted">{{$product->product_code}}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0" scope="row">@lang('Product Name') :</th>
                                        <td class="text-muted">{{$product->product_name}}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0" scope="row">@lang('Price') :</th>
                                        <td class="text-muted">{{number_format($product->price, 2)}} @lang('vnđ')</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0" scope="row">@lang('Image') :</th>
                                        <td class="text-muted">
                                            <img src="{{$product->image_path}}" alt="" width="200px">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-12">
                                <a href="{{route('products.index')}}" class="btn btn-success">@lang('Back')</a>
                            </div>
                        </div>
                    </div><!-- end card body -->
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
