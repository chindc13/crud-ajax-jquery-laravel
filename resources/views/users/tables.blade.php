@foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->birth }}</td>
        <td>{{ $user->created_at }}</td>
        <td>
            <a href="#" class="btn btn-warning btn-edit-user"
                data-url="{{ route('users.edit', $user->id) }}">Edit</a>
            <a href="#" class="btn btn-danger btn-delete-user"
                data-url="{{ route('users.destroy', $user->id) }}">Delete</a>
        </td>
    </tr>
@endforeach
<tr><td colspan="7">{{ $users->links() }}</td></tr>

<script>
    $('.btn-edit-user').on('click', function() {
        $('#view').empty();
        $('#view').load($(this).attr('data-url'));
    });

    $('.btn-delete-user').on('click', function() {
        $('#m-message').empty();
        $.ajax({
            type: 'DELETE',
            url: $(this).attr('data-url'),
            success: function(data) {
                $('#m-message').append('<div class="alert alert-success">Delete Successfully!</div>');
                $('#view').empty();
                $('#view').load("{{ route('users.index') }}");
                window.location = $(this).attr('data-url');
            },
            error: function(data) {
                alert(data);
            }
        });
    });
</script>