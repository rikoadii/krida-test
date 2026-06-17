@extends('layouts.app')

@section('title', 'Sales Orders')

@section('content')
    <section class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-950">Sales Orders</h1>
                <p class="mt-1 text-sm text-slate-600">Daftar transaksi penjualan.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <form action="{{ route('sales-orders.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesanan..." class="w-full sm:w-64 rounded-md border border-slate-300 bg-white px-3 py-2 pl-9 text-sm text-slate-900 shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="absolute left-3 top-2.5 h-4 w-4 text-slate-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </form>
                <a href="{{ route('sales-orders.create') }}" class="inline-flex items-center justify-center rounded-md bg-slate-950 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800 shadow-sm">
                    Tambah Sales Order
                </a>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-100 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">No Order</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3 text-right">Item</th>
                            <th class="px-4 py-3 text-right">Grand Total</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 font-medium text-slate-950">{{ $order->orderId }}</td>
                                <td class="px-4 py-3">{{ $order->orderNo }}</td>
                                <td class="px-4 py-3">{{ $order->orderDate->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">{{ $order->customer?->cust_nama ?? '-' }}</td>
                                <td class="px-4 py-3 text-right">{{ $order->order_items_count }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format((float) $order->grandtotal, 2, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <button type="button" onclick="document.getElementById('modal-detail-{{ $order->orderId }}').classList.remove('hidden')" class="rounded-md border border-slate-200 px-3 py-1.5 text-xs font-medium hover:bg-slate-100 text-slate-700">Detail</button>
                                    </div>
                                    
                                    <!-- Modal Detail -->
                                    <div id="modal-detail-{{ $order->orderId }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                        <div class="flex min-h-screen items-center justify-center p-4 text-center">
                                            <div class="fixed inset-0 bg-slate-900/50 transition-opacity" onclick="this.parentElement.parentElement.classList.add('hidden')"></div>
                                            <div class="relative w-full max-w-4xl transform overflow-hidden rounded-xl bg-white text-left align-middle shadow-xl transition-all p-6">
                                                <div class="flex justify-between items-center mb-4 border-b pb-2">
                                                    <h3 class="text-lg font-semibold leading-6 text-slate-900">Detail Sales Order: {{ $order->orderNo }}</h3>
                                                    <button type="button" onclick="document.getElementById('modal-detail-{{ $order->orderId }}').classList.add('hidden')" class="text-slate-400 hover:text-slate-500">
                                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 text-sm">
                                                    <div>
                                                        <h4 class="font-semibold text-slate-900 mb-2">Informasi Order</h4>
                                                        <dl class="space-y-1 text-slate-600">
                                                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium">No. Order</dt><dd class="col-span-2">{{ $order->orderNo }}</dd></div>
                                                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium">Tanggal</dt><dd class="col-span-2">{{ $order->orderDate->format('d M Y') }}</dd></div>
                                                        </dl>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-slate-900 mb-2">Informasi Customer</h4>
                                                        <dl class="space-y-1 text-slate-600">
                                                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium">Nama</dt><dd class="col-span-2">{{ $order->customer?->cust_nama ?? '-' }}</dd></div>
                                                            <div class="grid grid-cols-3 gap-2"><dt class="font-medium">Telepon</dt><dd class="col-span-2">{{ $order->customer?->cust_hp ?? '-' }}</dd></div>
                                                        </dl>
                                                    </div>
                                                </div>

                                                <h4 class="font-semibold text-slate-900 mb-2 text-sm">Daftar Item</h4>
                                                <div class="overflow-x-auto rounded-lg border border-slate-200 mb-6">
                                                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                                                        <thead class="bg-slate-50 text-slate-600">
                                                            <tr>
                                                                <th class="px-4 py-2 text-left font-semibold">Item</th>
                                                                <th class="px-4 py-2 text-right font-semibold">Harga</th>
                                                                <th class="px-4 py-2 text-right font-semibold">Qty</th>
                                                                <th class="px-4 py-2 text-right font-semibold">Diskon</th>
                                                                <th class="px-4 py-2 text-right font-semibold">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-slate-200 bg-white text-slate-600">
                                                            @foreach ($order->orderItems as $item)
                                                            <tr>
                                                                <td class="px-4 py-2">{{ $item->item->deskripsi ?? 'Item Terhapus' }}</td>
                                                                <td class="px-4 py-2 text-right">{{ number_format($item->price, 2, ',', '.') }}</td>
                                                                <td class="px-4 py-2 text-right">{{ $item->qty }}</td>
                                                                <td class="px-4 py-2 text-right">{{ number_format($item->discAmount, 2, ',', '.') }}</td>
                                                                <td class="px-4 py-2 text-right">{{ number_format($item->totalItem, 2, ',', '.') }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot class="bg-slate-50 font-semibold text-slate-900">
                                                            <tr><td colspan="4" class="px-4 py-2 text-right border-t">Subtotal</td><td class="px-4 py-2 text-right border-t">{{ number_format($order->subtotal, 2, ',', '.') }}</td></tr>
                                                            <tr><td colspan="4" class="px-4 py-2 text-right">Diskon</td><td class="px-4 py-2 text-right text-red-600">-{{ number_format($order->discAmount, 2, ',', '.') }}</td></tr>
                                                            <tr><td colspan="4" class="px-4 py-2 text-right">DPP</td><td class="px-4 py-2 text-right">{{ number_format($order->dpp, 2, ',', '.') }}</td></tr>
                                                            <tr><td colspan="4" class="px-4 py-2 text-right">PPN (11%)</td><td class="px-4 py-2 text-right">{{ number_format($order->ppn, 2, ',', '.') }}</td></tr>
                                                            <tr><td colspan="4" class="px-4 py-2 text-right text-base border-t">Grand Total</td><td class="px-4 py-2 text-right text-base border-t">{{ number_format($order->grandtotal, 2, ',', '.') }}</td></tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                
                                                <div class="flex justify-end">
                                                    <button type="button" onclick="document.getElementById('modal-detail-{{ $order->orderId }}').classList.add('hidden')" class="rounded-md bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-200 focus:outline-none">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-slate-500">Belum ada Sales Order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $orders->links() }}
        </div>
    </section>
@endsection
