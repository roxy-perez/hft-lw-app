<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'accounts' => Auth::user()->accounts()->orderBy('name', 'asc')->get()
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        <div class="grid grid-cols-1 gap-4 mt-4 lg:grid-cols-3 lg:gap-6">
            @foreach($accounts as $account)
                <x-card wire:key="{{ $account->id }}"
                        class="mb-4 text-surface dark:text-surface-200 shadow-tertiary dark:shadow-tertiary-2">
                    <div class="flex flex-col p-4 md:flex-row md:items-center md:justify-between">
                        <div class="px-3 py-2">
                            <a href="#"
                               class="font-semibold text-lg text-gray-600 dark:text-primary-200 leading-tight hover:underline hover:text-tertiary-300 dark:hover:text-tertiary-200">
                                {{ $account->name }}
                            </a>
                        </div>
                        <div class="px-3 py-2 font-mono text-md">
                            <p class="text-primary-600 dark:text-primary-400">
                                @if($account->balance > 0)
                                    <span class="text-green-600 dark:text-primary-500">{{ $account->balance }}€</span>
                                @else
                                    <span class="text-red-600 dark:text-tertiary-700">{{ $account->balance }}€</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center justify-end text-xs">
                        <p class="px-3 py-2 text-gray-600 dark:text-primary-200">
                            Creada el {{ $account->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </x-card>
            @endforeach
        </div>
    </div>
</div>
