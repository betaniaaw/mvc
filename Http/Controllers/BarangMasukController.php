<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;

class BarangMasukController extends Controller
{
    public function index()
   {
       $barangmasuks = BarangMasuk::all();
       return view('barangmasuk.index', compact('barangmasuks'));
   }


   //Menampilkan form untuk membuat barangmasuk baru
   public function create()
   {
       return view('barangmasuk.create');
   }


   // Menyimpan data barangmasuk ke database
   public function store(Request $request)
   {
       $validated = $request->validate([
           'id_barang' => 'required|integer',
           'nama_barang' => 'required|string|max:255',
           'tgl_masuk' => 'nullable|integer',
           'jml_masuk' => 'nullable|integer',
           'id_suplier' => 'nullable|integer',
       ]);


       BarangMasuk::create($validated);


       return redirect()->route('barangmasuk.index')->with('success', 'barangmasuk berhasil ditambahkan.');
   }


   // Menghapus data barangmasuk dari database
   public function destroy(barangmasuk $barangmasuk)
   {
       $barangmasuk->delete();


       return redirect()->route('barangmasuk.index')->with('success', 'Data barangmasuk berhasil dihapus.');
   }


   // Show the edit form for a specific BarangMasuk
   public function edit($id)
   {
       $barangmasuk = barangmasuk::find($id);


       // Check if the BarangMasuk exists
       if (!$barangmasuk) {
           return redirect()->route('barangmasuk.index')->with('error', 'barangmasuk not found.');
       }
       
       return view('barangmasuk.edit', compact('barangmasuk'));
   }


   public function update(barangmasuk $barangmasuk, Request $request)
   {
       // Validasi data request jika diperlukan
       $validatedData = $request->validate([
           'nama_barang' => 'nullable|string|max:255',
           'tgl_masuk' => 'nullable|integer',
           'jml_masuk' => 'nullable|integer',
           'id_suplier' => 'nullable|integer',
       ]);


       // Update data barangmasuk
       $barangmasuk->update($validatedData);


       return redirect()->route('barangmasuk.index')->with('success', 'barangmasuk data successfully updated.');
   }
}
