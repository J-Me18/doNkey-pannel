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
        <caption>Expiring Subscriber's List</caption>        
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
            @php
                $totalAmount = 0;
            @endphp
             @foreach ($expiredSubscribers as $subscriber)
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
</body>

</html>
