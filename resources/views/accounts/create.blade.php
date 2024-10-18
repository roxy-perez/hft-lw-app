@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary-600 dark:text-gray-200 leading-tight">
            {{ __('Create a new account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto space-y-4 sm:px-6 lg:px-8 ">
            <x-button xs positive icon="arrow-long-left" outline rounded="full" href="{{route('accounts.index')}}" class="text-secondary-700 font-semibold hover:bg-tertiary-400 hover:text-secondary-600">
                {{__('Back to Accounts')}}
            </x-button>
            <livewire:accounts.create/>
        </div>
    </div>
</x-app-layout>
