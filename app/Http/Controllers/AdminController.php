<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\User;
// use Illuminate\Console\View\Components\Alert;
use App\Models\Warehouse;
use App\Models\DaftarPasien;
use Illuminate\Http\Request;
use App\Models\HistoryMasukStock;
use App\Models\ProjectManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert as Alert;

class AdminController extends Controller
{
    //
    public function beranda()
    {
        
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;

        // dd($list_data);
        return view('dashboard', compact('nama', 'role'));
    }

    public function userManagement()
    {
        $user_id = User::get();
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        // $nama = 'dummy';
        // $role = 'dummy';
        return view('userManagement', compact('user', 'nama', 'role', 'user_id'));
    }

    public function warehouseManagement()
    {
        $warehouse = Warehouse::get();
        $kepala_warehouse = User::where('role', 'kepala_warehouse')->get();
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('warehouseManagement', compact('warehouse', 'nama', 'role', 'kepala_warehouse'));
    }

    public function dataManagement()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $data = DaftarPasien::get();
        $Dokter = User::where('role', 'Dokter')->get();
        return view('dataManagement', compact('nama', 'role', 'data', 'Dokter'));
    }

    public function materialStock()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        return view('materialStock', compact('nama', 'role'));
    }

    public function history()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $history_masuk = HistoryMasukStock::get();
        return view('history', compact('nama', 'role', 'history_masuk'));
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        Alert::success('Sukses', 'Data Berhasil Di Tambahkan');
        return $this->userManagement();
    }

    public function destroyUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            Alert::warning('Gagal', 'Data Tidak Ditemukan');
        }

        $user->delete();
        // $user_role = 'admin';
        // $route = 'user-Management';
        Alert::success('Sukses', 'Data Berhasil Di Hapus');
        return $this->userManagement();
    }

    public function updateUser($id)
    {
        $user_id = User::find($id);
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        // $kategori = Kategori::orderBy('created_at', 'desc')->pluck('kategori');
        return view('updateUser', compact('user', 'nama', 'role', 'user_id'));
    }

    public function updatedUser(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
        ];
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        // $user_role = 'admin';
        // $route = $user_role . '/user-Management';
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return $this->userManagement();
    }

    public function storeWarehouse(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'kepala' => 'required',
            'lokasi' => 'required',
            'stock' => 'required',
        ]);

        $data['edited_by'] = Auth::user()->nama;
        // $data['password'] = Hash::make($data['password']);
        Warehouse::create($data);

        Alert::success('Sukses', 'Data Berhasil Di Tambahkan');
        return redirect()->route('warehouse-Management.admin');
    }

    public function destroyWarehouse($id)
    {
        $warehouse = Warehouse::find($id);

        if (!$warehouse) {
            Alert::warning('Gagal', 'Data Tidak Ditemukan');
        }

        $warehouse->delete();
        // $user_role = 'admin';
        // $route = 'user-Management';
        Alert::success('Sukses', 'Data Berhasil Di Hapus');
        return $this->warehouseManagement();
    }

    public function updateWarehouse($id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $warehouse = Warehouse::find($id);
        $kepala_warehouse = User::where('role', 'kepala_warehouse')->get();
        // $kategori = Kategori::orderBy('created_at', 'desc')->pluck('kategori');
        return view('updateWarehouse', compact('warehouse', 'user', 'role', 'nama', 'kepala_warehouse'));
    }

    public function updatedWarehouse(Request $request, string $id)
    {
        //
        $warehouse = Warehouse::find($id);
        $request->validate([
            'nama' => 'required',
            'kepala' => 'required',
            'lokasi' => 'required',
            'stock' => 'required',
            // 'edited_by' => 'required'
        ]);

        $warehouse = Warehouse::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'kepala' => $request->kepala,
            'lokasi' => $request->lokasi,
            'stock' => $request->stock,
        ];

        $data['edited_by'] = Auth::user()->nama;
        // $data['password'] = Hash::make($data['password']);
        $warehouse->update($data);
        // $user_role = 'admin';
        // $route = $user_role . '/user-Management';
        Alert::success('Sukses', 'Data Berhasil Di Update');
        return $this->warehouseManagement();
    }

    public function storeData(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'wilayah' => 'required',
            'nama_pasien' => 'required',
            'dokter' => 'required',
            'keluhan' => 'required',
            // 'tindakan' => 'required',
            // 'obat' => 'required',
            'guldar' => 'required',
            'tbbb' => 'required',
            'tensi' => 'required',
            'alergi' => 'required',
            'edited_by' => 'required',
        ]);

        DaftarPasien::create($data);

        Alert::success('Sukses', 'Data Berhasil Di Tambahkan');
        return redirect()->route('data-Management');
    }
    public function updateTindakan(Request $request, $id)
    {
        // dd($request->all());
        $data = $request->validate([
            'tindakan' => 'required',
            'obat' => 'required',
        ]);

        $data_pasien = DaftarPasien::findOrFail($id);
        $data_pasien->tindakan = $request->tindakan;
        $data_pasien->obat = $request->obat;
        $data_pasien->edited_by = Auth::user()->nama;
        $data_pasien->save();

        Alert::success('Sukses', 'Data Berhasil Di Tambahkan');
        return redirect()->route('workorder.keproj');
    }

    public function updateData($id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $data = ProjectManagement::find($id);
        $kepala = User::where('role', 'kepala_project')->get();
        $asal_warehouse = Warehouse::where('nama', $data['asal_warehouse'])->first();
        $warehouse = Warehouse::get();
        // if ($data['stock'] <= $asal_warehouse->stock) {
        //     $asal_warehouse->stock = $asal_warehouse->stock - $data['stock'];
        //     $asal_warehouse->save();
        // } else {
        //     Alert::warning('Gagal', 'Stock Tidak Cukup');
        //     return redirect()->route('data-Management');
        // }

        // $kepala = User::pluck('role', 'id');
        // dd($asal_warehouse->nama);
        return view('updateDataManagement', compact('user', 'role', 'nama', 'kepala', 'data', 'asal_warehouse', 'warehouse'));
    }

    public function updatedData(Request $request, string $id)
    {
        // dd($request->all());
        $asal_warehouse = Warehouse::where('nama', $request->input('asal_warehouse'))->first();

        if (!$asal_warehouse) {
            Alert::warning('Gagal', 'Gudang Asal tidak ditemukan');
            return redirect()->route('data-Management');
        }

        $data = ProjectManagement::find($id);
        $stock_lama = $data->stock;
        $datastock = $request->input('stock');

        if ($datastock <= $asal_warehouse->stock) {
            $asal_warehouse->stock = $asal_warehouse->stock - $request->input('stock') + $stock_lama;
            $asal_warehouse->edited_by = Auth::user()->nama . ' (' . Auth::user()->role . ')';

            $asal_warehouse->save();

            $data->lokasi = $request->input('lokasi');
            $data->volume = $request->input('volume');
            $data->stock = $request->input('stock');
            $data->waktu_mulai = $request->input('waktu_mulai');
            $data->waktu_selesai = $request->input('waktu_selesai');
            $data->kepala = $request->input('kepala');
            $data->status = $request->input('status');

            $data->edited_by = Auth::user()->nama . ' (' . Auth::user()->role . ')';
            $data->stock = $datastock;
            $data->save();

            Alert::success('Sukses', 'Data Berhasil Diupdate');
            return $this->dataManagement();
        } else {
            Alert::warning('Gagal', 'Stock Tidak Cukup');
            return redirect()->route('data-Management');
        }
    }

    public function destroyProject($id)
    {
        $data = ProjectManagement::find($id);

        if (!$data) {
            Alert::warning('Gagal', 'Data Tidak Ditemukan');
        }
        $asal_warehouse = Warehouse::where('nama', $data->asal_warehouse)->first();
        $asal_warehouse->stock = $asal_warehouse->stock + $data->stock;
        // dd($asal_warehouse->stock);
        $asal_warehouse->save();
        $data->delete();
        // $user_role = 'admin';
        // $route = 'user-Management';
        Alert::success('Sukses', 'Data Berhasil Di Hapus');
        return $this->dataManagement();
    }

    public function kepalaProjectWorkorder()
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $data = DaftarPasien::get();
        return view('kepala-project.work_order', compact('nama', 'role', 'data'));
    }
    public function kepalaProjectAccepted($id)
    {
        $data = ProjectManagement::find($id);
        $data->status = 'Selesai';
        $data->save();
        return redirect()->route('workorder.keproj');
    }
    public function cetakLaporan(Request $request)
    {
        $tahun = $request->tahun ?? date('Y'); // Ambil tahun dari request, atau gunakan tahun saat ini jika tidak ada

        if ($request->bulan == 'all') {
            $data = ProjectManagement::whereYear('created_at', $tahun)->get();
            $bulan = 'Semua Bulan';
        } else {
            $bulan = $request->bulan ?? date('m'); // Ambil bulan dari request, atau gunakan bulan saat ini jika tidak ada
            $data = ProjectManagement::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        }

        $pdf = PDF::loadView('print.daftarLaporanProject', compact('data', 'bulan', 'tahun'));
        return $pdf->stream('laporan_history_' . $bulan . '_' . $tahun . '.pdf');
    }
    public function cetakLaporanPMB(Request $request)
    {
        $tahun = $request->tahun ?? date('Y'); // Ambil tahun dari request, atau gunakan tahun saat ini jika tidak ada

        if ($request->bulan == 'all') {
            $data = HistoryMasukStock::whereYear('created_at', $tahun)->get();
            $bulan = 'Semua Bulan';
        } else {
            $bulan = $request->bulan ?? date('m'); // Ambil bulan dari request, atau gunakan bulan saat ini jika tidak ada
            $data = HistoryMasukStock::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        }

        $pdf = PDF::loadView('print.laporan-penerimaan-barang', compact('data', 'bulan', 'tahun'));
        return $pdf->stream('laporan_history_PMB' . $bulan . '_' . $tahun . '.pdf');
    }

    public function updatePMB($id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $data = HistoryMasukStock::find($id);
        $warehouse = Warehouse::get();
        return view('edit-history-pmb', compact('user', 'role', 'nama', 'data', 'warehouse'));
    }
    public function updatedPMB(Request $request, $id)
    {
        $user = Auth::user();
        $nama = $user->nama;
        $role = $user->role;
        $data = HistoryMasukStock::find($id);
        $asal_warehouse = Warehouse::where('nama', $data->warehouse_name)->first();

        if (!$asal_warehouse) {
            Alert::warning('Gagal', 'Gudang Asal tidak ditemukan');
            return redirect()->route('data-Management');
        }

        $stock_lama = $data->stock;
        $datastock = $request->input('stock');

        $asal_warehouse->stock = $asal_warehouse->stock + $request->input('stock') - $stock_lama;
        $asal_warehouse->edited_by = Auth::user()->nama . ' (' . Auth::user()->role . ')';

        $asal_warehouse->save();

        // $data->edited_by = Auth::user()->nama . ' (' . Auth::user()->role . ')';
        $data->stock = $datastock;
        $data->warehouse_name = $request->input('warehouse_name');
        $data->tanggal_masuk = $request->input('tanggal_masuk');
        $data->save();

        Alert::success('Sukses', 'Data Berhasil Diupdate');

        return redirect()->route('history-edit.admin', ['id' => $id]);
    }

    public function destroyPMB($id)
    {
        $data = HistoryMasukStock::find($id);

        if (!$data) {
            Alert::warning('Gagal', 'Data Tidak Ditemukan');
        }
        $asal_warehouse = Warehouse::where('nama', $data->warehouse_name)->first();
        $asal_warehouse->stock = $asal_warehouse->stock - $data->stock;
        // dd($asal_warehouse->stock);
        $asal_warehouse->save();
        $data->delete();
        // $user_role = 'admin';
        // $route = 'user-Management';
        Alert::success('Sukses', 'Data Berhasil Di Hapus');
        return redirect()->route('history.admin');
    }

    public function cetakLP()
    {
        $data = ProjectManagement::get();
        $kepala = User::where('role', 'kepala_project')->get();
        $warehouse = Warehouse::get();
        $pdf = PDF::loadView('print.CetakLP', compact('data', 'kepala', 'warehouse'));
        return $pdf->stream('Laporan_History_Project.pdf', compact('data', 'kepala', 'warehouse'));
    }
}
