@extends('layouts.app')

@section('title', 'Dashboard Utama')

@section('content')
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Card 1 -->
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pesanan</h3>
                <div class="p-2 bg-blue-50 text-[#0f4eb7] rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-3xl font-bold text-slate-900">{{ number_format($totalOrders, 0, ',', '.') }}</span>
                <span class="text-sm font-medium text-emerald-600 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                      <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                    </svg>
                    +12% <span class="text-slate-500 font-normal ml-1">bulan ini</span>
                </span>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pendapatan</h3>
                <div class="p-2 bg-blue-50 text-[#0f4eb7] rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V5.25c0-.754-.726-1.294-1.453-1.096A60.864 60.864 0 0015 3.75m-7.5 15a60.07 60.07 0 01-7.5-1.5m7.5 15v-15m0 0a59.98 59.98 0 00-7.5-1.5m7.5 15v-15m0 0a59.98 59.98 0 00-7.5-1.5" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-3xl font-bold text-slate-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                <span class="text-sm font-medium text-emerald-600 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                      <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                    </svg>
                    +8.5% <span class="text-slate-500 font-normal ml-1">bulan ini</span>
                </span>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pelanggan</h3>
                <div class="p-2 bg-blue-50 text-[#0f4eb7] rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-3xl font-bold text-slate-900">{{ number_format($totalCustomers, 0, ',', '.') }}</span>
                <span class="text-sm font-medium text-emerald-600 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                      <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                    </svg>
                    +24 <span class="text-slate-500 font-normal ml-1">pelanggan baru</span>
                </span>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Item Aktif</h3>
                <div class="p-2 bg-blue-50 text-[#0f4eb7] rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-3xl font-bold text-slate-900">{{ number_format($activeItems, 0, ',', '.') }}</span>
                <span class="text-sm font-medium text-slate-500 flex items-center gap-1">
                    <div class="w-4 h-0.5 bg-slate-400"></div>
                    Stabil
                </span>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="rounded-xl border border-slate-200 bg-white overflow-hidden shadow-sm">
        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-900">Pesanan Penjualan Terbaru</h3>
            <a href="{{ route('sales-orders.index') }}" class="text-sm font-medium text-[#0f4eb7] hover:text-blue-800 flex items-center gap-1">
                Lihat Semua
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-500">
                    <tr>
                        <th scope="col" class="px-6 py-4">No Pesanan</th>
                        <th scope="col" class="px-6 py-4">Tanggal</th>
                        <th scope="col" class="px-6 py-4">Nama Pelanggan</th>
                        <th scope="col" class="px-6 py-4 text-right">Total Akhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($recentOrders as $order)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-[#0f4eb7]">{{ $order->orderNo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->orderDate->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-900">{{ $order->customer?->cust_nama ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right font-medium">Rp {{ number_format($order->grandtotal, 2, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-slate-500">Belum ada pesanan terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
