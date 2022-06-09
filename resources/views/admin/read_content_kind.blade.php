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
                <th>Content Kind</th>
                <th>Detail</th>
                <th>Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($data as $item)
                <tr>
                    <td class="text-white">{{ $item->name_content_kind }}</td>
                    <td class="text-white">{{ $item->detail_content_kind }}</td>
                    <td class="text-white">{{ $item->name }}</td>
                    <td>
                        {{-- <a class="text-white" href="{{ $item->name_content_kind }}/{{ $item->id }}"><button
                                class="btn btn-info mr-2">View
                            </button></a> --}}
                        <button class="btn btn-info"
                            onClick="view('{{ $item->name_content_kind }}/{{ $item->id }}')">View</button>

                        <button class="btn btn-warning" onClick="admin_show('{{ $item->id }}')">Edit</button>
                        <button class="btn btn-danger"
                            onClick="admin_destroy('{{ $item->name_content_kind }}','{{ $item->id }}')">Delete</button>
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
