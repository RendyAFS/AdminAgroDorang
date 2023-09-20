<?php

namespace App\Http\Controllers;

use App\Models\Mahal;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KatalogMahalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $judulpage = "Katalog Mahal";
        $satuans = Satuan::all();
        return view('katalogmahal', compact(
            'judulpage',
            'satuans',
        ));
    }

    public function getData(Request $request)
    {

        $mahals = Mahal::all();

        if ($request->ajax()) {
            return datatables()->of($mahals)
                ->addIndexColumn()
                ->addColumn('actions', function ($mahal) {
                    return view('actions.actionmahal', compact('mahal'));
                })
                ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'mimes' => 'Format file :harus .jpg, .png, atau .jpeg'
        ];

        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'gambar_product' => 'required|mimes:jpg,png,jpeg',
        ], $messages);

        if ($validator->fails()) {
            Alert::error('Gagal Menambahkan', 'Terjadi kesalahan Menambahkan Gambar Produk Format Tidak sesuai.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('gambar_product');

        if ($file != null) {
            // Dapatkan nama asli file
            $gambar_product = $file->getClientOriginalName();

            // Simpan file dengan nama asli
            $file->storeAs('public/GambarProduk', $gambar_product);
        }
        // Buat objek Mahal baru berdasarkan data yang diterima
        $mahal = new Mahal;
        $mahal->nama_product = $request->nama_product;
        $mahal->gambar_product = $request->gambar_product;
        $mahal->harga_product = $request->harga_product;
        $mahal->deskripsi_product = $request->deskripsi_product;
        $mahal->stok_product = $request->stok_product;
        $mahal->satuans_id = $request->satuans_id;

        if ($file != null) {
            $mahal->gambar_product = $gambar_product;
        }

        // Simpan objek Mahal ke dalam database
        $mahal->save();
        Alert::success('Berhasil Menambahkan', 'Produk Berhasil Terinput.');


        // Redirect ke halaman yang sesuai setelah penyimpanan data
        return redirect()->route('mahals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $judulpage = 'Edit Produk';
        $satuans = Satuan::all();

        // ELOQUENT
        $mahals = Mahal::find($id);

        return view('actions.editmahal', compact('judulpage', 'mahals', 'satuans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'mimes' => 'Format file harus .jpg, .png, atau .jpeg'
        ];

        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'gambar_product' => 'nullable|mimes:jpg,png,jpeg',
        ], $messages);

        if ($validator->fails()) {
            Alert::error('Gagal Mengupdate', 'Terjadi kesalahan Mengupdate Gambar Produk Format Tidak sesuai.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mahal = Mahal::findOrFail($id);

        // Simpan gambar lama dalam variabel
        $gambarLama = $mahal->gambar_product;

        if ($request->hasFile('gambar_product')) {
            $file = $request->file('gambar_product');

            // Dapatkan nama asli file baru
            $gambarBaru = $file->getClientOriginalName();

            // Simpan file baru dengan nama asli
            $file->storeAs('public/GambarProduk', $gambarBaru);

            // Gantikan gambar lama dengan gambar baru
            $mahal->gambar_product = $gambarBaru;
        }

        // Update atribut lain sesuai dengan permintaan
        $mahal->nama_product = $request->nama_product;
        $mahal->harga_product = $request->harga_product;
        $mahal->deskripsi_product = $request->deskripsi_product;
        $mahal->stok_product = $request->stok_product;
        $mahal->satuans_id = $request->satuans_id;

        // Simpan objek Mahal yang diperbarui ke dalam database
        $mahal->save();

        // Hapus gambar lama jika ada gambar baru
        if (isset($gambarBaru)) {
            Storage::delete('public/GambarProduk/' . $gambarLama);
        }

        Alert::success('Berhasil Memperbarui', 'Produk berhasil diperbarui.');

        // Redirect ke halaman yang sesuai setelah pembaruan data
        return redirect()->route('mahals.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ELOQUENT
        $mahal = Mahal::find($id);

        // Hapus file gambar dari penyimpanan lokal (storage)
        $gambarPath = storage_path('app/public/GambarProduk/' . $mahal->gambar_product);
        if (file_exists($gambarPath)) {
            unlink($gambarPath); // Menghapus file gambar dari penyimpanan lokal
        }

        $mahal->delete(); // Hapus data dari database
        Alert::success('Berhasil Terhapus', 'Produk Berhasil Terhapus.');

        return redirect()->route('mahals.index');
    }
}
