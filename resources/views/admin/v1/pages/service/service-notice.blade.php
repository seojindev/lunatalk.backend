@extends('admin.v1.layouts.default')

@section('pageTitle','서비스 공지사항 관리')

@section('pageContent')

                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
                                <div class="card o-hidden border-0 shadow-lg my-5">
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label class="control-label" for="service_notice_message">서비스 공지 사항</label>
                                                <textarea class="form-control" cols="40" id="service_notice_message" name="service_notice_message" rows="5">{{ $noticeContents }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary" name="submit-button">저장</button>
                                                <button class="btn btn-danger" name="delete-button">삭제</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>


@stop

@push('pageLoadScript')
        <!-- Page level pageLoadScript -->
        <script>
            serviceNoticePageFunction.pageStart();
        </script>
@endpush
