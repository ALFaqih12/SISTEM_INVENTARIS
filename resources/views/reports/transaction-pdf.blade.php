<h2>Laporan Transaksi</h2>

<table border="1" width="100%">
    <tr>
        <th>No Transaksi</th>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Status</th>
    </tr>

    @foreach($transactions as $trx)
    <tr>
        <td>{{ $trx->transaction_number }}</td>
        <td>{{ $trx->transaction_date }}</td>
        <td>{{ $trx->transactionType->transaction_type_name ?? '-' }}</td>
        <td>{{ $trx->status }}</td>
    </tr>
    @endforeach
</table>