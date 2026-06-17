@extends('layouts.app')

@section('title', 'Sales Order #' . $order->orderNo)

@section('content')
    <div class="mb-6">
        <a href="{{ route('sales-orders.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Sales Order #{{ $order->orderNo }}</h1>
            </div>
            <div class="flex items-center gap-3 text-sm text-slate-500">
                <div class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    {{ \Carbon\Carbon::parse($order->orderDate)->format('d M Y') }}
                </div>
                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                    Dikonfirmasi
                </span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button class="inline-flex items-center justify-center gap-2 rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                </svg>
                Cetak Order
            </button>
            <a href="#" class="inline-flex items-center justify-center gap-2 rounded-md bg-[#0f4eb7] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Edit
            </a>
            <!-- Delete Button (Existing functionality preserved) -->
            <form action="{{ route('sales-orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Hapus order ini?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center justify-center rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-100 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Detail Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Informasi Pelanggan -->
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center gap-2 text-sm font-bold text-slate-500 uppercase tracking-wider mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
                Informasi Pelanggan
            </div>
            <div class="space-y-4">
                <div>
                    <span class="block text-xs text-slate-500 mb-1">Nama Perusahaan</span>
                    <strong class="text-slate-900 block">{{ $order->customer?->cust_nama ?? '-' }}</strong>
                </div>
                <div>
                    <span class="block text-xs text-slate-500 mb-1">Kontak Person</span>
                    <span class="text-slate-700 block">{{ $order->customer?->cust_hp ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Pengiriman -->
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center gap-2 text-sm font-bold text-slate-500 uppercase tracking-wider mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
                Pengiriman
            </div>
            <div class="space-y-4">
                <div>
                    <span class="block text-xs text-slate-500 mb-1">Alamat Tujuan</span>
                    <span class="text-slate-700 block">{{ $order->customer?->cust_alamat ?? '-' }}</span>
                </div>
                <div>
                    <span class="block text-xs text-slate-500 mb-1">Metode Pengiriman</span>
                    <span class="text-slate-700 block">Kurir Reguler (Mockup)</span>
                </div>
            </div>
        </div>

        <!-- Ketentuan & Referensi -->
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center gap-2 text-sm font-bold text-slate-500 uppercase tracking-wider mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Ketentuan & Referensi
            </div>
            <div class="space-y-4 grid grid-cols-2 gap-x-2">
                <div class="col-span-1 space-y-0">
                    <span class="block text-xs text-slate-500 mb-1">Termin Pembayaran</span>
                    <span class="text-slate-900 font-medium block">Net 30 Hari</span>
                </div>
                <div class="col-span-1 space-y-0 mt-0">
                    <span class="block text-xs text-slate-500 mb-1">Tgl Pengiriman</span>
                    <span class="text-slate-900 font-medium block">{{ \Carbon\Carbon::parse($order->orderDate)->addDays(4)->format('d M Y') }}</span>
                </div>
                <div class="col-span-2 mt-4">
                    <span class="block text-xs text-slate-500 mb-1">Referensi PO Pelanggan</span>
                    <span class="inline-block px-2 py-1 bg-slate-100 rounded font-mono text-xs text-slate-700 border border-slate-200">PO-MMS-10/23-001</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Barang Table -->
    <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-500">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <h2 class="text-lg font-bold text-slate-900">Daftar Barang</h2>
            </div>
            <span class="bg-slate-100 text-slate-600 text-xs font-semibold px-2.5 py-1 rounded-full border border-slate-200">{{ $order->orderItems->count() }} Item</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Deskripsi Barang</th>
                        <th class="px-6 py-4 text-right">Kuantitas</th>
                        <th class="px-6 py-4 text-right">Harga Satuan (Rp)</th>
                        <th class="px-6 py-4 text-right">Diskon (Rp)</th>
                        <th class="px-6 py-4 text-right">Total (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @foreach ($order->orderItems as $index => $orderItem)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-center text-slate-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $orderItem->item?->deskripsi ?? '-' }}</td>
                            <td class="px-6 py-4 text-right">{{ number_format((float) $orderItem->qty, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right">{{ number_format((float) $orderItem->price, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right @if($orderItem->discAmount > 0) text-red-500 font-medium @endif">
                                {{ $orderItem->discAmount > 0 ? number_format((float) $orderItem->discAmount, 2, ',', '.') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-900">{{ number_format((float) $orderItem->totalItem, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bottom Section: Notes & Summary -->
    <div class="flex flex-col lg:flex-row gap-6 items-start">
        
        <!-- Catatan Internal -->
        <div class="flex-1 w-full rounded-xl border border-slate-200 bg-slate-50 p-6 shadow-sm border-dashed">
            <div class="flex items-center gap-2 text-sm font-semibold text-slate-600 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
                Catatan Internal
            </div>
            <p class="text-sm text-slate-700">Pelanggan meminta pengiriman dilakukan sebelum jam 12 siang. Pastikan armada siap malam sebelumnya.</p>
        </div>

        <!-- Summary -->
        <div class="w-full lg:w-[400px] shrink-0 rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-600">Subtotal</span>
                    <span class="font-medium text-slate-900 font-mono">Rp {{ number_format((float) $order->subtotal, 2, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-red-500">Diskon Khusus</span>
                    <span class="font-medium text-red-500 font-mono">- Rp {{ number_format((float) $order->discAmount, 2, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-600">Biaya Pengiriman</span>
                    <span class="font-medium text-slate-900 font-mono">Rp 0,00</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-slate-600">PPN (11%)</span>
                    <span class="font-medium text-slate-900 font-mono">Rp {{ number_format((float) $order->ppn, 2, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="bg-blue-100/50 p-6 border-t border-blue-200 flex items-center justify-between">
                <span class="text-sm font-bold text-[#0f4eb7] uppercase tracking-widest">Total<br>Tagihan</span>
                <span class="text-3xl font-bold text-[#0f4eb7]">Rp {{ number_format((float) $order->grandtotal, 2, ',', '.') }}</span>
            </div>
        </div>

    </div>
@endsection
