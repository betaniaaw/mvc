<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar;

class BarangKeluarController extends Controller
{
    public function index()
   {
       $barangkeluars = BarangKeluar::all();
       return view('barangkeluar.index', compact('barangkeluars'));
   }


   //Menampilkan form untuk membuat barangKeluar baru
   public function create()
   {
       return view('barangkeluar.create');
   }


   // Menyimpan data barangKeluar ke database
   public function store(Request $request)
   {
       $validated = $request->validate([
           'id_barang' => 'required|integer',
           'nama_barang' => 'required|string|max:255',
           'tgl_keluar' => 'nullable|integer',
           'jml_keluar' => 'nullable|integer',
           'lokasi' => 'nullable|string|max:255',
           'penerima' => 'nullable|string|max:255',
       ]);


       BarangKeluar::create($validated);


       return redirect()->route('barangkeluar.index')->with('success', 'barangkeluar berhasil ditambahkan.');
   }


   // Menghapus data barangkeluar dari database
   public function destroy(barangkeluar $barangkeluar)
   {
       $barangkeluar->delete();


       return redirect()->route('barangkeluar.index')->with('success', 'Data barangkeluar berhasil dihapus.');
   }


   // Show the edit form for a specific barangkeluar
   public function edit($id)
   {
       $barangkeluar = barangkeluar::find($id);


       // Check if the barangkeluar exists
       if (!$barangkeluar) {
           return redirect()->route('barangkeluar.index')->with('error', 'barangkeluar not found.');
       }
       
       return view('barangkeluar.edit', compact('barangkeluar'));
   }


   public function update(barangkeluar $barangkeluar, Request $request)
   {
       // Validasi data request jika diperlukan
       $validatedData = $request->validate([
           'nama_barang' => 'nullable|string|max:255',
           'tgl_keluar' => 'nullable|integer',
           'jml_keluar' => 'nullable|integer',
           'lokasi' => 'nullable|string|max:255',
           'penerima' => 'nullable|string|max:255',
       ]);


       // Update data barangkeluar
       $barangkeluar->update($validatedData);


       return redirect()->route('barangkeluar.index')->with('success', 'barangkeluar data successfully updated.');
   }
}
