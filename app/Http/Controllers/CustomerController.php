<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $search = request('search');

        $query = Customer::query()
            ->when($search, function ($q) use ($search) {
                $q->where('cust_nama', 'like', "%{$search}%")
                  ->orWhere('cust_hp', 'like', "%{$search}%");
                  
                $searchInt = (int) preg_replace('/[^0-9]/', '', $search);
                if ($searchInt > 0) {
                    $q->orWhere('custId', $searchInt);
                }
            });

        return view('customers.index', [
            'customers' => $query->orderByDesc('custId')->paginate(10)->withQueryString(),
        ]);
    }

    public function create(): View
    {
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        Customer::create($request->validated());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil ditambahkan.');
    }

    public function show(Customer $customer): View
    {
        return view('customers.show', [
            'customer' => $customer,
        ]);
    }

    public function edit(Customer $customer): View
    {
        return view('customers.edit', [
            'customer' => $customer,
        ]);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil diperbarui.');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        if ($customer->orders()->exists()) {
            return redirect()
                ->route('customers.index')
                ->with('error', 'Customer tidak dapat dihapus karena sudah memiliki order.');
        }

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil dihapus.');
    }
}
