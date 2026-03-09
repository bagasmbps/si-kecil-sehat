<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnakController extends Controller
{
    public function index()
    {
        $anaks = Auth::user()->anaks()->latest()->get();
        return view('anak.index', compact('anaks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'umur' => 'required',
        ]);

        Anak::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
        ]);

        return redirect()->route('anak.index')
            ->with('success', 'Data anak berhasil ditambahkan');
    }

    public function edit(Anak $anak)
    {
        abort_if($anak->user_id !== Auth::id(), 403);
        return view('anak.edit', compact('anak'));
    }

    public function update(Request $request, Anak $anak)
    {
        abort_if($anak->user_id !== Auth::id(), 403);

        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'umur' => 'required',
        ]);

        $anak->update($request->all());

        return redirect()->route('anak.index')
            ->with('success', 'Data anak berhasil diperbarui');
    }

    public function destroy(Anak $anak)
    {
        abort_if($anak->user_id !== Auth::id(), 403);

        $anak->delete();

        return redirect()->route('anak.index')
            ->with('success', 'Data anak berhasil dihapus');
    }
}
