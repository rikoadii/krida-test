<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        $search = request('search');

        $query = Item::query()
            ->when($search, function ($q) use ($search) {
                $q->where('deskripsi', 'like', "%{$search}%");

                $searchInt = (int) preg_replace('/[^0-9]/', '', $search);
                if ($searchInt > 0) {
                    $q->orWhere('itemId', $searchInt);
                }
            });

        return view('items.index', [
            'items' => $query->orderByDesc('itemId')->paginate(10)->withQueryString(),
        ]);
    }

    public function create(): View
    {
        return view('items.create');
    }

    public function store(StoreItemRequest $request): RedirectResponse
    {
        Item::create($request->validated());

        return redirect()
            ->route('items.index')
            ->with('success', 'Item berhasil ditambahkan.');
    }

    public function show(Item $item): View
    {
        return view('items.show', [
            'item' => $item,
        ]);
    }

    public function edit(Item $item): View
    {
        return view('items.edit', [
            'item' => $item,
        ]);
    }

    public function update(UpdateItemRequest $request, Item $item): RedirectResponse
    {
        $item->update($request->validated());

        return redirect()
            ->route('items.index')
            ->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy(Item $item): RedirectResponse
    {
        if ($item->orderItems()->exists()) {
            return redirect()
                ->route('items.index')
                ->with('error', 'Item tidak dapat dihapus karena sudah digunakan pada order.');
        }

        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('success', 'Item berhasil dihapus.');
    }
}
