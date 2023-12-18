@foreach ($calls_reports as $cr)
    <tr>
        <td>{{ $cr->customer_id }}</td>
        <td>{{ $cr->numberofcallswithinsamecontinent }}</td>
        <td>{{ $cr->totaldurationwithinsamecontinent }}</td>
        <td>{{ $cr->totalnumberofallcalls }}</td>
        <td>{{ $cr->totaldurationofallcalls }}</td>
    </tr>
@endforeach
{{-- <tr><td colspan="7">{{ $calls_reports->links() }}</td></tr> --}}

<script>
    
</script>