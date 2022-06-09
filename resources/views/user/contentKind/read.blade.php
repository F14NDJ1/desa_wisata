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
    <table id="content_kind" class="display table align-items-center table-dark table-flush">
        <thead class="thead-dark">
            <tr>
                <th>Content Kind</th>
                <th>Detail</th>
                <th>Create</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($data as $item)
                <tr>
                    <td> <a class="text-white"
                            href="{{ $item->name_content_kind }}/{{ $item->id }}">{{ $item->name_content_kind }}</a>
                    </td>
                    <td>{{ $item->detail_content_kind }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <a class="text-white" href="{{ $item->name_content_kind }}/{{ $item->id }}"><button
                                class="btn btn-info mr-2">View
                            </button></a>
                        <button class="btn btn-warning" onClick="show('{{ $item->id }}')">Edit</button>
                        <button class="btn btn-danger"
                            onClick="destroy('{{ $item->name_content_kind }}','{{ $item->id }}')">Delete</button>

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>


<script>
    $(document).ready(function() {
        $('#content_kind').DataTable();

    });
</script>
