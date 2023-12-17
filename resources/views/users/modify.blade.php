<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div id="message"></div>
        <div class="form-group">
            <label for="name">Name <i class="text-danger">*</i></label>
            <input id="name" class="form-control" type="text" name="name" value="{{ $user->name ?? '' }}">
            <div class="invalid-feedback" id="name-invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="Username">Username <i class="text-danger">*</i></label>
            <input id="username" class="form-control" type="text" name="username"
                value="{{ $user->username ?? '' }}">
            <div class="invalid-feedback" id="username-invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="email">Email <i class="text-danger">*</i></label>
            <input id="email" class="form-control" type="email" name="email" value="{{ $user->email ?? '' }}">
            <div class="invalid-feedback" id="email-invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="birth">Birth <i class="text-danger">*</i></label>
            <input id="birth" class="form-control" type="date" name="birth" value="{{ $user->birth ?? '' }}">
            <div class="invalid-feedback" id="birth-invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="addfile">Addional Details with File <i class="text-secondary">Optional</i></label>
            <input id="addfile" class="form-control" type="file" name="addfile">
            <div class="invalid-feedback" id="addfile-invalid-feedback"></div>
        </div>
        @if (!Request::is('users/create'))
            @if (count($user_files) > 0)
                <div
                    class="mt-5
                    table-responsive 
                    table-responsive-lg 
                    table-responsive-sm 
                    table-responsive-md 
                    table-responsive-xl">
                    <table
                        class="table 
                        table-borderless 
                        table-hover 
                        table-striped"
                        id="notificationTables">
                        <thead>
                            <tr>
                                <th scope="col">File</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_files as $uf)
                                <tr>
                                    <td><a href="{{ URL::to('/storage/uploads/' . $uf->file) }}"
                                            target="_blank">{{ $uf->file }}</a></td>
                                    <td>{{ $uf->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
        <div class="form-group">
            <button class="btn btn-secondary" id="btn-back">Back</button>
            <button class="btn btn-primary" id="btn-submit">Submit</button>
        </div>
    </div>
</div>

<script>
    var url = '';
    var type = '';
    var message = '';

    $('.form-control').on('keypress', function(e) {
        if (e.which == 13) {
            $('#btn-submit').click();
        }
    });

    $('#btn-back').on('click', function() {
        $('#view').empty();
        $('#view').load("{{ route('users.index') }}");
    });

    $('#btn-submit').on('click', function() {
        $('#m-message').empty();
        $('#message').empty();
        $('#invalid-feedback').empty();
        $('.form-control').removeClass('is-invalid');

        var form = new FormData();
        form.append('addfile', addfile.files[0]);
        form.append('name', $('#name').val());
        form.append('email', $('#email').val());
        form.append('birth', $('#birth').val());
        form.append('username', $('#username').val());

        @if (Request::is('users/create'))
            url = "{{ route('users.store') }}";
            message = 'Create Success!';
        @else
            url = "{{ route('users.update', Request::route('user')) }}";
            message = 'Update Success!';
            form.append('_method', 'PUT');
        @endif

        $.ajax({
            type: 'POST',
            data: form,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            url: url,
            success: function(data) {
                $('#view').empty();
                $('#m-message').append('<div class="alert alert-success">' + message + '</div>');
                $('#view').load("{{ route('users.index') }}");
            },
            error: function(data) {
                $('#message').append('<div class="alert alert-danger">' + data.responseJSON
                    .message + '</div>');

                if (data.responseJSON.errors.hasOwnProperty("name")) {
                    $('#name').addClass('is-invalid');
                    $('#name-invalid-feedback').append(data.responseJSON.errors.name);
                }

                if (data.responseJSON.errors.hasOwnProperty("email")) {
                    $('#email').addClass('is-invalid');
                    $('#email-invalid-feedback').append(data.responseJSON.errors.email);
                }

                if (data.responseJSON.errors.hasOwnProperty("birth")) {
                    $('#birth').addClass('is-invalid');
                    $('#birth-invalid-feedback').append(data.responseJSON.errors.birth);
                }

                if (data.responseJSON.errors.hasOwnProperty("username")) {
                    $('#username').addClass('is-invalid');
                    $('#username-invalid-feedback').append(data.responseJSON.errors.username);
                }
            }
        });
    });
</script>
