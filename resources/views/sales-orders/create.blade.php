@extends('layouts.app')

@section('title', 'Buat Sales Order Baru')

@section('content')
    <div class="mb-6">
        <a href="{{ route('sales-orders.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Daftar Pesanan
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Buat Sales Order Baru</h1>
        <p class="mt-1 text-sm text-slate-500">Masukkan rincian pesanan pelanggan dan item terkait.</p>
    </div>

    <form action="{{ route('sales-orders.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Informasi Umum -->
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-5">Informasi Umum</h2>
            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label for="orderNo" class="block text-xs font-semibold text-slate-700 mb-1">Nomor Order</label>
                    <input id="orderNo" name="orderNo" type="text" value="(Otomatis)" readonly class="block w-full rounded-md border border-slate-200 bg-slate-100 px-3 py-2 text-sm shadow-sm text-slate-500 cursor-not-allowed focus:outline-none">
                </div>
                <div>
                    <label for="orderDate" class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Order</label>
                    <input id="orderDate" name="orderDate" type="date" value="{{ old('orderDate', now()->toDateString()) }}" required class="block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7] transition-colors">
                </div>
                <div>
                    <label for="custId" class="block text-xs font-semibold text-slate-700 mb-1">Pelanggan</label>
                    <select id="custId" name="custId" required class="block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7] transition-colors appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2364748B%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-position: right 0.7rem top 50%; background-size: 0.65rem auto;">
                        <option value="">Pilih Pelanggan...</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->custId }}" @selected((string) old('custId') === (string) $customer->custId)>
                                {{ $customer->cust_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Rincian Item -->
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-200">
                <h2 class="text-lg font-bold text-slate-900">Rincian Item</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs font-semibold text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3 w-36">Item ID</th>
                            <th class="px-4 py-3 min-w-[200px]">Item</th>
                            <th class="px-4 py-3 w-28">Qty</th>
                            <th class="px-4 py-3 w-36">Harga Satuan</th>
                            <th class="px-4 py-3 w-28">Diskon (%)</th>
                            <th class="px-4 py-3 w-36">Cash Disc</th>
                            <th class="px-4 py-3 w-32 text-right">Total Item</th>
                            <th class="w-12 px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white" id="item-table-body">
                        @for ($index = 0; $index < max(3, count(old('items', []))); $index++)
                            <tr class="hover:bg-slate-50 group item-row">
                                <td class="px-4 py-3">
                                    <select class="block w-full rounded-md border border-slate-300 px-3 py-1.5 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7] appearance-none calc-select item-id-select">
                                        <option value="" data-price="0">Pilih ID</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->itemId }}" data-price="{{ $item->price }}" @selected((string) old("items.{$index}.itemId") === (string) $item->itemId)>
                                                ITEM-{{ str_pad($item->itemId, 3, '0', STR_PAD_LEFT) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-3">
                                    <select name="items[{{ $index }}][itemId]" class="block w-full rounded-md border border-slate-300 px-3 py-1.5 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7] appearance-none calc-select item-select">
                                        <option value="" data-price="0">Pilih item</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->itemId }}" data-price="{{ $item->price }}" @selected((string) old("items.{$index}.itemId") === (string) $item->itemId)>
                                                {{ $item->deskripsi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-3">
                                    <input name="items[{{ $index }}][qty]" type="number" value="{{ old("items.{$index}.qty") }}" min="1" step="1" class="calc-input block w-full rounded-md border border-slate-300 px-3 py-1.5 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7] text-center item-qty" placeholder="1">
                                </td>
                                <td class="px-4 py-3">
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                          <span class="text-slate-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input name="items[{{ $index }}][price]" type="number" value="{{ old("items.{$index}.price") }}" min="0" step="1" class="calc-input block w-full rounded-md border border-slate-300 pl-8 pr-3 py-1.5 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7] text-right item-price" placeholder="0">
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="relative">
                                        <input type="number" min="0" max="100" step="1" class="calc-input calc-pct block w-full rounded-md border border-slate-300 pr-8 pl-3 py-1.5 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7] text-right item-disc-pct" placeholder="0">
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                          <span class="text-slate-500 sm:text-sm">%</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <input name="items[{{ $index }}][discAmount]" type="number" value="{{ old("items.{$index}.discAmount", '0') }}" min="0" step="1" class="calc-input calc-amt block w-full rounded-md border border-slate-300 px-3 py-1.5 text-sm shadow-sm focus:border-[#0f4eb7] focus:outline-none focus:ring-1 focus:ring-[#0f4eb7] text-right item-disc">
                                </td>
                                <td class="px-4 py-3 text-right font-medium text-slate-900 whitespace-nowrap">
                                    Rp <span class="item-total-text">0</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button type="button" class="text-slate-400 hover:text-red-500 transition-colors delete-row-btn" title="Hapus Baris">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-auto">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-slate-200">
                <button type="button" class="inline-flex items-center gap-2 rounded-md border border-[#0f4eb7] px-4 py-1.5 text-sm font-medium text-[#0f4eb7] hover:bg-blue-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Baris
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 items-start justify-end">            <!-- Ringkasan Transaksi -->
            <div class="w-full lg:w-[400px] shrink-0 rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-200">
                    <h2 class="text-lg font-bold text-slate-900">Ringkasan Transaksi</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-600">Subtotal Kotor</span>
                        <span class="font-medium text-slate-900">Rp <span id="summary-subtotal">0</span></span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-red-500">Total Diskon</span>
                        <span class="font-medium text-red-500">- Rp <span id="summary-item-discount">0</span></span>
                    </div>
                    
                    <hr class="border-slate-200 my-4 border-dashed">
                    
                    <div class="flex items-center justify-between text-sm">
                        <span class="font-semibold text-slate-900">Netto</span>
                        <span class="font-semibold text-slate-900">Rp <span id="summary-netto">0</span></span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="font-semibold text-slate-900">DPP</span>
                        <span class="font-semibold text-slate-900">Rp <span id="summary-dpp">0</span></span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-600">PPN (11%)</span>
                        <span class="text-slate-600">Rp <span id="summary-ppn">0</span></span>
                    </div>
                </div>
                
                <div class="bg-blue-50/50 p-6 border-t border-slate-200 rounded-b-xl">
                    <div class="flex items-end justify-between mb-6">
                        <span class="text-base font-bold text-slate-900">Total<br>Tagihan</span>
                        <span class="text-3xl font-bold text-[#0f4eb7]">Rp <span id="summary-grandtotal">0</span></span>
                    </div>
                    <button type="submit" class="w-full rounded-md bg-[#0f4eb7] px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 transition-colors mb-3">
                        Simpan Order
                    </button>
                    <a href="{{ route('sales-orders.index') }}" class="block w-full text-center text-sm font-medium text-[#0f4eb7] hover:text-blue-800">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableBody = document.getElementById('item-table-body');
            const discOrderInput = document.getElementById('discAmount');
            
            const formatCurrency = (number) => {
                return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 2 }).format(number);
            };

            const calculateTotals = () => {
                let grossSubtotal = 0;
                let totalItemDiscounts = 0;
                
                // Calculate each row
                const rows = document.querySelectorAll('.item-row');
                rows.forEach(row => {
                    const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
                    const price = parseFloat(row.querySelector('.item-price').value) || 0;
                    const discAmtInput = row.querySelector('.item-disc');
                    const discPctInput = row.querySelector('.item-disc-pct');
                    
                    let discAmount = parseFloat(discAmtInput.value) || 0;
                    
                    // calculate back the percentage for display if amt exists but pct is empty
                    if(discAmtInput.value !== '' && discPctInput.value === '' && (qty * price) > 0) {
                         const pct = (discAmount / (qty * price)) * 100;
                         discPctInput.value = parseFloat(pct.toFixed(2));
                    }

                    const grossTotal = qty * price;
                    const totalItem = grossTotal - discAmount;
                    const finalTotalItem = totalItem > 0 ? totalItem : 0;
                    
                    row.querySelector('.item-total-text').textContent = formatCurrency(finalTotalItem);
                    grossSubtotal += grossTotal;
                    totalItemDiscounts += discAmount;
                });
                
                // Calculate Order Summary
                const totalDiscount = totalItemDiscounts;
                
                const netto = Math.max(0, grossSubtotal - totalDiscount);
                const dpp = netto / 1.11;
                const ppn = dpp * 0.11;
                const grandtotal = netto;

                document.getElementById('summary-subtotal').textContent = formatCurrency(grossSubtotal);
                document.getElementById('summary-item-discount').textContent = formatCurrency(totalItemDiscounts);
                document.getElementById('summary-netto').textContent = formatCurrency(netto);
                document.getElementById('summary-dpp').textContent = formatCurrency(dpp);
                document.getElementById('summary-ppn').textContent = formatCurrency(ppn);
                document.getElementById('summary-grandtotal').textContent = formatCurrency(grandtotal);
            };

            // Event listener for item selection (auto-fill price)
            tableBody.addEventListener('change', function(e) {
                if (e.target.classList.contains('calc-select')) {
                    const selectedOption = e.target.options[e.target.selectedIndex];
                    const price = selectedOption.getAttribute('data-price') || 0;
                    
                    const row = e.target.closest('.item-row');
                    const priceInput = row.querySelector('.item-price');
                    const qtyInput = row.querySelector('.item-qty');
                    
                    priceInput.value = price;
                    if(!qtyInput.value || parseFloat(qtyInput.value) === 0) {
                        qtyInput.value = 1;
                    }
                    
                    // re-trigger disc pct calculation if exists
                    const discPctInput = row.querySelector('.item-disc-pct');
                    if (discPctInput.value !== '') {
                        discPctInput.dispatchEvent(new Event('input', { bubbles: true }));
                    } else {
                        calculateTotals();
                    }
                }
            });

            // Event listener for manual input changes
            tableBody.addEventListener('input', function(e) {
                if (e.target.classList.contains('calc-input')) {
                    const row = e.target.closest('.item-row');
                    const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
                    const price = parseFloat(row.querySelector('.item-price').value) || 0;
                    const grossTotal = qty * price;

                    // If user changed the percentage field
                    if (e.target.classList.contains('calc-pct')) {
                        let pct = parseFloat(e.target.value) || 0;
                        if (pct > 100) { pct = 100; e.target.value = 100; }
                        if (pct < 0) { pct = 0; e.target.value = 0; }
                        
                        const amt = grossTotal * (pct / 100);
                        row.querySelector('.item-disc').value = parseFloat(amt.toFixed(2));
                    } 
                    // If user changed the amount field or qty/price directly
                    else if (e.target.classList.contains('calc-amt') || e.target.classList.contains('item-qty') || e.target.classList.contains('item-price')) {
                        const amt = parseFloat(row.querySelector('.item-disc').value) || 0;
                        if (grossTotal > 0 && e.target.classList.contains('calc-amt')) {
                            const pct = (amt / grossTotal) * 100;
                            row.querySelector('.item-disc-pct').value = parseFloat(pct.toFixed(2));
                        } else if (grossTotal > 0 && row.querySelector('.item-disc-pct').value !== '') {
                            // If user changed qty/price and pct is filled, recalculate amt based on pct
                             let pct = parseFloat(row.querySelector('.item-disc-pct').value) || 0;
                             const newAmt = grossTotal * (pct / 100);
                             row.querySelector('.item-disc').value = parseFloat(newAmt.toFixed(2));
                        }
                    }

                    calculateTotals();
                }
            });



            // Event listener for delete button
            tableBody.addEventListener('click', function(e) {
                const btn = e.target.closest('.delete-row-btn');
                if (btn) {
                    const row = btn.closest('.item-row');
                    const rows = document.querySelectorAll('.item-row');
                    if (rows.length > 1) {
                        const selects = row.querySelectorAll('select');
                        selects.forEach(s => {
                            if(s.tomselect) s.tomselect.destroy();
                        });
                        row.remove();
                        calculateTotals();
                    } else {
                        alert('Minimal harus ada 1 item pada pesanan.');
                    }
                }
            });

            // Initialize TomSelect for Customer
            if(document.getElementById('custId')) {
                new TomSelect('#custId', {
                    create: false,
                    placeholder: 'Pilih Pelanggan...'
                });
            }

            // Initialize TomSelect for Items and Item IDs
            document.querySelectorAll('.item-row').forEach(function(row) {
                const idSelect = row.querySelector('.item-id-select');
                const descSelect = row.querySelector('.item-select');
                
                let idTs, descTs;

                if (idSelect) {
                    idTs = new TomSelect(idSelect, {
                        create: false,
                        placeholder: 'Pilih ID...',
                        onChange: function(value) {
                            if(descTs && descTs.getValue() !== value) {
                                descTs.setValue(value);
                            }
                            idSelect.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    });
                }

                if (descSelect) {
                    descTs = new TomSelect(descSelect, {
                        create: false,
                        placeholder: 'Pilih item...',
                        onChange: function(value) {
                            if(idTs && idTs.getValue() !== value) {
                                idTs.setValue(value);
                            }
                            descSelect.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    });
                }
            });

            // Initial calculation
            calculateTotals();
        });
    </script>
@endsection
