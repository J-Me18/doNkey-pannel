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