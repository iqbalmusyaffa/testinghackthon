<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;

class EventsController extends Controller
{
    public function index()
    {
        $events = Events::all();
        return response()->json($events);
    }

    public function show($id)
    {
        $event = Events::findOrFail($id);
        return response()->json($event);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul_events' => 'required',
            'nama_events' => 'required',
            'kategori_id' => 'required',
            'gambar_events' => 'required|image|max:2024|mimes:jpg,jpeg,png',
            'tanggal_events' => 'required',
            'deskripsi' => 'required',
            'lokasi_events' => 'required',
            'harga_events' => 'required',
            'author_events' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
        ]);

        $event = Events::create($validatedData);
        return response()->json($event, 201);
    }

    public function update(Request $request, $id)
    {
        $event = Events::findOrFail($id);
        $validatedData = $request->validate([
            'judul_events' => 'required',
            'nama_events' => 'required',
            'kategori_id' => 'required',
            'gambar_events' => 'required|image|max:2024|mimes:jpg,jpeg,png',
            'tanggal_events' => 'required',
            'deskripsi' => 'required',
            'lokasi_events' => 'required',
            'harga_events' => 'required',
            'author_events' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
        ]);

        $event->update($validatedData);
        return response()->json($event, 200);
    }

    public function destroy($id)
    {
        $event = Events::findOrFail($id);
        $event->delete();
        return response()->json(null, 204);
    }
}
