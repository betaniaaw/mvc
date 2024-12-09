<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinjamBarang;

class PinjamBarangController extends Controller
{
    public function index()
   {
       $pinjambarang = PinjamBarang::all();
       return view('pinjambarang.index', compact('pinjambarang'));
   }


   //Menampilkan form untuk membuat pinjambarang baru
   public function create()
   {
       return view('pinjambarang.create');
   }


   // Menyimpan data pinjambarang ke database
   public function store(Request $request)
   {
       $validated = $request->validate([
           'id_pinjam' => 'required|integer',
           'peminjam' => 'required|string|max:255',
           'tgl_pinjam' => 'nullable|integer',
           'id_barang' => 'required|integer',
           'nama_barang' => 'required|string|max:255',
           'jml_barang' => 'nullable|integer',
           'tgl_kembali' => 'nullable|integer',
           'kondisi' => 'nullable|string|max:255',
       ]);


       PinjamBarang::create($validated);


       return redirect()->route('pinjambarang.index')->with('success', 'pinjambarang berhasil ditambahkan.');
   }


   // Menghapus data pinjambarang dari database
   public function destroy(PinjamBarang $pinjambarang)
   {
       $pinjambarang->delete();


       return redirect()->route('pinjambarang.index')->with('success', 'Data pinjambarang berhasil dihapus.');
   }


   // Show the edit form for a specific pinjambarang
   public function edit($id)
   {
       $pinjambarang = pinjambarang::find($id);


       // Check if the pinjambarang exists
       if (!$pinjambarang) {
           return redirect()->route('pinjambarang.index')->with('error', 'pinjambarang not found.');
       }
       
       return view('pinjambarang.edit', compact('pinjambarang'));
   }


   public function update(pinjambarang $pinjambarang, Request $request)
   {
       // Validasi data request jika diperlukan
       $validatedData = $request->validate([
           'peminjam' => 'required|string|max:255',
           'tgl_pinjam' => 'nullable|integer',
           'id_barang' => 'required|integer',
           'nama_barang' => 'required|string|max:255',
           'jml_barang' => 'nullable|integer',
           'tgl_kembali' => 'nullable|integer',
           'kondisi' => 'nullable|string|max:255'
       ]);


       // Update data pinjambarang
       $pinjambarang->update($validatedData);


       return redirect()->route('pinjambarang.index')->with('success', 'pinjambarang data successfully updated.');
   }
}
