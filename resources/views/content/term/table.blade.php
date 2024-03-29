<table class="table table-striped">
    <thead>
        <tr>
            <td>N.o</td>
            <th>Term</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @php
        $rowNumber = 1;
        @endphp
        @foreach ($terms as $term)
        <tr>
            <td>{{ $rowNumber }}</td>
            <td>{{ $term->term_name }}</td>
            <td>
                <a href="{{ route('term.edit', $term->id) }}" class="btn btn-sm" style="background-color: #009DE1; color:white" data-bs-toggle="modal" data-bs-target="#confirmEdit{{ $term->id }}">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                </a>
                <button type="button" class="btn btn-sm" style="background-color: #E85252; color:white" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $term->id }}">
                    <i class="bx bx-trash me-1"></i> Delete
                </button>
            </td>
        </tr>
        @include('content.term.edit')
        @include('content.term.delete')
        @php
        $rowNumber++;
        @endphp
        @endforeach
    </tbody>
</table>

<!-- search ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
</script>