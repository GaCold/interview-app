@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('Product') @endslot
        @slot('title') @lang('Product List') @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="userList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button class="btn btn-soft-danger" onclick="deleteMultiple('{{route('products.delete-multiple')}}')"><i class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                            @include('share.search-input')
                            <div class="col-sm-auto">
                                <div>
                                <a href="{{route('products.create')}}" type="button" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i>@lang('Add')</a>                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="id">@lang('ID')</th>
                                        <th class="sort" data-sort="first_name">@lang('Product Code')</th>
                                        <th class="sort" data-sort="last_name">@lang('Product Name')</th>
                                        <th class="sort" data-sort="email">@lang('Price')</th>
                                        <th class="sort" data-sort="phone_number">@lang('Image')</th>
                                        <th class="sort" data-sort="action">@lang('Action')</th>
                                        </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $product->id }}" name="ids">
                                            </div>
                                        </th>
                                        <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">{{ $product->id }}</a></td>
                                        <td>{{ $product->id }}</td>
                                        <td class="first_name">{{ $product->product_code }}</td>
                                        <td class="last_name">{{ $product->product_name }}</td>
                                        <td class="email">{{ number_format($product->price, 2) }}</td>
                                        <td class="phone">
                                            <img src="{{ $product->image_path }}" alt="" width="100px">
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('products.show',$product->id)}}" class="link-success">@lang('View More') <i class="ri-arrow-right-line align-middle"></i></a>
                                                <div class="edit">
                                                <a class="btn btn-sm btn-success edit-item-btn" href="{{route('products.edit',$product->id)}}">@lang('Edit')</a>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" data-url="{{route('products.destroy', $product->id)}}">@lang('Remove')</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @include('share.table-footer')
                        </div>

                        @include('share.paginate-jstable')
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
    <script src="{{ URL::asset('assets/libs/list.js/list.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js') }}"></script>

    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app-custom.js').'?'.time() }}"></script>
<script>
        $(document).ready(function () {
                let valueNames = [
                "first_name",
                "last_name",
                "email",
            ]
            initTableJs('userList', valueNames)

                $(document).on('click', '.remove-item-btn', function (e) {
                    e.preventDefault()
                    let url = $(this).data('url')
                    Swal.fire({
                        title: "@lang('Are you sure?')",
                        text: "",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#51d28c",
                        cancelButtonColor: "#f34e4e",
                        confirmButtonText: "@lang('Ok')",
                        cancelButtonText: "@lang('Cancel')"
                    }).then(function (result) {
                        if (result.value) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    _token: document.querySelector('meta[name="csrf-token"]').content,
                                },
                                dataType: 'JSON',
                                success: function(response) {
                                    alertNoti('success', response.msg);
                                    window.location.reload();
                                },
                                error: function(response, status, error) {
                                    alertNoti('error', response.responseJSON.msg);
                                }
                            });
                        }
                    })
                })
        });
</script>
@endsection
