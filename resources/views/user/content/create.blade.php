{{-- <link rel="stylesheet" href="../../../ckeditor/contents.css" type="text/css"> --}}


<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Form Input Content</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" enctype="multipart/form-data" id="image-upload" action="javascript:void(0)">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="content" class="form-label">Name Content</label>
                <input type="text" class="form-control" id="name_content" name="name_content" required autofocus>
                <input type="text" class="form-control" id="content_kind_name" name="content_kind_name"
                    value="{{ $data }}" hidden>
                <input type="text" class="form-control" id="content_kind_id" name="content_kind_id"
                    value="{{ $id }}" hidden>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"
                    hidden>

            </div>

            <div class="col-md-6">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>

            {{-- <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
        </div> --}}
            <div class="col-md-12 mb-2 mt-5">
                <input name="content" type="hidden">
                <div class="form-group">
                    <label> Content </label>
                    <textarea class="form-control" id="content" placeholder="Enter the Description" name="content" rows="3"></textarea>
                    {{-- <div id="editor"></div>
                    {{-- <div id="editor">
                        <p>This is some sample content.</p>
                    </div> --}}
                </div>
            </div>

            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <input type="file" name="thumbnail" placeholder="Choose image" id="thumbnail"
                        class="form-control">
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <img id="preview-image-before-upload" alt="preview image" style="width: 220px; height: 260px; "
                    class="form-control">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </div>
        </div>
    </form>
</div>

{{-- <script>
    ClassicEditor.create(document.querySelector('#content')).catch(error => {
        console.error(error);
    });
</script> --}}


<script>
    class MyUploadAdapter {
        constructor(loader) {
            // The file loader instance to use during the upload. It sounds scary but do not
            // worry — the loader will be passed into the adapter later on in this guide.
            this.loader = loader;
        }
        // Starts the upload process.
        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    this._initRequest();
                    this._initListeners(resolve, reject, file);
                    this._sendRequest(file);
                }));
        }
        // Aborts the upload process.
        abort() {
            if (this.xhr) {
                this.xhr.abort();
            }
        }
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            var name_content = $("#content_kind_name").val();
            var id_content = $("#content_kind_id").val();
            xhr.open('POST', "{{ url('store/image') }}", true);
            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
            xhr.responseType = 'json';
        }
        // Initializes XMLHttpRequest listeners.
        _initListeners(resolve, reject, file) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;
            xhr.addEventListener('error', () => reject(genericErrorText));
            xhr.addEventListener('abort', () => reject());
            xhr.addEventListener('load', () => {
                const response = xhr.response;
                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }
                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                resolve({
                    default: response.url
                });
            });
            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', evt => {
                    if (evt.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                });
            }
        }
        _sendRequest(file) {
            // Prepare the form data.
            const data = new FormData();
            data.append('upload', file);
            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.
            // Send the request.
            this.xhr.send(data);
        }
        // ...
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter(loader);
        };
    }


    ClassicEditor
        .create(document.querySelector('#content'), {
            extraPlugins: [MyCustomUploadAdapterPlugin],
        })


    // CKEDITOR.replace('content');
</script>



<script type="text/javascript">
    $(document).ready(function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#thumbnail').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('#image-upload').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var name_content = $("#content_kind_name").val();
            var id_content = $("#content_kind_id").val();
            debugger;
            $.ajax({
                type: 'POST',
                url: "{{ url('/user/contentKind/store') }}/" + name_content + "/" +
                    id_content,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    // alert('Data Tersimpan');
                    $(".close").click();
                    // alert(data);
                    read();
                    Command: toastr["success"]("Content Success Added !",
                        "Add Content Kind")

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
                error: function(data) {
                    console.log(data);
                }
            });
        });
        $("#name_content").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            $("#url").val(Text);
        });
    });
</script>
