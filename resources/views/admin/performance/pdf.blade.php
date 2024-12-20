<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        caption {
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <table>
        <caption>Employee Report</caption>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Subscriber Name</th>
                <th>Subscriber ID</th>
                <th>Created At</th>
                <th>Subscription Price</th>
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
</body>

</html>
