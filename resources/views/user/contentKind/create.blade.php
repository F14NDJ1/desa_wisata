<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Form Input Content Kind</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="javascript:void(0)" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md form-group mt-2">
            <label for="contentKind" class="form-label">Category</label>
            <select class="form-control" data-toggle="select" id="category" name="category">
                <option value="">--Select Category--</option>
                <option value="About - ">About</option>
                <option value="Artikel - ">Artikel</option>
                <option value="Galeri - ">Galeri</option>
                <option value="Banner - ">Banner</option>
            </select>
        </div>

        <div class="col-md form-group mt-2">
            <label for="contentKind" class="form-label">Content Kind</label>
            <input type="text" class="form-control" id="name_content_kind" name="name_content_kind" required>
        </div>

        <div class="col-md form-group mt-2">
            <label for="inputName" class="form-label">Detail</label>
            <input type="text" class="form-control" id="detail_content_kind" name="detail_content_kind" required>
        </div>

        <input type="text" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}" hidden>

        <div class="col-md form-group mt-2">
            <button class="btn btn-success" onClick="store()">Add</button>
        </div>
    </form>
</div>

<script>
    function displayVals() {
        var singleValues = $("#category").val();
        // When using jQuery 3:
        // var multipleValues = $( "#multiple" ).val();
        $("#name_content_kind").val(singleValues);
    }


    $("select").change(displayVals);
    displayVals();
</script>
