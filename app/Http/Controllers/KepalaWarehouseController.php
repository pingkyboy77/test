<?php

namespace App\Http\Controllers;

use App\Models\HistoryMasukStock;
use App\Models\ProjectManagement;
use App\Models\Warehouse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
// use Barryvdh\DomPDF\PDF as DomPDFPDF;
// use Barryvdh\DomPDF\PDF;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class KepalaWarehouseController extends Controller
{
    public function index(){
        $kepala_warehouse = User::where('role', 'kepala_warehouse')->get();
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        // dd($nama);
        $warehouse = Warehouse::where('kepala' , $nama)->get();
        // dd($warehouse);
        return view('kepala-warehouse.warehouseManagement', compact('warehouse', 'nama', 'role', 'kepala_warehouse'));
    }
    public function indexHistory()
{
    $user = Auth::user();
    $nama = $user->nama;
    $role = $user->role;
    $warehouse = Warehouse::where('kepala', $nama)->pluck('nama');
    $history_masuk = HistoryMasukStock::whereIn('warehouse_name', $warehouse)->get();

    if ($warehouse->isNotEmpty()) {
        $dataManagement = ProjectManagement::where('asal_warehouse', $warehouse[0])->get();
    } else {
        $dataManagement = [];
    }

    // dd($history_masuk, $dataManagement);

    
        // $data = ProjectManagement::get();
        // dd($dataManagement);
        return view('kepala-warehouse.history', compact('dataManagement', 'nama', 'role', 'history_masuk'));
    }

    public function updateWarehouse($id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $warehouse = Warehouse::find($id);
        $kepala_warehouse = User::where('role', 'kepala_warehouse')->get();
        // $kategori = Kategori::orderBy('created_at', 'desc')->pluck('kategori');
        return view('kepala-warehouse.updateWarehouse', compact('warehouse', 'user', 'role', 'nama', 'kepala_warehouse'));
    }

    public function updatedWarehouse(Request $request)
{
    $history = $request->validate([
        'stock' => 'required',
        'tanggal_masuk' => 'required',
        'warehouse_name' => 'required',
    ]);
    
    HistoryMasukStock::create($history);
    
    $warehouse = Warehouse::where('nama' , $request->input('warehouse_name'))->first();
    $stock_lama = $warehouse->stock;
    
    $warehouse->edited_by = Auth::user()->nama . ' (' . Auth::user()->role . ')';
    $warehouse->stock = $stock_lama + $request->input('stock');
    $warehouse->save();

    Alert::success('Sukses', 'Data Berhasil Di Simpan');
    return redirect()->route('warehouse-Management.kepala');
}

public function cetakHistoryMasuk()
{
    $user = Auth::user();
    $nama = $user->nama;
    $role = $user->role;
    $warehouse = Warehouse::where('kepala', $nama)->pluck('nama');
    $data = HistoryMasukStock::whereIn('warehouse_name', $warehouse)->get();
    $pdf = PDF::loadView('print.historyMasuk', compact('data'));

    // Tampilkan PDF di browser
    return $pdf->stream('laporan_history.pdf');

    // Atau untuk mengunduh PDF
    // return $pdf->download('laporan_history.pdf');
}
public function cetakHistoryKeluar()
{
    $user = Auth::user();
    $nama = $user->nama;
    $role = $user->role;
    $warehouse = Warehouse::where('kepala', $nama)->pluck('nama');
    $history_masuk = HistoryMasukStock::whereIn('warehouse_name', $warehouse)->get();

    if ($warehouse->isNotEmpty()) {
        $dataManagement = ProjectManagement::where('asal_warehouse', $warehouse[0])->get();
        $data= $dataManagement;
        $pdf = PDF::loadView('print.historyKeluar', compact('data'));
        return $pdf->stream('laporan_history.pdf');
    } else {
        $dataManagement = [];
        Alert::error('eror' ,'DATA KELUAR TIDAK ADA');
    }
}
}
