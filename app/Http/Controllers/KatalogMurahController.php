<?php

namespace App\Http\Controllers;

use App\Models\Murah;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
// use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManagerStatic;


class KatalogMurahController extends Controller
{
    public function index()
    {
        confirmDelete();
        $judulpage = "Katalog Murah";
        $satuans = Satuan::all();
        return view('katalogmurah', compact(
            'judulpage',
            'satuans',
        ));
    }

    public function getData(Request $request)
    {

        $murahs = Murah::all();

        if ($request->ajax()) {
            return datatables()->of($murahs)
                ->addIndexColumn()
                ->addColumn('actions', function ($murah) {
                    return view('actions.actionmurah', compact('murah'));
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
            'mimes' => 'Format file harus .webp, .jpg, .jpeg, .png',
        ];

        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'gambar_product' => 'nullable|mimes:webp,jpg,jpeg,png',
        ], $messages);

        if ($validator->fails()) {
            Alert::error('Gagal Menambahkan', 'Terjadi kesalahan Menambahkan Gambar Produk. Pastikan format dan ukuran file sesuai.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('gambar_product');

        if ($file != null) {
            // Dapatkan nama asli file
            $gambar_product = $file->getClientOriginalName();

            // Simpan file dengan nama asli
            $file->move('storage/GambarProduk', $gambar_product);
            // Path lengkap menuju file gambar yang akan diproses
            $imagePath = public_path('storage/GambarProduk/' . $gambar_product);

            // Gunakan Intervention/Image untuk membuka dan mengompres gambar
            $image = ImageManagerStatic::make($imagePath);

            // Kompres gambar sesuai kebutuhan
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Simpan gambar yang telah dikompres
            $image->save($imagePath);
        }
        // Buat objek Murah baru berdasarkan data yang diterima
        $murah = new Murah;
        $murah->nama_product = $request->nama_product;
        $murah->gambar_product = $request->gambar_product;
        $murah->harga_product = $request->harga_product;
        $murah->deskripsi_product = $request->deskripsi_product;
        $murah->stok_product = $request->stok_product;
        $murah->satuans_id = $request->satuans_id;

        if ($file != null) {
            $murah->gambar_product = $gambar_product;
        }

        // Simpan objek Murah ke dalam database
        $murah->save();
        Alert::success('Berhasil Menambahkan', 'Produk Berhasil Terinput.');

        // Redirect ke halaman yang sesuai setelah penyimpanan data
        return redirect()->route('murahs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $judulpage = 'Edit Produk';
        $satuans = Satuan::all();

        // ELOQUENT
        $murahs = Murah::find($id);

        return view('actions.editmurah', compact('judulpage', 'murahs', 'satuans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'mimes' => 'Format file harus .webp, .jpg, .jpeg, .png',
        ];

        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'gambar_product' => 'nullable|mimes:webp,jpg,jpeg,png',
        ], $messages);

        if ($validator->fails()) {
            Alert::error('Gagal Mengupdate', 'Terjadi kesalahan Mengupdate Gambar Produk. Pastikan format dan ukuran file sesuai.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $murah = Murah::findOrFail($id);

        // Simpan gambar lama dalam variabel
        $gambarLama = $murah->gambar_product;

        if ($request->hasFile('gambar_product')) {
            $file = $request->file('gambar_product');

            // Dapatkan nama asli file baru
            $gambarBaru = $file->getClientOriginalName();

            // Simpan file baru dengan nama asli
            $file->move('storage/GambarProduk', $gambarBaru);
            // Kompres gambar baru sebelum menyimpannya
            $imagePath = public_path('storage/GambarProduk/' . $gambarBaru);
            $image = ImageManagerStatic::make($imagePath);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save($imagePath);

            // Gantikan gambar lama dengan gambar baru
            $murah->gambar_product = $gambarBaru;

            // Hapus gambar lama jika ada gambar baru
            File::delete('storage/GambarProduk/' . $gambarLama);
        }

        // Update atribut lain sesuai dengan permintaan
        $murah->nama_product = $request->nama_product;
        $murah->harga_product = $request->harga_product;
        $murah->deskripsi_product = $request->deskripsi_product;
        $murah->stok_product = $request->stok_product;
        $murah->satuans_id = $request->satuans_id;

        // Simpan objek murah yang diperbarui ke dalam database
        $murah->save();

        // Hapus gambar lama jika ada gambar baru
        if (isset($gambarBaru)) {
            File::delete('storage/GambarProduk/' . $gambarLama);
        }

        Alert::success('Berhasil Memperbarui', 'Produk berhasil diperbarui.');

        // Redirect ke halaman yang sesuai setelah pembaruan data
        return redirect()->route('murahs.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ELOQUENT
        // ELOQUENT
        $murah = Murah::find($id);

        // Hapus file gambar dari penyimpanan lokal (storage)
        $gambarPath = 'storage/GambarProduk/' . $murah->gambar_product;
        if (file_exists($gambarPath)) {
            unlink($gambarPath); // Menghapus file gambar dari penyimpanan lokal
        }

        $murah->delete(); // Hapus data dari database
        Alert::success('Berhasil Terhapus', 'Produk Berhasil Terhapus.');

        return redirect()->route('murahs.index');
    }
}
