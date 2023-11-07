@extends('layouts/contentNavbarLayout')

@section('title', 'User Card - UI elements')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold">User Create</h5>
    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('content.user.form')
                        <br>
                        <a href="{{ url('user') }}" class="btn btn-secondary me-1">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- java script --}}
<script>
  $(document).ready(function() {
    $('#basic-default-fullname, #upload').on('input change', function() {
      $('#basic-default-fullname-error').hide();
      $(this).removeClass('is-invalid');
    });
  });
</script>
