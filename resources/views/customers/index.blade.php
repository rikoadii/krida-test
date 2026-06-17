@extends('layouts.app')

@section('title', 'Daftar Customer')

@section('content')
    <section class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Daftar Customer</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola data pelanggan utama untuk operasi logistik.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <form action="{{ route('customers.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari customer..." class="w-full sm:w-64 rounded-md border border-slate-300 bg-white px-3 py-2 pl-9 text-sm text-slate-900 shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="absolute left-3 top-2.5 h-4 w-4 text-slate-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </form>

                <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center gap-2 rounded-md bg-[#0f4eb7] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Customer
                </a>
            </div>
        </div>

        <!-- Table Section -->
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-4">ID Customer</th>
                            <th scope="col" class="px-6 py-4">Nama Perusahaan</th>
                            <th scope="col" class="px-6 py-4">Alamat Lengkap</th>
                            <th scope="col" class="px-6 py-4">Kontak (HP)</th>
                            <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($customers as $customer)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                        CUST-{{ str_pad($customer->custId, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-900">
                                    {{ $customer->cust_nama }}
                                </td>
                                <td class="px-6 py-4 truncate max-w-xs text-slate-600">
                                    {{ $customer->cust_alamat ?: '-' }}
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $customer->cust_hp }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <button type="button" onclick="document.getElementById('modal-detail-{{ $customer->custId }}').classList.remove('hidden')" class="rounded-md border border-slate-200 px-3 py-1.5 text-xs font-medium hover:bg-slate-100 text-slate-700">Detail</button>
                                        <button type="button" onclick="document.getElementById('modal-edit-{{ $customer->custId }}').classList.remove('hidden')" class="rounded-md border border-slate-200 px-3 py-1.5 text-xs font-medium hover:bg-slate-100 text-slate-700">Edit</button>
                                        <button type="button" onclick="document.getElementById('modal-hapus-{{ $customer->custId }}').classList.remove('hidden')" class="rounded-md border border-red-200 px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-50">Hapus</button>
                                    </div>
                                    
                                    <!-- Modal Detail -->
                                    <div id="modal-detail-{{ $customer->custId }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                        <div class="flex min-h-screen items-center justify-center p-4 text-center">
                                            <div class="fixed inset-0 bg-slate-900/50 transition-opacity" onclick="this.parentElement.parentElement.classList.add('hidden')"></div>
                                            <div class="relative w-full max-w-md transform overflow-hidden rounded-xl bg-white text-left align-middle shadow-xl transition-all p-6">
                                                <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-4 border-b pb-2">Detail Customer</h3>
                                                <div class="space-y-3 text-sm text-slate-700">
                                                    <div class="grid grid-cols-3 gap-2">
                                                        <span class="font-medium text-slate-500">ID Customer</span>
                                                        <span class="col-span-2 font-semibold">CUST-{{ str_pad($customer->custId, 4, '0', STR_PAD_LEFT) }}</span>
                                                    </div>
                                                    <div class="grid grid-cols-3 gap-2">
                                                        <span class="font-medium text-slate-500">Nama Perusahaan</span>
                                                        <span class="col-span-2">{{ $customer->cust_nama }}</span>
                                                    </div>
                                                    <div class="grid grid-cols-3 gap-2">
                                                        <span class="font-medium text-slate-500">Alamat Lengkap</span>
                                                        <span class="col-span-2">{{ $customer->cust_alamat ?: '-' }}</span>
                                                    </div>
                                                    <div class="grid grid-cols-3 gap-2">
                                                        <span class="font-medium text-slate-500">Kontak (HP)</span>
                                                        <span class="col-span-2">{{ $customer->cust_hp }}</span>
                                                    </div>
                                                </div>
                                                <div class="mt-6 flex justify-end">
                                                    <button type="button" onclick="document.getElementById('modal-detail-{{ $customer->custId }}').classList.add('hidden')" class="rounded-md bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-200 focus:outline-none">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div id="modal-edit-{{ $customer->custId }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                        <div class="flex min-h-screen items-center justify-center p-4 text-center">
                                            <div class="fixed inset-0 bg-slate-900/50 transition-opacity" onclick="this.parentElement.parentElement.classList.add('hidden')"></div>
                                            <div class="relative w-full max-w-md transform overflow-hidden rounded-xl bg-white text-left align-middle shadow-xl transition-all p-6">
                                                <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-4 border-b pb-2">Edit Customer</h3>
                                                <form action="{{ route('customers.update', $customer) }}" method="POST" class="space-y-4">
                                                    @csrf
                                                    @method('PUT')
                                                    <div>
                                                        <label for="cust_nama-{{ $customer->custId }}" class="block text-sm font-medium text-slate-700 mb-1">Nama Perusahaan / Customer</label>
                                                        <input id="cust_nama-{{ $customer->custId }}" name="cust_nama" type="text" value="{{ old('cust_nama', $customer->cust_nama) }}" required maxlength="100" class="block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7]">
                                                    </div>
                                                    <div>
                                                        <label for="cust_hp-{{ $customer->custId }}" class="block text-sm font-medium text-slate-700 mb-1">Nomor HP</label>
                                                        <input id="cust_hp-{{ $customer->custId }}" name="cust_hp" type="text" value="{{ old('cust_hp', $customer->cust_hp) }}" required maxlength="20" class="block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7]">
                                                    </div>
                                                    <div>
                                                        <label for="cust_alamat-{{ $customer->custId }}" class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                                                        <textarea id="cust_alamat-{{ $customer->custId }}" name="cust_alamat" rows="3" class="block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7]">{{ old('cust_alamat', $customer->cust_alamat) }}</textarea>
                                                    </div>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <button type="button" onclick="document.getElementById('modal-edit-{{ $customer->custId }}').classList.add('hidden')" class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none">Batal</button>
                                                        <button type="submit" class="rounded-md bg-[#0f4eb7] px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none shadow-sm">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus -->
                                    <div id="modal-hapus-{{ $customer->custId }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                        <div class="flex min-h-screen items-center justify-center p-4 text-center">
                                            <div class="fixed inset-0 bg-slate-900/50 transition-opacity" onclick="this.parentElement.parentElement.classList.add('hidden')"></div>
                                            <div class="relative w-full max-w-sm transform overflow-hidden rounded-xl bg-white text-center align-middle shadow-xl transition-all p-6">
                                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 mb-4">
                                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg font-semibold leading-6 text-slate-900 mb-2">Hapus Customer</h3>
                                                <p class="text-sm text-slate-500 mb-6">Apakah Anda yakin ingin menghapus customer <strong>{{ $customer->cust_nama }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="flex justify-center gap-3">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="document.getElementById('modal-hapus-{{ $customer->custId }}').classList.add('hidden')" class="rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none">Batal</button>
                                                    <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none shadow-sm">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-300">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                                        </svg>
                                        <span>Belum ada data pelanggan.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($customers->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                {{ $customers->links() }}
            </div>
            @endif
        </div>
    </section>
@endsection
