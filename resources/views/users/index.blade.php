<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12">
        <a href="#" class="btn btn-primary" id="btn-user-create">Create User</a>
        <a href="#" class="btn btn-success" id="reports-page">REPORT</a>
    </div>
</div>
@if ($count_user > 0)
    <div
        class="mt-5
        table-responsive 
        table-responsive-lg 
        table-responsive-sm 
        table-responsive-md 
        table-responsive-xl">
        <table class="table 
            table-borderless"
            id="manage-table">
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
            <tbody id="manage-table-body">
                
            </tbody>
        </table>
    </div>
@else
    <h1>No Data Found</h1>
@endif

<script>
    $('.page-item').removeClass('active');
    $('#manage-table-body').load("{{ route('users.fl') }}");

    $('#reports-page').on('click', function() {
        $('#view').empty();
        $('#view').load('{{ route("calls.index") }}');
    });

    $('#btn-user-create').on('click', function() {
        $('#view').empty();
        $('#view').load('{{ route('users.create') }}');
    });

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getData(page);
            }
        }
    });

    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var myurl = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];
            console.log(page);
            $('#manage-table-body').empty();
            $('#manage-table-body').load("{{ route('users.fl') }}?page=" + page);
        });
    });
</script>
