<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usulan;

class UsulanController extends Controller
{
    public function index(Request $request)
    {
        $query = Usulan::query()
            ->with(['skpd', 'periode', 'status']);


        if ($request->has('tahun')) {
            $query->whereHas('periode', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }


        if ($request->has('status')) {
            $query->whereHas('status', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->status . '%');
            });
        }


        if ($request->has('skpd')) {
            $query->whereHas('skpd', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->skpd . '%');
            });
        }


        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('pengusul', 'like', '%' . $request->search . '%');
            });
        }

        $usulans = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $usulans
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'periode_id' => 'required|exists:periodes,id',
            'status_id' => 'required|exists:status_usulans,id',
            'skpd_id' => 'required|exists:skpds,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'gambar.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // multi file
        ]);


        $usulan = Usulan::findOrFail($id);


        $usulan->update([
            'periode_id' => $request->periode_id,
            'status_id' => $request->status_id,
            'skpd_id' => $request->skpd_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
        ]);


        if ($request->hasFile('gambar')) {
            $imagePaths = [];

            foreach ($request->file('gambar') as $image) {
                $path = $image->store('usulan_images', 'public');
                $imagePaths[] = $path;
            }


            $usulan->gambar = json_encode($imagePaths);
            $usulan->save();
        }

        return response()->json([
            'message' => 'Usulan berhasil diupdate',
            'data' => $usulan
        ]);
    }

    public function destroy($id)
    {
        $usulan = Usulan::findOrFail($id);
        $usulan->delete(); // soft delete

        return response()->json([
            'message' => 'Usulan berhasil dihapus (soft delete)',
            'data' => $usulan
        ]);
    }
}
