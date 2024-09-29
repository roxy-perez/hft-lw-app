@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-600 dark:text-gray-200 leading-tight">
            {{ __('Cuentas') }}
        </h2>
    </x-slot>

    @php
        $accounts = App\Models\Account::all()->where('user_id', Auth::id());
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-secondary-900 dark:text-secondary-100 font-mono">
                <livewire:accounts.show-accounts :accounts="$accounts"/>
            </div>
        </div>
    </div>
</x-app-layout>
