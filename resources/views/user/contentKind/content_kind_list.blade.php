@extends('user.template.main')

@section('meta_token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> --}}
@endsection

@section('route')
    <h6 class="h2 text-white d-inline-block mb-0">Content Kinds</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="/user/home"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/user/contentKind/content_kind_list">Content Kinds</a></li>
        </ol>
    </nav>
@endsection

@section('container')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow">
                    <div class="col-lg-12">
                        <div class="row mt-4">
                            <div class="col">
                                <h1 class="text-white mt-2 d-inline">Content Kind</h1>
                                <button type="button" class="ml-4 align-items-center btn btn-primary d-inline"
                                    onClick="create()">+ Add
                                    Content
                                    Kind</button>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div id="read" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Content Kind</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="page" class="p-2"></div>
                </div> --}}
                <div id="page" class="p-2"></div>
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
            var id = {{ auth()->user()->id }};
            // debugger;
            $.get("{{ url('/user/contentKind/read') }}", {}, function(data, status) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#read").html(data);
            });
        }

        function create() {
            $.get("{{ url('/user/contentKind/create') }}", {}, function(data, status) {
                $("#exampleModalLabel").html('Add User')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        function store() {
            var name_content_kind = $("#name_content_kind").val();
            var detail_content_kind = $("#detail_content_kind").val();
            var user_id = $("#user_id").val();
            debugger;
            $.ajax({
                type: "post",
                url: "{{ url('/user/contentKind/store') }}",
                data: {
                    "name_content_kind": name_content_kind,
                    "detail_content_kind": detail_content_kind,
                    "user_id": user_id,
                },
                success: function(data) {
                    $(".close").click();
                    read();
                    Command: toastr["success"]("Content Kind Success Added !", "Add Content Kind")

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }

                },
                /* error: function(xhr, status, error) {
                    alert("Error!" + xhr.status + " " + error);
                }, */
            });
        }

        function show(id) {
            $.get("{{ url('/user/contentKind/show') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Content Kind')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }

        function update(id) {
            var name_content_kind = $("#name_content_kind").val();
            var detail_content_kind = $("#detail_content_kind").val();
            debugger;
            $.ajax({
                type: "post",
                url: "{{ url('/user/contentKind/update') }}/" + id,
                data: {
                    "name_content_kind": name_content_kind,
                    "detail_content_kind": detail_content_kind,
                },
                success: function(data) {
                    $(".close").click();
                    read();
                    Command: toastr["warning"]("Content Kind Success Edited !", "Edit Content Kind")

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error!" + xhr.status + error);
                    Command: toastr["error"]("Content Kind Fail Edited !", "Edit Content Kind")

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                },
            });
        }

        function destroy(name_content, id) {
            debugger;
            var result = confirm("Want to delete? The all content in " + name_content + " want be delete.");
            if (result) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/user/contentKind/destroy') }}/" + id,
                    success: function(data) {
                        $(".btn-close").click();
                        read();
                        Command: toastr["error"]("Content Kind Success Deleted !", "Delete Content Kind")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    }
                });
            }
        }
    </script>
@endsection
