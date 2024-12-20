<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Employee Name</th>
            <th>Employee ID</th>
            <th>Check In Date</th>
            <th>Check In Time</th>
            <th>Check Out Date</th>
            <th>Check Out Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employee->checking as $emp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->emp_id }}</td>
                <td>{{ $emp->created_at->format('d-m-Y') }}</td>
                <td>{{ $emp->created_at->format('t:i:s A') }}</td>
                @if ($emp->created_at == $emp->updated_at)
                    <td>Not Yet</td>
                    <td>Not Yet</td>
                @else
                    <td>{{ $emp->updated_at->format('d-m-Y') }}</td>
                    <td>{{ $emp->updated_at->format('t:i:s A') }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
