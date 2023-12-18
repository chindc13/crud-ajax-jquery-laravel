<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div id="message"></div>
        <div class="form-group">
            <label for="filecsv">File CSV <i class="text-danger">*</i></label>
            <input type="file" name="filecsv" id="filecsv" class="form-control">
            <div class="invalid-feedback" id="filecsv-invalid-feedback"></div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary" id="submit-file">SUBMIT</button>
            <a href="#" class="btn btn-success" id="users-page">USERS</a>
        </div>
    </div>
</div>
<div
    class="mt-5
        table-responsive 
        table-responsive-lg 
        table-responsive-sm 
        table-responsive-md 
        table-responsive-xl">
    <table class="table 
            table-borderless" id="manage-table">
        <thead>
            <tr>
                <th scope="col">Customer ID</th>
                <th scope="col">No. of calls</th>
                <th scope="col">Total Duration of calls</th>
                <th scope="col">Total Number of all calls</th>
                <th scope="col">Total Duration of all calls</th>
            </tr>
        </thead>
        <tbody id="manage-table-body">

        </tbody>
    </table>
</div>

<script>
    $('#manage-table-body').load("{{ route('calls.fl') }}");

    $('#users-page').on('click', function() {
        $('#view').empty();
        $('#view').load('{{ route("users.index") }}');
    });

    $('#submit-file').on('click', function() {
        $('#m-message').empty();
        $('#message').empty();
        $('#invalid-feedback').empty();
        $('.form-control').removeClass('is-invalid');

        var form = new FormData();
        form.append('filecsv', filecsv.files[0]);

        $.ajax({
            type: 'POST',
            data: form,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            url: '{{ route("calls.store") }}',
            success: function(data) {
                $('#m-message').append('<div class="alert alert-success">CSV Import Success</div>');

                $('#manage-table-body').empty();
                $('#manage-table-body').load("{{ route('calls.fl') }}");
            },
            error: function(data) {
                $('#message').append('<div class="alert alert-danger">' + data.responseJSON
                    .message + '</div>');

                if (data.responseJSON.errors.hasOwnProperty("filecsv")) {
                    $('#filecsv').addClass('is-invalid');
                    $('#filecsv-invalid-feedback').append(data.responseJSON.errors.filecsv);
                }
            }
        });
    });
</script>
