@extends('user.template.main')

@section('meta_token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
@endsection
@section('route')
    <h6 class="h2 text-white d-inline-block mb-0">Contents</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="/user/home"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/user/contentKind/content_kind_list">Content Kinds</a></li>
            <li class="breadcrumb-item"><a
                    href="/user/contentKind/{{ $data }}/{{ $id }}">{{ $data }}</a></li>
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
                                <h1 class="text-white mt-2 d-inline">Content</h1>
                                <button class="ml-4 align-items-center btn btn-primary d-inline"
                                    onClick="create('{{ $data }}','{{ $id }}')">+ Add
                                    Content</button>
                                <hr class="my-3">
                                <div id="read" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div id="pageContent" class="p-2"></div>
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
            read()
        });
        // Read Database
        function read() {
            var id = {{ $id }};
            // debugger;
            $.get("{{ url('/user/contentKind/read/{data}') }}/" + id, {}, function(data, status) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#read").html(data);
            });
        }

        function create(contentKind, id) {
            $.get("{{ url('/user/contentKind/create') }}/" + contentKind + "/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Add User')
                $("#pageContent").html(data);
                $("#exampleModalContent").modal('show');
            });
        }

        function show(contentKind, id) {
            $.get("{{ url('/user/contentKind/show') }}/" + contentKind + "/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Content Kind')
                $("#pageContent").html(data);
                $("#exampleModalContent").modal('show');
            });
        }

        function destroy(contentKind_id, id) {
            // debugger;
            var result = confirm("Want to delete?");
            if (result) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/user/contentKind/destroy') }}/" + contentKind_id + "/" + id,
                    success: function(data) {
                        $(".btn-close").click();
                        read();
                        Command: toastr["error"]("Content Success Deleted !", "Delete Content")

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

        function priview(contentKind, id) {
            debugger;
            $.get("{{ url('/user/contentKind/priview') }}/" + contentKind + "/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Edit Content Kind')
                $("#pageContent").html(data);
                $("#exampleModalContent").modal('show');
            });
        }
    </script>
@endsection
