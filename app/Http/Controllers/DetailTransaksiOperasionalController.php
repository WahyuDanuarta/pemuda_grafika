<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiOperasional;
use App\Models\TransaksiOperasional;
use Illuminate\Http\Request;

class DetailTransaksiOperasionalController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'start_year' => 'nullable|integer',
            'start_month' => 'nullable|integer|min:1|max:12',
        ]);

        // Ambil data transaksi operasional dengan filter dan urutkan berdasarkan created_at (desc)
        $transaksiOperasionals = TransaksiOperasional::with(['admin', 'detailTransaksiOperasionals.kategoriOperasional'])
            ->when($request->filled('start_date'), function ($query) use ($request) {
                // Filter berdasarkan tanggal jika start_date diisi
                $query->whereDate('created_at', $request->start_date);
            })
            ->when($request->filled('start_year'), function ($query) use ($request) {
                // Filter berdasarkan tahun jika start_year diisi
                $query->whereYear('created_at', $request->start_year);
            })
            ->when($request->filled('start_month'), function ($query) use ($request) {
                // Filter berdasarkan bulan jika start_month diisi
                $query->whereMonth('created_at', $request->start_month);
            })
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->get();

        // Cek jika data kosong
        $noDataMessage = $transaksiOperasionals->isEmpty() ? "Data tidak ditemukan!" : null;

        // Menghitung total biaya dari transaksi operasional
        $total_pengeluaran = $transaksiOperasionals->sum('biaya'); 

        // Mengirimkan data ke view
        return view('pages.owner.detail_transaksi_operasionals.index', compact('transaksiOperasionals', 'total_pengeluaran', 'noDataMessage'));
    }
}