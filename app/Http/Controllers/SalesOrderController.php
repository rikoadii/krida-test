<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalesOrderRequest;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SalesOrderController extends Controller
{
    public function index(): View
    {
        $search = request('search');

        $query = Order::query()
            ->with(['customer', 'orderItems.item'])
            ->withCount('orderItems')
            ->when($search, function ($q) use ($search) {
                $q->where('orderNo', 'like', "%{$search}%")
                  ->orWhere('orderDate', 'like', "%{$search}%")
                  ->orWhereHas('customer', function ($q2) use ($search) {
                      $q2->where('cust_nama', 'like', "%{$search}%");
                  });
            });

        return view('sales-orders.index', [
            'orders' => $query->orderByDesc('orderId')->paginate(10)->withQueryString(),
        ]);
    }

    public function create(): View
    {
        return view('sales-orders.create', [
            'customers' => Customer::query()->orderBy('cust_nama')->get(),
            'items' => Item::query()->orderBy('deskripsi')->get(),
        ]);
    }

    public function store(StoreSalesOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated): Order {
            $details = collect($validated['items'])->map(function (array $item): array {
                $qty = (float) $item['qty'];
                $price = (float) $item['price'];
                $discAmount = (float) ($item['discAmount'] ?? 0);

                return [
                    'itemId' => (int) $item['itemId'],
                    'qty' => $qty,
                    'price' => $price,
                    'discAmount' => $discAmount,
                    'totalItem' => round(($qty * $price) - $discAmount, 2),
                ];
            });

            $subtotal = round((float) $details->sum('totalItem'), 2);
            $discAmount = round((float) ($validated['discAmount'] ?? 0), 2);
            $netto = round($subtotal - $discAmount, 2);
            $dpp = round($netto / 1.11, 2);
            $ppn = round($dpp * 0.11, 2);

            $date = Carbon::parse($validated['orderDate']);
            $latestOrder = Order::whereMonth('orderDate', $date->month)
                                ->whereYear('orderDate', $date->year)
                                ->orderBy('orderId', 'desc')
                                ->first();
            $count = $latestOrder ? (int) substr($latestOrder->orderNo, -4) + 1 : 1;
            $orderNo = 'SO-' . $date->format('Ym') . '-' . str_pad((string)$count, 4, '0', STR_PAD_LEFT);

            $order = Order::create([
                'orderNo' => $orderNo,
                'orderDate' => $validated['orderDate'],
                'custId' => (int) $validated['custId'],
                'subtotal' => $subtotal,
                'discAmount' => $discAmount,
                'netto' => $netto,
                'dpp' => $dpp,
                'ppn' => $ppn,
                'grandtotal' => $netto,
            ]);

            $order->orderItems()->createMany($details->all());

            return $order;
        });

        return redirect()
            ->route('sales-orders.show', $order)
            ->with('success', 'Sales Order berhasil disimpan.');
    }

    public function show(Order $order): View
    {
        return view('sales-orders.show', [
            'order' => $order->load(['customer', 'orderItems.item']),
        ]);
    }

    public function destroy(Order $order): RedirectResponse
    {
        DB::transaction(function () use ($order): void {
            $order->orderItems()->delete();
            $order->delete();
        });

        return redirect()
            ->route('sales-orders.index')
            ->with('success', 'Sales Order berhasil dihapus.');
    }
}
