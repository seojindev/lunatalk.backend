@extends('admin.v1.layouts.default')

@section('pageTitle')
    {{$pages['pageTitle']}}
@endsection

@section('pageContent')

    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body">
                    <form>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">카테고리 선택</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label " for="name">상품 명</label>
                            <input class="form-control" id="name" name="name" type="text"/>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">옵션 1</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">옵션 2</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label" for="email">가격</label>
                                    <input class="form-control" id="email" name="email" type="text"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label" for="subject">재고량</label>
                                    <input class="form-control" id="subject" name="subject" type="text"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label " for="subject">바코드</label>
                            <input class="form-control" id="subject" name="subject" type="text"/>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label" for="email">판매 유무</label>
                                    <input class="form-control" id="email" name="email" type="text"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label" for="subject">재품 상태</label>
                                    <input class="form-control" id="subject" name="subject" type="text"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="message">메모</label>
                            <textarea class="form-control" cols="40" id="message" name="message" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="message">제품 이미지</label>
                            <div id="dropzone" class="dropzone"></div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary " name="submit" type="submit">저장</button>
                        </div>
                    </form>







                </div>
            </div>
        </div>
    </div>


@stop

@push('csss')
        <!-- Custom styles for this page -->
        <link href="{{URL::asset('assets/vendor/dropzone-5.7.0/dist/basic.css')}}" rel="stylesheet">
        <link href="{{URL::asset('assets/vendor/dropzone-5.7.0/dist/dropzone.css')}}" rel="stylesheet">
@endpush


@push('scripts')

        var app = '{{ env('APP_MEDIA_URL', '') }}';
        <!-- Page level plugins -->
        <script src="{{URL::asset('assets/vendor/dropzone-5.7.0/dist/dropzone.js')}}"></script>
@endpush


