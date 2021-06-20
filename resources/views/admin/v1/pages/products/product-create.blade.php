@extends('admin.v1.layouts.default')

@section('pageTitle','상품 등록')

@section('pageContent')

                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
                                <div class="card o-hidden border-0 shadow-lg my-5">
                                    <div class="card-body">
                                        <form>

                                            <div class="form-group">
                                                <label for="product_category">카테고리 선택</label>
                                                <select class="form-control" id="product_category" name="product_category">
                                                    <option value="">선택</option>
@foreach ($composeCodeList['code_group']['P01'] as $category)
                                                    <option value="{{ $category['code_id'] }}">{{ $category['code_name'] }}</option>
@endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="product_name">상품 명</label>
                                                <input class="form-control" id="product_name" name="product_name" type="text"/>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="product_option_step1">옵션 1</label>
                                                        <select class="form-control" id="product_option_step1" name="product_option_step2">
                                                            <option value="">선택</option>
@foreach ($composeCodeList['code_group']['O10'] as $category)
                                                            <option value="{{ $category['code_id'] }}">{{ $category['code_name'] }}</option>
@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="product_option_step2">옵션 2</label>
                                                        <select class="form-control" id="product_option_step2" name="product_option_step2">
                                                            <option value="">선택</option>
@foreach ($composeCodeList['code_group']['O20'] as $category)
                                                            <option value="{{ $category['code_id'] }}">{{ $category['code_name'] }}</option>
@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="control-label" for="product_price">가격</label>
                                                        <input class="form-control" id="product_price" name="product_price" type="number"/>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="control-label" for="product_stock">재고량</label>
                                                        <input class="form-control" id="product_stock" name="product_stock" type="number"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label " for="product_barcode">바코드</label>
                                                <input class="form-control" id="product_barcode" name="product_barcode" type="text"/>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="control-label" for="product_sale">판매 유무</label>
                                                        <select class="form-control" id="product_sale" name="product_sale">
                                                            <option value="N">아니요</option>
                                                            <option value="Y">예</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="control-label" for="product_active">재품 상태</label>
                                                        <select class="form-control" id="product_active" name="product_active">
                                                            <option value="N">아니요</option>
                                                            <option value="Y">예</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="message">제품 이미지</label>
                                                <div id="dropzone_rep" class="dropzone"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="message">제품 상세 이미지</label>
                                                <div id="dropzone_detail" class="dropzone"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="product_memo">메모</label>
                                                <textarea class="form-control" cols="40" id="product_memo" name="product_memo" rows="5"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary" name="submit-button">등록</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>


@stop

@push('pageIncludeCsss')
        <!-- Custom styles for this page -->
        <link href="{{URL::asset('assets/vendor/dropzone-5.7.0/dist/basic.css')}}" rel="stylesheet">
        <link href="{{URL::asset('assets/vendor/dropzone-5.7.0/dist/dropzone.css')}}" rel="stylesheet">
@endpush

@push('scriptValues')
        <!-- Page level script Values -->
        <script>
            var dropzoneMode = 'create';
        </script>
@endpush

@push('pageIncludeScripts')

        <!-- Page level plugins -->
        <script src="{{URL::asset('assets/vendor/dropzone-5.7.0/dist/dropzone.js')}}"></script>
        <script src="{{URL::asset('assets/resource/admin-pages-script/products-dropzone.js')}}?t={{ time() }}"></script>
@endpush


@push('pageLoadScript')
        <!-- Page level pageLoadScript -->
        <script>
            createPageFunction.pageStart();
        </script>
@endpush
