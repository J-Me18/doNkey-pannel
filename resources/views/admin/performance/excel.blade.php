<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Subscriber Name</th>
            <th>Subscriber ID</th>
            <th>Created At</th>
            <th>Subscription Amount</th>
            <th>Subscription Date</th>
            <th>Expiry Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employee as $subscriber)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subscriber->name }}</td>
                <td>{{ $subscriber->subscriberId }}</td>
                <td>{{ $subscriber->created_at->format('d-m-Y h:i A') }}</td>
                <td>{{ $subscriber->subscription_price }}</td>
                <td>{{ $subscriber->subscriptionDate->format('d-m-Y') }}</td>
                <td>{{ $subscriber->expiryDate->format('d-m-Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
