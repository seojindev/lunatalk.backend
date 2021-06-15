@extends('admin.v1.layouts.default')

@section('pageTitle')
    {{$pages['pageTitle']}}
@endsection

@section('pageContent')





    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label class="control-label " for="name">상품 명</label>
                            <input class="form-control" id="name" name="name" type="text"/>
                        </div>

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
                            <label class="control-label requiredField" for="email">Email<span class="asteriskField">*</span></label>
                            <input class="form-control" id="email" name="email" type="text"/>
                        </div>

                        <div class="form-group">
                            <label class="control-label " for="subject">Subject</label>
                            <input class="form-control" id="subject" name="subject" type="text"/>
                        </div>

                        <div class="form-group">
                            <label class="control-label " for="message">Message</label>
                            <textarea class="form-control" cols="40" id="message" name="message" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary " name="submit" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@stop


@push('scripts')
        <!-- Page level plugins -->
        <script src="{{URL::asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{URL::asset('assets/js/demo/datatables-demo.js')}}"></script>
@endpush

@push('csss')
        <!-- Custom styles for this page -->
        <link href="{{URL::asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
