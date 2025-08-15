<?php

namespace App\Http\Controllers;

use App\Models\Gambar_usulan;
use App\Models\Usulan;
use App\Models\UsulanImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarUsulanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'periode_id' => 'required|exists:periodes,id',
            'status_id'  => 'required|exists:status_usulans,id',
            'skpd_id'    => 'required|exists:skpds,id',
            'images'     => 'nullable|array',
            'images.*'   => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Simpan data utama usulan
        $usulan = Usulan::create([
            'nama'       => $request->nama,
            'deskripsi'  => $request->deskripsi,
            'periode_id' => $request->periode_id,
            'status_id'  => $request->status_id,
            'skpd_id'    => $request->skpd_id,
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('usulan_images', 'public');
                Gambar_usulan::create([
                    'usulan_id' => $usulan->id,
                    'path'      => $path
                ]);
            }
        }

        return response()->json([
            'message' => 'Usulan berhasil disimpan',
            'data'    => $usulan->load('images')
        ], 201);
    }
}
