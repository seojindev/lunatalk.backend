@extends('admin.v1.layouts.default')

@section('pageTitle','회원 리스트')

@section('pageContent')

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">회원 리스트</h1>
                        <p class="mb-4">가입되어 있는 회원 리스트 입니다.</p>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">회원 리스트</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>회원 번호</th>
                                                <th>로그인 아이디</th>
                                                <th>이름</th>
                                                <th>회원 가입 종류</th>
                                                <th>회원 레벨</th>
                                                <th>회원 상태</th>
                                                <th>이메일</th>
                                                <th>전화번호</th>
                                                <th>등록일</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                        </tfoot>

                                        <tbody>
@foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user['user_uuid'] }}</td>
                                                <td>{{ $user['login_id'] }}</td>
                                                <td>{{ $user['nickname'] }}</td>
                                                <td>{{ $user['user_type']['code_name'] }}</td>
                                                <td>{{ $user['user_level']['code_name'] }}</td>
                                                <td>{{ $user['user_state']['code_name'] }}</td>
                                                <td>{{ $user['email'] }}</td>
                                                <td>{{ $user['phone_number']['step2'] }}</td>
                                                <td>{{ $user['user_date']['create_at'] }}</td>
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
