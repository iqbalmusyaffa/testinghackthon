<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Kategori;
use App\Http\Requests\Kategori\StoreRequest;
use App\Http\Requests\Kategori\UpdateRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $kategoris = Kategori::orderBy('updated_at', 'desc')->get();
        return response()->view('kategoris.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response

    {
        return response()->view('kategoris.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $kategori = Kategori::create($validated);

        if ($kategori) {
            session()->flash('notif.success', 'Category created successfully!');
            return redirect()->route('kategoris.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        $kategori = Kategori::findOrFail($id);
        return response()->view('kategoris.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $kategori = Kategori::findOrFail($id);
        return response()->view('kategoris.form', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $kategori = Kategori::findOrFail($id);
        $validated = $request->validated();

        $update = $kategori->update($validated);

        if ($update) {
            session()->flash('notif.success', 'Category updated successfully!');
            return redirect()->route('kategoris.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $kategori = Kategori::findOrFail($id);

        $delete = $kategori->delete();

        if ($delete) {
            session()->flash('notif.success', 'Category deleted successfully!');
            return redirect()->route('kategoris.index');
        }

        return abort(500);
    }
}
