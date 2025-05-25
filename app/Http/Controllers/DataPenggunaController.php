<?php

namespace App\Http\Controllers;

use App\Models\DataPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPenggunaController extends Controller
{
    public function index()
    {
        $penggunas = DataPengguna::paginate(10);
        return view('data_master.pengguna.index', compact('penggunas'));
    }

    public function create()
    {
        return view('data_master.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:data_penggunas,email',
            'role' => 'required|in:1,2,3',
            'password' => 'required|string|confirmed',
        ]);

        $nama = ucwords(strtolower($request->nama));

        DataPengguna::create([
            'nama' => $nama,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('data-master.pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengguna = DataPengguna::findOrFail($id);
        return view('data_master.pengguna.show', compact('pengguna'));
    }

    public function edit(DataPengguna $pengguna)
    {
        return view('data_master.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, DataPengguna $pengguna)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:data_penggunas,email,' . $pengguna->id,
            'role' => 'required|in:1,2,3',
        ];

        // Jika password diisi, validasi password
        if ($request->filled('password')) {
            $rules['password'] = 'string|confirmed';
        }

        $validated = $request->validate($rules);

        $updateData = [
            'nama' => ucwords(strtolower($request->nama)),
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $pengguna->update($updateData);

        return redirect()->route('data-master.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(DataPengguna $pengguna)
    {
        $pengguna->delete();

        return redirect()->route('data-master.pengguna.index')
            ->with('success', 'Data pengguna berhasil dihapus.');
    }
}
