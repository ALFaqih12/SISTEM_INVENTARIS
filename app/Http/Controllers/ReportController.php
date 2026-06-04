<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryTransaction;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function stockPdf()
    {
        $inventories = Inventory::with('item')->get();

        $pdf = Pdf::loadView(
            'reports.stock-pdf',
            compact('inventories')
        );

        return $pdf->download('laporan-stok.pdf');
    }


    public function transactionPdf()
    {
        $transactions = InventoryTransaction::with('transactionType')
            ->get();

        $pdf = Pdf::loadView(
            'reports.transaction-pdf',
            compact('transactions')
        );

        return $pdf->download(
            'laporan-transaksi.pdf'
        );
    }

    public function budgetPdf()
    {
        $transactions = InventoryTransaction::with('transactionType')
            ->get();

        $pdf = Pdf::loadView(
            'reports.budget-pdf',
            compact('transactions')
        );

        return $pdf->download(
            'laporan-anggaran.pdf'
        );
    }
}