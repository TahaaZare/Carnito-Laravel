@extends('admin.layouts.master')

@section('head-tag')
    <title>سرویس {{$service->name}}</title>
@endsection

@section('content')
    <div class="m-4">
        <section class="row">
            <section class="col-12">
                <section class="main-body-container">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش سرویس - {{$service->name}}
                        </h5>
                    </section>
                    <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('admin.service.index') }}" class="btn btn-outline-info btn-sm">بازگشت</a>
                    </section>

                    <section class="card border-0 rounded-4">
                        <section class="card-body">
                            <form id="form" enctype="multipart/form-data" action="{{ route('admin.service.update',$service->id) }}"
                                method="POST">
                                @csrf
                                @method('put')
                                <section class="row">
                                    <section class="col-12 my-2">
                                        <img src="{{ asset($service->image) }}" alt="icon" id="imageUp" class="my-2 rounded-5"
                                            width="200" height="200" class="mt-3">
                                    </section>
                                    <section class="col-12 my-2">
                                        <div class="form-group">
                                            <label for="">
                                                <span class="fw-bold">*</span>
                                                اسم سرویس
                                            </label>
                                            <input type="text" class="form-control rounded-4 "
                                                value="{{ old('name',$service->name) }}" name="name">
                                            @error('name')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </section>
                                    <section class="col-6 my-2">
                                        <div class="form-group">
                                            <label for="">
                                                <span class="fw-bold">*</span>
                                                وضعیت
                                            </label>
                                            <select name="status" id="" class="form-control rounded-4"
                                                id="status">
                                                <option value="0" @if (old('status',$service->status) == 0) selected @endif>
                                                    غیرفعال</option>
                                                <option value="1" @if (old('status',$service->status) == 1) selected @endif>
                                                    فعال</option>
                                            </select>
                                            @error('status')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </section>
                                    <section class="col-6 my-2">
                                        <div class="form-group">
                                            <label for="">
                                                <span class="fw-bold">*</span>
                                                آیکون
                                            </label>
                                            <input type="file" id="image" class="form-control rounded-4 "
                                                name="image">
                                        </div>
                                        @error('image')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </section>
                                    <section class="col-12 my-2">
                                        <div class="form-group">
                                            <label for="">
                                                <span class="fw-bold">*</span>
                                                متن
                                            </label>
                                            <textarea name="description" id="description" class="form-control rounded-4" 
                                            rows="6">{{ old('description',$service->description) }}</textarea>
                                            @error('description')
                                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </section>

                                    <section class="col-12">
                                        <button class="btn btn-success btn-block my-2">ثبت</button>
                                    </section>
                                </section>
                            </form>
                        </section>
                    </section>

                </section>
            </section>
        </section>

    </div>
@endsection

@section('script')
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageUp').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
    <script type="text/javascript" src="{{ asset('admin-assets/ckeditor4/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    {!! JsValidator::formRequest('Modules\Content\Http\Requests\Service\EditServiceRequest') !!}
@endsection
