<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class StokController extends Controller
{
    public function index()
   {
       $stoks = Barang::all();
       return view('stok.index', compact('stoks'));
   }


   //Menampilkan form untuk membuat stok baru
   public function create()
   {
       return view('stok.create');
   }


   // Menyimpan data stok ke database
   public function store(Request $request)
   {
       $validated = $request->validate([
           'id_barang' => 'required|integer',
           'nama_barang' => 'required|string|max:255',
           'spesifikasi' => 'nullable|string|max:255',
           'lokasi' => 'nullable|string|max:255',
           'kondisi' => 'nullable|string|max:255',
           'jumlah_barang' => 'nullable|integer',
           'sumber_dana' => 'nullable|string|max:255',
       ]);


       Barang::create($validated);


       return redirect()->route('stok.index')->with('success', 'stok berhasil ditambahkan.');
   }


   // Menghapus data stok dari database
   public function destroy(Barang $stok)
   {
       $stok->delete();


       return redirect()->route('stok.index')->with('success', 'Data stok berhasil dihapus.');
   }


   // Show the edit form for a specific stok
   public function edit($id)
   {
       $stok = Barang::find($id);


       // Check if the stok exists
       if (!$stok) {
           return redirect()->route('stok.index')->with('error', 'stok not found.');
       }
       
       return view('stok.edit', compact('stok'));
   }


   public function update(Barang $stok, Request $request)
   {
       // Validasi data request jika diperlukan
       $validatedData = $request->validate([
           'nama_barang' => 'required|string|max:255',
           'spesifikasi' => 'nullable|string|max:255',
           'lokasi' => 'nullable|string|max:255',
           'kondisi' => 'nullable|string|max:255',
           'jumlah_barang' => 'nullable|integer',
           'sumber_dana' => 'nullable|string|max:255',
       ]);


       // Update data stok
       $stok->update($validatedData);


       return redirect()->route('stok.index')->with('success', 'stok data successfully updated.');
   }
}
