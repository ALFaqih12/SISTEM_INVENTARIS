@php
    $barcodeGenerator = new \Milon\Barcode\DNS1D();
@endphp
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok</title>
</head>
<body>

<h2>Laporan Stok Barang</h2>

<table border="1" width="100%" cellspacing="0" cellpadding="5">

    <tr>
        <th>Barcode</th>
        <th>Barang</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Status</th>
    </tr>

    @foreach($inventories as $inventory)

    <tr>
        <td style="text-align:center">
            <img
                src="data:image/png;base64,{{ $barcodeGenerator->getBarcodePNG($inventory->barcode, 'C128') }}"
                width="150"
            >
            <br>
            <small>{{ $inventory->barcode }}</small>
        </td>
        <td>{{ $inventory->item->item_name ?? '-' }}</td>
        <td>{{ $inventory->quantity }}</td>
        <td>{{ number_format($inventory->price,0,',','.') }}</td>
        <td>{{ $inventory->status }}</td>
    </tr>

    @endforeach

</table>

</body>
</html>