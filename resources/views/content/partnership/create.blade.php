@extends('layouts/contentNavbarLayout')

@section('title', 'Partnership basic - UI elements')

<!-- Hide validation  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- //crop -->
<script src="https://unpkg.com/cropperjs/dist/cropper.js"></script>

<link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css">

@section('vendor-script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold">Partnership Create</h5>
</div>
<div class="row row-2">
    <div class="col-xl">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('partnership.store') }}" enctype="multipart/form-data">
                    @csrf
                    @include('content.partnership.form')
                    <a href="{{ url('partnership') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn" style="background-color: #009DE1; color:white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Hide Validation text-danger
    $(document).ready(function() {
        $('#basic-default-fullname, #upload').on('input file change', function() {
            $(this).removeClass('is-invalid');
            $(this).next('.text-danger').hide();
        });
    });

    // <!-- Javascript crop image partnership -->
    $(document).ready(function() {
        let cropper;
        let originalImageSrc;

        $('#upload').on('change', function() {
            $('#uploadedAvatar').hide();
            $('#cropForm').show();
            let input = this;
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#cropPreview').attr('src', e.target.result);

                // Initialize Cropper.js
                cropper = new Cropper($('#cropPreview')[0], {
                    viewport: {
                        width: 400,
                        height: 400
                    },
                    boundary: {
                        width: 500,
                        height: 500
                    },
                    showZoomer: false,
                    enableResize: true,
                    enableOrientation: true,
                    mouseWheelZoom: 'ctrl'
                });

                $('#cropButton').on('click', function() {
                    let canvas = cropper.getCroppedCanvas(); // Get the cropped canvas
                    let croppedImage = canvas.toDataURL(); // Convert canvas to base64 data URL

                    // Set the cropped image as the source for the original image
                    $('#uploadedAvatar').attr('src', croppedImage);
                    $('#uploadedAvatar').show();
                    $('#cropForm').hide(); // Hide the crop form

                    // Set the cropped image data to the hidden input field
                    $('#croppedImage').val(croppedImage);
                });
            };
            reader.readAsDataURL(input.files[0]);
        });

        $('.account-image-reset').on('click', function() {
            cropper.destroy(); // Destroy the existing cropper instance
            $('#uploadedAvatar').attr('src', originalImageSrc); // Restore the original image
            $('#uploadedAvatar').show();
            $('#cropForm').hide();
            $('#upload').val(''); // Clear the file input

            // Clear the cropped image data from the hidden input field
            $('#croppedImage').val('');
        });

        $('#crop-modal').on('show.bs.modal', function() {
            // Store the original image source
            originalImageSrc = $('#uploadedAvatar').attr('src');
        });

        $('#crop-modal').on('hidden.bs.modal', function() {
            // Clear the file input to allow reselection of the same file
            $('#upload').val('');
        });
    });
</script>
@endsection