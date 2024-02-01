@extends('layouts/contentNavbarLayout')

@section('title', 'Department - UI elements')

<!-- CKEditor  -->
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<!-- //crop -->
<script src="https://unpkg.com/cropperjs/dist/cropper.js"></script>
<link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold">Department Update</h5>
</div>
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" action="{{ url('/department&staff/department/edit/' . $department->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('content.department.form', ['department' => $department])
                    <a href="{{ url('department&staff/department') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn" style="background-color: #009DE1; color:white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // CK Editor---
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList'
            ],
        })
        .catch(error => {
            console.log(error);
        });
</script>

<!-- Javascript Validate department -->
<script>
    $(document).ready(function() {
        $('#basic-default-fullname, #upload').on('input change', function() {
            $('#department-name-error').hide();
            $('#department-cover-error').hide();
            $(this).removeClass('is-invalid');
        });
    });
</script>
@endsection
