<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Form Edit Content Kind</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" enctype="multipart/form-data" id="image-upload" action="javascript:void(0)">
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="content" class="form-label">Name Content</label>
                <input type="text" class="form-control" id="name_content" name="name_content"
                    value="{{ $data->name_content }}">
                <input type="text" class="form-control" id="id" name="id" value="{{ $data->id }}" hidden>
                <input type="text" class="form-control" id="content_kind_id" name="content_kind_id"
                    value="{{ $data->conten_kind_id }}" hidden>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $data->user_id }}"
                    hidden>
            </div>

            <div class="col-md-6 form-group">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" id="url" name="url" required value="{{ $data->url }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md form-group">
                <div class="form-group">
                    <label> Content </label>
                    <textarea class="form-control" id="content" placeholder="Enter the Description"
                        name="content">{{ $data->content }}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md form-group mt-2">
                <div class="form-group">
                    <input type="file" name="thumbnail" placeholder="Choose image" id="thumbnail" class="form-control"
                        url>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md form-group mt-2">
                <img src="\images\{{ $data->thumbnail }}" id="preview-image-before-upload" alt="preview image"
                    style="width: 220px; height: 260px;" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md form-group mt-2">
                <button type="submit" class="btn btn-success" id="submit">Update</button>
            </div>
        </div>
    </form>
</div>
<script>
    ClassicEditor.create(document.querySelector('#content')).catch(error => {
        console.error(error);
    });
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
            var name_content = $("#name_content").val();
            var id_content = $("#id").val();
            debugger;
            $.ajax({
                type: 'POST',
                url: "{{ url('/user/contentKind/update') }}/" + name_content + "/" +
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
                    Command: toastr["warning"]("Conten Kind Success Edited !",
                        "Edit Content Kind")

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
