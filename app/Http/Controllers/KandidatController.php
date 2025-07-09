<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Storage;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'foto' => 'required|image|mimes:jpeg,png,jpg',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'jabatan_terpilih' => 'nullable|string|max:255',
            ]);

            // Handle file upload and store the candidate data
            $path = $request->file('foto')->store('kandidat', 'public');
            $kandidat = new Kandidat();
            $kandidat->nama = $request->input('nama');
            $kandidat->jenis_kelamin = $request->input('jenis_kelamin');
            $kandidat->foto = $path;
            $kandidat->jabatan_terpilih = $request->input('jabatan_terpilih');
            $kandidat->save();
            return redirect()->back()->with('success', 'Kandidat baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan kandidat. Silakan coba lagi.');
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'jabatan_terpilih' => 'nullable|string|max:255',
            ]);

            // Find the candidate by ID
            $kandidat = Kandidat::findOrFail($id);

            // Update candidate data
            $kandidat->nama = $request->input('nama');
            $kandidat->jenis_kelamin = $request->input('jenis_kelamin');
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($kandidat->foto) {
                    Storage::disk('public')->delete($kandidat->foto);
                }
                // Store new photo
                $kandidat->foto = $request->file('foto')->store('kandidat', 'public');
            }
            $kandidat->jabatan_terpilih = $request->input('jabatan_terpilih');
            $kandidat->save();

            return redirect()->back()->with('success', 'Data kandidat berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data kandidat. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kandidat = Kandidat::findOrFail($id);
            $nama = $kandidat->nama;

            // Delete photo file if exists
            if ($kandidat->foto && Storage::disk('public')->exists($kandidat->foto)) {
                Storage::disk('public')->delete($kandidat->foto);
            }

            $kandidat->delete();

            return redirect()->back()->with('success', "Kandidat {$nama} berhasil dihapus!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kandidat. Silakan coba lagi.');
        }
    }
}
