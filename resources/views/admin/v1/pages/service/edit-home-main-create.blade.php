@extends('admin.v1.layouts.default')

@section('pageTitle', '홈 메인 등록')

@php
    echo "<!-- \n";

        print_r($mainhome);

    echo "\n-->\n";
@endphp

@section('pageContent')

    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body">
                    <form>

                        <div class="form-group">
                            <label class="control-label" for="message">이미지</label>
                            <div id="dropzone_image" class="dropzone"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="product-select">상품 선택</label>
                            <select class="form-control" id="product-select" name="product-select">
                                <option value="">선택</option>
                                @foreach ($simpleProducts as $product)
                                    <option value="{{ $product['uuid'] }}">{{ $product['productName'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="edit-status">게시 상태</label>
                            <select class="form-control" id="edit-status" name="edit-status">
                                <option value="N">아니요</option>
                                <option value="Y">예</option>
                            </select>
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
    <link href="{{ URL::asset('assets/vendor/dropzone-5.7.0/dist/basic.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/vendor/dropzone-5.7.0/dist/dropzone.css') }}" rel="stylesheet">
@endpush

@push('scriptValues')
    <!-- Page level script Values -->
    <script>
        var pageMode = '{{ $pages['pageMode'] }}';
        var dropzoneMode = '{{ $pages['pageMode'] }}';
@if ($pages['pageMode'] === 'update')
        var pageData = @json($mainhome, JSON_PRETTY_PRINT);
@endif
    </script>
@endpush

@push('pageIncludeScripts')

    <!-- Page level plugins -->
    <script src="{{ URL::asset('assets/vendor/dropzone-5.7.0/dist/dropzone.js') }}"></script>
    <script
        src="{{ URL::asset('assets/resource/admin-pages-script/service-edit-home-dropzone.js') }}?t={{ time() }}">
    </script>
@endpush


@push('pageLoadScript')
    <!-- Page level pageLoadScript -->
    <script>
        editHomePageFunction.createPageStart();
    </script>
@endpush
