<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();

        return view('peminjaman.index', compact('peminjaman'));
    }

    // crud

    public function create()
    {
        return view('peminjaman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'book_id' => 'required|integer',
        ]);

        Peminjaman::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => Carbon::now(),
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman created successfully.');
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:peminjaman,name,' . $peminjaman->id,
        // ]);

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman updated successfully.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman deleted successfully.');
    }
}
