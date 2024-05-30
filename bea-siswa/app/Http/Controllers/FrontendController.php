<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('layouts.main');
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nomor_telpon' => 'required|string',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'nama_orang_tua' => 'required|string',
            'umur' => 'required|integer',
            'foto_pelamar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'paket_beasiswa' => 'required|string',
            'dokumen' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        try {
            // Simpan data ke database
            $beasiswa = new Beasiswa();
            $beasiswa->nama = $request->input('nama');
            $beasiswa->nomor_telpon = $request->input('nomor_telpon');
            $beasiswa->email = $request->input('email');
            $beasiswa->alamat = $request->input('alamat');
            $beasiswa->nama_orang_tua = $request->input('nama_orang_tua');
            $beasiswa->umur = $request->input('umur');
            $beasiswa->paket_beasiswa = $request->input('paket_beasiswa');
            $beasiswa->save();

            // Simpan file foto pelamar
            if ($request->hasFile('foto_pelamar')) {
                $beasiswa->addMedia($request->file('foto_pelamar'))->toMediaCollection('foto_pelamar');
            }

            // Simpan file dokumen
            if ($request->hasFile('dokumen')) {
                $beasiswa->addMedia($request->file('dokumen'))->toMediaCollection('dokumen');
            }

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran beasiswa berhasil!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data!'
            ]);
        }
    }
}
