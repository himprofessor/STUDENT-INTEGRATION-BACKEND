@extends('layouts/contentNavbarLayout')

@section('title', 'term List - UI elements')

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h5 class="fw-bold mb-0">Term List</h5>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <!-- create  -->
            <form action="{{ route('term.store') }}" method="post" class="col-md-5">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" placeholder="Input term name" name="term_name" id="term" class="form-control @error('term_name') is-invalid @enderror" value="{{ old('term_name', $term->term_name ?? '') }}">
                    <button type="submit" class="btn" style="background-color: #009DE1; color:white">Add</button>
                    <a href="{{ url('term&subject/term') }}" class="btn" style="background: rgb(154, 154, 154); color:white">Cancel</a>
                </div>
                @error('term_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </form>
            <!-- search  -->
            <form class="col-md-5">
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control border border-1" placeholder="search by file name">
                    <button type="submit" class="btn" style="background-color: #009DE1; color: white">
                        <i class="bx bx-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
        <!-- content table  -->
        <div class="table-responsive text-nowrap" id="containterm">
            @include('content.term.table')
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <p>Total Records: {{ $terms->total() }}</p>
            {{ $terms->links() }}
        </div>
    </div>
</div>

<!-- search ajax  -->
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/term&subject/term/search',
                data: {
                    'search': $value
                },
                success: function(data) {
                    console.log(data);
                    $('#containterm').html(data);
                },
            });
        });
    });
</script>
@endsection