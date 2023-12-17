<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12">
        <a href="#" class="btn btn-success" id="btn-user-create">Create User</a>
    </div>
</div>
@if (count($users) > 0)
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
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Birth</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->birth }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-edit-user" data-url="{{ route("users.edit", $user->id) }}">Edit</a>
                            <a href="#" class="btn btn-danger btn-delete-user" data-url="{{ route("users.destroy", $user->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <h1>No Data Found</h1>
@endif

<script>
    $('#btn-user-create').on('click', function(){
        $('#view').empty();
        $('#view').load('{{ route("users.create") }}');
    });

    $('.btn-edit-user').on('click', function(){
        $('#view').empty();
        $('#view').load($(this).attr('data-url'));
    });

    $('.btn-delete-user').on('click', function(){
        $.ajax({
            type: 'DELETE',
            url: $(this).attr('data-url'),
            success: function(data) {
                $('#m-message').append('<div class="alert alert-success">Delete Successfully!</div>');
                $('#view').empty();
                $('#view').load('{{ route("users.index") }}');
            },
            error: function(data) {
                alert(data);
            }
        });
    });

</script>