@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
    <section class="max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-950">Edit Customer</h1>
            <p class="mt-1 text-sm text-slate-600">Perbarui data pelanggan.</p>
        </div>

        <form action="{{ route('customers.update', $customer) }}" method="POST" class="space-y-5 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <label for="cust_nama" class="block text-sm font-medium text-slate-700">Nama</label>
                <input id="cust_nama" name="cust_nama" type="text" value="{{ old('cust_nama', $customer->cust_nama) }}" required maxlength="100" class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
            </div>

            <div>
                <label for="cust_alamat" class="block text-sm font-medium text-slate-700">Alamat</label>
                <textarea id="cust_alamat" name="cust_alamat" required maxlength="255" rows="3" class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">{{ old('cust_alamat', $customer->cust_alamat) }}</textarea>
            </div>

            <div>
                <label for="cust_hp" class="block text-sm font-medium text-slate-700">HP</label>
                <input id="cust_hp" name="cust_hp" type="text" value="{{ old('cust_hp', $customer->cust_hp) }}" required maxlength="20" class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="rounded-md bg-slate-950 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Simpan</button>
                <a href="{{ route('customers.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </section>
@endsection
