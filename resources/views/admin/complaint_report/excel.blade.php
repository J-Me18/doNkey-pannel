<table class="table datatables" id="dataTable-1">
    <thead>
        <tr>
            <th>#</th>
            <th>Complaint ID</th>
            <th>Status</th>
            <th>complained By</th>
            <th>complained At</th>
            <th>Solved By</th>
            <th>Solved At</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($complaints as $complaint)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $complaint->complaintID }}</td>
                <td>{{ $complaint->status ? $complaint->status : '-' }}</td>
                <td>{{ $complaint->complained_by }}</td>
                <td>{{ $complaint->created_at->format('d-m-Y h:i A') }}</td>
                <td>{{ $complaint->solved_by }}</td>
                <td>{{ $complaint->updated_at->format('d-m-Y h:i A') }}</td>

            </tr>
        @endforeach
    </tbody>
</table>