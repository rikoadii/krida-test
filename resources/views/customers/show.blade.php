@extends('layouts.app')

@section('title', 'Detail Customer')

@section('content')
    <section class="max-w-2xl space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-950">Detail Customer</h1>
                <p class="mt-1 text-sm text-slate-600">Informasi pelanggan.</p>
            </div>
            <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center justify-center rounded-md bg-slate-950 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Edit</a>
        </div>

        <dl class="divide-y divide-slate-100 rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-1 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-slate-500">ID</dt>
                <dd class="text-sm text-slate-950 sm:col-span-2">{{ $customer->custId }}</dd>
            </div>
            <div class="grid gap-1 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-slate-500">Nama</dt>
                <dd class="text-sm text-slate-950 sm:col-span-2">{{ $customer->cust_nama }}</dd>
            </div>
            <div class="grid gap-1 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-slate-500">Alamat</dt>
                <dd class="text-sm text-slate-950 sm:col-span-2">{{ $customer->cust_alamat ?: '-' }}</dd>
            </div>
            <div class="grid gap-1 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-slate-500">HP</dt>
                <dd class="text-sm text-slate-950 sm:col-span-2">{{ $customer->cust_hp }}</dd>
            </div>
        </dl>

        <a href="{{ route('customers.index') }}" class="inline-flex rounded-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Kembali</a>
    </section>
@endsection
