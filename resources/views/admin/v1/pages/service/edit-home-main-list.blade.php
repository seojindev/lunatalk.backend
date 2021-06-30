@extends('admin.v1.layouts.default')

@section('pageTitle','홈 메인 편집')

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
                                            </tr>
                                        </thead>
                                        <tbody>


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
