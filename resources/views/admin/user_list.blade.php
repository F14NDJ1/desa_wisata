@extends('admin.template.main')

@section('meta_token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> -->
@endsection

@section('route')
    <h6 class="h2 text-white d-inline-block mb-0">User List</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="/admin/home"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/admin/user_list">User List</a></li>
        </ol>
    </nav>
@endsection


@section('container')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card bg-default">
                    <div class="col-lg-12">
                        <div class="row mt-4">
                            <div class="col text-left">
                                <h1 class="text-white mt-2 d-inline">User List</h1>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="ml-4 align-items-center btn btn-primary d-inline"
                                    onClick="create()">+ Add User</button>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div id="read" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="page" class="p-2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            read();
        });
        // Read Database
        function read() {
            $.get("{{ url('/admin/read') }}", {}, function(data, status) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#read").html(data);
            });
        }

        function create() {
            $.get("{{ url('/admin/create') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Add User')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        function store() {
            var name = $("#name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var role = $("#role:checked").val();
            // debugger;
            $.ajax({
                type: "post",
                url: "{{ url('/admin/store') }}",
                data: {
                    "name": name,
                    "email": email,
                    "password": password,
                    "role": role
                },
                success: function(data) {
                    $(".btn-close").click();
                    $("#exampleModal").modal('hide');
                    read();
                    Command: toastr["success"]("Success Add User !", "Add User")
                },
                error: function(xhr, status, errors) {
                    Command: toastr["error"](xhr.responseJSON.message, "Add User Error")
                    read();
                },
            });
        }

        function show(id) {
            $.get("{{ url('/admin/show') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit User')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        function update(id) {
            var email = $("#email").val();
            var name = $("#name").val();
            var role = $("#role:checked").val();
            // debugger;
            $.ajax({
                type: "post",
                url: "{{ url('/admin/update') }}/" + id,
                data: {
                    "name": name,
                    "email": email,
                    //"password": password,
                    "role": role
                },
                success: function(data) {
                    $(".btn-close").click();
                    $("#exampleModal").modal('hide');
                    read();
                    Command: toastr["warning"]("Success Edit User !", "Edit User")
                },
                error: function(xhr, status, error) {
                    Command: toastr["error"](xhr.responseJSON.message, "Edit User Error");
                    read();
                },
            });
        }

        function destroy(id) {
            var result = confirm("Want to delete?");
            if (result) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/destroy') }}/" + id,
                    success: function(data) {
                        $(".btn-close").click();
                        read();
                        Command: toastr["error"]("User Success Deleted !", "Delete User")
                    },
                    error: function(xhr, status, errors) {
                        Command: toastr["error"](xhr.responseJSON.message, "Delete User Error");
                    },
                });
            }
        }
    </script>
@endsection
