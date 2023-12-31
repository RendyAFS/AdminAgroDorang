<?php

namespace App\Http\Controllers;

use App\Models\Mahal;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;

class KatalogMahalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete();
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
        // Cek apakah ada file yang diunggah
        if ($request->hasFile('gambar_product')) {
            $file = $request->file('gambar_product');
            $messages = [
                'mimes' => 'Format file harus .webp, .jpg, .jpeg, .png',
            ];

            // Validasi tipe file yang diunggah
            $validator = Validator::make(['gambar_product' => $file], [
                'gambar_product' => 'mimes:webp,jpg,jpeg,png',
            ], $messages);

            if ($validator->fails()) {
                Alert::error('Gagal Menambahkan', 'Terjadi kesalahan Menambahkan Gambar Produk. Pastikan format dan ukuran file sesuai.');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Dapatkan nama asli file
            $gambar_product = $file->getClientOriginalName();

            // Simpan file dengan nama asli
            $file->move('storage/GambarProduk', $gambar_product);
            // Path lengkap menuju file gambar yang akan diproses
            $imagePath = ('storage/GambarProduk/' . $gambar_product);

            // Gunakan Intervention/Image untuk membuka dan mengompres gambar
            $image = Image::make($imagePath);

            // Kompres gambar sesuai kebutuhan
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Simpan gambar yang telah dikompres
            $image->save($imagePath);
        }

        // Buat objek Mahal baru berdasarkan data yang diterima
        $mahal = new Mahal;
        $mahal->nama_product = $request->nama_product;

        // Gunakan $gambar_product yang diunggah jika ada, atau gunakan $request->gambar_product jika tidak ada file yang diunggah
        $mahal->gambar_product = isset($gambar_product) ? $gambar_product : $request->gambar_product;

        $mahal->harga_product = $request->harga_product;
        $mahal->deskripsi_product = $request->deskripsi_product;
        $mahal->stok_product = $request->stok_product;
        $mahal->satuans_id = $request->satuans_id;

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

        $mahal = Mahal::findOrFail($id);

        // Simpan gambar lama dalam variabel
        $gambarLama = $mahal->gambar_product;

        if ($request->hasFile('gambar_product')) {
            $file = $request->file('gambar_product');

            // Dapatkan nama asli file baru
            $gambarBaru = $file->getClientOriginalName();

            // Simpan file baru dengan nama asli
            $file->move('storage/GambarProduk', $gambarBaru);

            // Kompres gambar baru sebelum menyimpannya
            $imagePath = ('storage/GambarProduk/' . $gambarBaru);
            $image = Image::make($imagePath);
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save($imagePath);

            // Gantikan gambar lama dengan gambar baru
            $mahal->gambar_product = $gambarBaru;

            // Hapus gambar lama jika ada gambar baru
            File::delete('storage/GambarProduk/' . $gambarLama);
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
            File::delete('storage/GambarProduk/' . $gambarLama);
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
        $gambarPath = 'storage/GambarProduk/' . $mahal->gambar_product;
        if (file_exists($gambarPath)) {
            unlink($gambarPath); // Menghapus file gambar dari penyimpanan lokal
        }

        $mahal->delete(); // Hapus data dari database
        Alert::success('Berhasil Terhapus', 'Produk Berhasil Terhapus.');

        return redirect()->route('mahals.index');
    }
}
