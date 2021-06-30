@extends('admin.v1.layouts.default')

@section('pageTitle', '홈 메인 편집')

@php
    echo "\n<!--\n";
        print_r($mains);
    echo "\n<!--\n";
@endphp

@section('pageContent')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">홈 메인 편집</h1>
    <p class="mb-4">홈 메인 상단 상품 리스트 편집입니다.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">리스트</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>상품명</th>
                            <th>상태</th>
                            <th>등록일</th>
                            <th>기타</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($mains as $main)
                            <tr>
                                <td class="cursor-pointer" name="click-home-main-view" homemain-id="{{ $main['id'] }}">
                                    {{ $main['product_name'] }}</td>
                                <td>{{ $main['status'] }}</td>
                                <td>{{ $main['created_at'] }}</td>
                                <td><button type="button" class="btn btn-info" name="button-home-main-status-change" homemain-status="{{ $main['status'] }}" homemain-id="{{ $main['id'] }}">상태 처리</button></td>
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
    <link href="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('pageIncludeScripts')
    <!-- Page level plugins -->
    <script src="{{ URL::asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush


@push('pageIncludeScripts')

@endpush

@push('pageLoadScript')
    <!-- Page level pageLoadScript -->
    <script>
        editHomePageFunction.listPageStart();
    </script>
@endpush
