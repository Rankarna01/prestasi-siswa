<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategori,nama_kategori',
        ]);

        Kategori::create($request->all());
        return redirect()->back()->with('success', 'Kategori prestasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategori,nama_kategori,' . $id,
        ]);

        $kategori->update($request->all());
        return redirect()->back()->with('success', 'Kategori prestasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        // Nanti bisa ditambahkan validasi cek relasi ke tabel prestasi di sini
        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori prestasi berhasil dihapus!');
    }
}
