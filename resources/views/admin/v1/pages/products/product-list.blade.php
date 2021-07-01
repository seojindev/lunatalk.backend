@extends('admin.v1.layouts.default')

@section('pageTitle','상품 리스트')

@php
    echo "<!--";
    print_r($products);
    echo "//-->";
@endphp

@section('pageContent')

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">상품 리스트</h1>
                        <p class="mb-4">현재 등록되어 있는 상품 리스트 입니다.</p>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">상품 리스트</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>카테고리</th>
                                                <th>상품명</th>
                                                <th>옵션1</th>
                                                <th>옵션2</th>
                                                <th>금액</th>
                                                <th>재고량</th>
                                                <th>판매유무</th>
                                                <th>재품상태</th>
                                                <th>등록일</th>
                                                <th>
                                                    <div class="text-center well">
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> -
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
@foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product['category']['code_name'] }}</td>
                                                <td class="cursor-pointer" name="click-product-view" product_uuid="{{ $product['product_uuid'] }}">{{ $product['name'] }}</td>
                                                <td>{{ $product['options']['step1']['code_name'] }}</td>
                                                <td>{{ $product['options']['step2']['code_name'] }}</td>
                                                <td>{{ $product['price']['string'] }}</td>
                                                <td>{{ $product['stock']['string'] }}</td>
                                                <td>{{ $product['sale'] }}</td>
                                                <td>{{ $product['active'] }}</td>
                                                <td>{{ $product['created_at'] }}</td>
                                                <td>
                                                    <div class="text-center well">
                                                        <button type="button" class="btn btn-primary btn-color btn-bg-color btn-sm col-xs-2" name="button-add-best-item" product-uuid="{{ $product['product_uuid']}}">
                                                             Best-Item
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-color btn-bg-color btn-sm col-xs-2">
                                                             Hot-Item
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
@endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

@stop


@push('pageIncludeCsss')
        <!-- Custom styles for this page -->
        <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@push('pageIncludeScripts')
        <!-- Page level plugins -->
        <script src="{{URL::asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{URL::asset('assets/js/demo/datatables-demo.js')}}"></script>
@endpush


@push('pageIncludeScripts')

@endpush


@push('pageLoadScript')
        <!-- Page level pageLoadScript -->
        <script>
            listPageFunction.pageStart();
        </script>
@endpush
