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
    <table class="table datatables" id="dataTable-1">
        <thead>
            <tr>

                <th>S.No</th>
                <th>Email</th>
                <th>Created_at</th>


            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($newsletters as $newsletter)
                <tr>


                    <td>{{ $i }}</td>
                    <td>{{ $newsletter->email }}</td>
                    <td>{{ $newsletter->created_at->format('d-m-Y h:i:s') }}</td>


                </tr>
                <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
</body>

</html>
