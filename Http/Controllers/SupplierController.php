<?php


namespace App\Http\Controllers;


use App\Models\Supplier;
use Illuminate\Http\Request;


class SupplierController extends Controller {
   //Menampilkan semua data suplier
   public function index()
   {
       $supliers = Supplier::all();
       return view('suplier.index', compact('supliers'));
   }


   //Menampilkan form untuk membuat suplier baru
   public function create()
   {
       return view('suplier.create');
   }


   // Menyimpan data supplier ke database
   public function store(Request $request)
   {
       $validated = $request->validate([
           'id_supplier' => 'nullable|integer',
           'nama_supplier' => 'nullable|string|max:255',
           'alamat_supplier' => 'nullable|string',
           'telepon_supplier' => 'nullable|string|max:15',
       ]);


       Supplier::create($validated);


       return redirect()->route('suplier.index')->with('success', 'supplier berhasil ditambahkan.');
   }


   // Menghapus data supplier dari database
   public function destroy(Supplier $suplier)
   {
       $suplier->delete();


       return redirect()->route('suplier.index')->with('success', 'Data supplier berhasil dihapus.');
   }


   // Show the edit form for a specific supplier
   public function edit($id)
   {
       $suplier = Supplier::find($id);


       // Check if the supplier exists
       if (!$suplier) {
           return redirect()->route('suplier.index')->with('error', 'supplier not found.');
       }
       
       return view('suplier.edit', compact('suplier'));
   }


   public function update(Supplier $suplier, Request $request)
   {
       // Validasi data request jika diperlukan
       $validatedData = $request->validate([
           'nama_supplier' => 'required|string|max:255',
           'alamat_supplier' => 'nullable|string',
           'telepon_supplier' => 'nullable|string|max:15',
       ]);


       // Update data suplier
       $suplier->update($validatedData);


       return redirect()->route('suplier.index')->with('success', 'supplier data successfully updated.');
   }
}