@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-600 dark:text-gray-200 leading-tight">
            {{ __('Create a new account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        </div>
        <div class="p-6 text-secondary-900 dark:text-secondary-100 font-mono">
            <livewire:accounts.create-account />
        </div>
    </div>
</x-app-layout>
