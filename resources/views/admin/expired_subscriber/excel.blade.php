<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Subscriber ID</th>
            <th>Created By</th>
            <th>Name</th>
            <th>Location</th>
            <th>Pincode</th>
            <th>Account Type</th>
            <th>Mobile</th>
            <th>Expiry Date</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($expiredSubscribers as $subscriber)
            {{-- {{ $subscriber->driver }} --}}
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subscriber->subscriberId }}</td>
                <td>{{ $id[0] }}</td>
                <td>{{ $subscriber->name }}</td>
                <td>{{ $subscriber->location }}</td>
                <td>
                                            @php $subspin=json_decode($subscriber->pincode);
                                            foreach($pincode as $pin) { @endphp
                                            @if (in_array($pin->id, $subspin))
                                            {{ $pin->pincode }}
                                            @endif
                                            @php } @endphp
                                        </td>
                <td>{{ $subscriber->account_type ? $subscriber->account_type : 'N/A' }}</td>
                <td>{{ $subscriber->mobile }}</td>
                <td>{{ $subscriber->expiryDate->format('d-m-Y') }}</td>
        @endforeach
    </tbody>
</table>
