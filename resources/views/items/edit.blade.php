@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
    <section class="max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-950">Edit Item</h1>
            <p class="mt-1 text-sm text-slate-600">Perbarui data barang.</p>
        </div>

        <form action="{{ route('items.update', $item) }}" method="POST" class="space-y-5 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700">Deskripsi</label>
                <input id="deskripsi" name="deskripsi" type="text" value="{{ old('deskripsi', $item->deskripsi) }}" required maxlength="150" class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-slate-700">Harga</label>
                <input id="price" name="price" type="number" value="{{ old('price', $item->price) }}" required min="0" step="0.01" class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-md bg-slate-950 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Simpan</button>
                <a href="{{ route('items.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </section>
@endsection
