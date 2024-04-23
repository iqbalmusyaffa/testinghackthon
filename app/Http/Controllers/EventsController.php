<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Events;
use App\Models\Kategori;
use App\Http\Requests\Events\StoreRequest;
use App\Http\Requests\Events\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public function index(): Response
    {
        $events = Events::orderBy('updated_at', 'desc')->get();
        return response()->view('events.index', compact('events'));
    }

    public function create(): Response
    {
        $kategoris = Kategori::all();
        return response()->view('events.form', compact('kategoris'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('gambar_events')) {
            $filePath = Storage::disk('public')->put('images/events/gambar_events', $request->file('gambar_events'));
            $validated['gambar_events'] = $filePath;
        }

        $event = Events::create($validated);

        if ($event) {
            session()->flash('notif.success', 'Event created successfully!');
            return redirect()->route('events.index');
        }

        return abort(500);
    }

    public function show(string $id): Response
    {
        $event = Events::findOrFail($id);
        return response()->view('events.show', compact('event'));
    }

    public function edit(string $id): Response
    {
        $event = Events::findOrFail($id);
        $kategoris = Kategori::all();
        return response()->view('events.form', compact('event', 'kategoris'));
    }

    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $event = Events::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('gambar_events')) {
            $filePath = Storage::disk('public')->put('images/events/gambar_events', $request->file('gambar_events'));
            $validated['gambar_events'] = $filePath;
        }

        $update = $event->update($validated);

        if ($update) {
            session()->flash('notif.success', 'Event updated successfully!');
            return redirect()->route('events.index');
        }

        return abort(500);
    }

    public function destroy(string $id): RedirectResponse
    {
        $event = Events::findOrFail($id);

        $delete = $event->delete();

        if ($delete) {
            session()->flash('notif.success', 'Event deleted successfully!');
            return redirect()->route('events.index');
        }

        return abort(500);
    }

}
