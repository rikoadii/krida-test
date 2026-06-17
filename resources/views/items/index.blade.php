@extends('layouts.app')

@section('title', 'Items')

@section('content')
    <section class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-950">Items</h1>
                <p class="mt-1 text-sm text-slate-600">Kelola data barang.</p>
            </div>
            <div class="flex items-center gap-3">
                <form action="{{ route('items.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari item..." class="w-full sm:w-64 rounded-md border border-slate-300 bg-white px-3 py-2 pl-9 text-sm text-slate-900 shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="absolute left-3 top-2.5 h-4 w-4 text-slate-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </form>
                <a href="{{ route('items.create') }}" class="inline-flex items-center justify-center rounded-md bg-slate-950 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800 shadow-sm">
                    Tambah Item
                </a>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-100 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3 text-right">Harga</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($items as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ str_pad($item->itemId, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">{{ $item->deskripsi }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format((float) $item->price, 2, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <button type="button" onclick="document.getElementById('modal-detail-{{ $item->itemId }}').classList.remove('hidden')" class="rounded-md border border-slate-200 px-3 py-1.5 text-xs font-medium hover:bg-slate-100">Detail</button>
                                        <button type="button" onclick="document.getElementById('modal-edit-{{ $item->itemId }}').classList.remove('hidden')" class="rounded-md border border-slate-200 px-3 py-1.5 text-xs font-medium hover:bg-slate-100">Edit</button>
                                        <button type="button" onclick="document.getElementById('modal-hapus-{{ $item->itemId }}').classList.remove('hidden')" class="rounded-md border border-red-200 px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-50">Hapus</button>
                                    </div>
                                    
                                    <!-- Modal Detail -->
                                    <div id="modal-detail-{{ $item->itemId }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                        <div class="flex min-h-screen items-center justify-center p-4 text-center">
                                            <div class="fixed inset-0 bg-slate-900/50 transition-opacity" onclick="this.parentElement.parentElement.classList.add('hidden')"></div>
                                            <div class="relative w-full max-w-md transform overflow-hidden rounded-xl bg-white text-left align-middle shadow-xl transition-all p-6">
                                                <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-4 border-b pb-2">Detail Item</h3>
                                                <div class="space-y-3 text-sm text-slate-700">
                                                    <div class="grid grid-cols-3 gap-2">
                                                        <span class="font-medium text-slate-500">ID Item</span>
                                                        <span class="col-span-2 font-semibold">ITEM-{{ str_pad($item->itemId, 3, '0', STR_PAD_LEFT) }}</span>
                                                    </div>
                                                    <div class="grid grid-cols-3 gap-2">
                                                        <span class="font-medium text-slate-500">Deskripsi</span>
                                                        <span class="col-span-2">{{ $item->deskripsi }}</span>
                                                    </div>
                                                    <div class="grid grid-cols-3 gap-2">
                                                        <span class="font-medium text-slate-500">Harga</span>
                                                        <span class="col-span-2">Rp {{ number_format($item->price, 2, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                                <div class="mt-6 flex justify-end">
                                                    <button type="button" onclick="document.getElementById('modal-detail-{{ $item->itemId }}').classList.add('hidden')" class="rounded-md bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-200 focus:outline-none">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div id="modal-edit-{{ $item->itemId }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                        <div class="flex min-h-screen items-center justify-center p-4 text-center">
                                            <div class="fixed inset-0 bg-slate-900/50 transition-opacity" onclick="this.parentElement.parentElement.classList.add('hidden')"></div>
                                            <div class="relative w-full max-w-md transform overflow-hidden rounded-xl bg-white text-left align-middle shadow-xl transition-all p-6">
                                                <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-4 border-b pb-2">Edit Item</h3>
                                                <form action="{{ route('items.update', $item) }}" method="POST" class="space-y-4">
                                                    @csrf
                                                    @method('PUT')
                                                    <div>
                                                        <label for="deskripsi-{{ $item->itemId }}" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
                                                        <input id="deskripsi-{{ $item->itemId }}" name="deskripsi" type="text" value="{{ old('deskripsi', $item->deskripsi) }}" required maxlength="150" class="block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7]">
                                                    </div>
                                                    <div>
                                                        <label for="price-{{ $item->itemId }}" class="block text-sm font-medium text-slate-700 mb-1">Harga</label>
                                                        <input id="price-{{ $item->itemId }}" name="price" type="number" value="{{ old('price', $item->price) }}" required min="0" step="1" class="block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7]">
                                                    </div>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <button type="button" onclick="document.getElementById('modal-edit-{{ $item->itemId }}').classList.add('hidden')" class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none">Batal</button>
                                                        <button type="submit" class="rounded-md bg-[#0f4eb7] px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none shadow-sm">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus -->
                                    <div id="modal-hapus-{{ $item->itemId }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                        <div class="flex min-h-screen items-center justify-center p-4 text-center">
                                            <div class="fixed inset-0 bg-slate-900/50 transition-opacity" onclick="this.parentElement.parentElement.classList.add('hidden')"></div>
                                            <div class="relative w-full max-w-sm transform overflow-hidden rounded-xl bg-white text-center align-middle shadow-xl transition-all p-6">
                                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 mb-4">
                                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-2">Hapus Item</h3>
                                                <p class="text-sm text-slate-500 mb-6">Apakah Anda yakin ingin menghapus item <strong>{{ $item->deskripsi }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                                                <form action="{{ route('items.destroy', $item) }}" method="POST" class="flex justify-center gap-3">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="document.getElementById('modal-hapus-{{ $item->itemId }}').classList.add('hidden')" class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none">Batal</button>
                                                    <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none shadow-sm">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-slate-500">Belum ada item.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $items->links() }}
        </div>
    </section>
@endsection
