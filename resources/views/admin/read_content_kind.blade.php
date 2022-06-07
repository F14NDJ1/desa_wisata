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
                <th>Name</th>
                <th>Content Kind</th>
                <th>Content</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($data as $item)
                <tr>

                    <td class="text-white">{{ $item->name }}</td>
                    <td class="text-white">{{ $item->content_kind_count }}</td>
                    <td class="text-white">{{ $item->content_count }}</td>
                    <td>
                        <button class="btn btn-warning" onClick="show('{{ $item->id }}')">View</button>
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
