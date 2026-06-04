<h2>Laporan Anggaran</h2>

<table border="1" width="100%">
    <tr>
        <th>No Transaksi</th>
        <th>Sumber Dana</th>
        <th>Anggaran</th>
        <th>Realisasi</th>
        <th>Selisih</th>
    </tr>

    @foreach($transactions as $trx)
    <tr>
        <td>{{ $trx->transaction_number }}</td>
        <td>{{ $trx->source_of_founds }}</td>
        <td>{{ number_format($trx->total_budget,0,',','.') }}</td>
        <td>{{ number_format($trx->budget_realization,0,',','.') }}</td>
        <td>{{ number_format($trx->total_budget - $trx->budget_realization,0,',','.') }}</td>
    </tr>
    @endforeach
</table>