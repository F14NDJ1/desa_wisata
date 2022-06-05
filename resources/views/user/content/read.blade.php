<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
<style>
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        color: #ffff;
    }

    select {
        color: #ffff;
    }

    .dataTables_wrapper .dataTables_length select {
        background-color: #162a4b
    }

    .dataTables_wrapper .dataTables_filter input {
        background-color: white;
    }


    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #ffff;
        border: #ffff
    }

</style>

<div class="table-responsive mb-3">
    <table id="myTable" class="display table align-items-center table-dark table-flush">
        <thead class="thead-dark">
            <tr>
                <th>Name Content</th>
                <!-- {{-- <th>Detail Content</th> --}} -->
                <th>Added at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($data as $item)
                <tr>
                    <td> {{ $item->name_content }}</td>
                    {{-- <td>{{ $item->content }}</td> --}}
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <button class="btn btn-warning"
                            onClick="show('{{ $item->content_kind_id }}','{{ $item->id }}')">Edit</button>
                        <button class="btn btn-danger"
                            onClick="destroy('{{ $item->content_kind_id }}','{{ $item->id }}')">Delete</button>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();

    });
</script>
