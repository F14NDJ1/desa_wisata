@extends('admin.template.main')

@section('meta_token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> -->
@endsection

@section('route')
    <h6 class="h2 text-white d-inline-block mb-0">Content Kind</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="/admin/home"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/admin/content_kind">Content Kind</a></li>
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
                                <h1 class="text-white mt-2 d-inline">Content Kind</h1>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div id="read" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            read();
        });
        // Read Database
        function read() {
            $.get("{{ url('/admin/admin_contentKind/read') }}", {}, function(data, status) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#read").html(data);
            });
        }
    </script>
@endsection
