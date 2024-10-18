<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Account;
use WireUi\Traits\WireUiActions;

new #[Layout('layouts.app')] class extends Component {
    use WireUiActions;

    public Account $account;
    public $accountName;
    public $accountType;
    public $balance;

    public function mount(Account $account): void
    {
        $this->authorize('update', $account);
        $this->fill($account);
        $this->accountName = $account->name;
        $this->accountType = $account->type;
        $this->balance = $account->balance;
    }

    public function updateAccount()
    {
        $this->validate([
            'accountName' => ['required', 'string', 'min:5'],
            'accountType' => ['required', 'in:checking,savings,credit,cash'],
            'balance' => ['required', 'numeric']
        ]);


        $this->account->update([
            'name' => $this->accountName,
            'balance' => $this->balance,
            'type' => $this->accountType,
            'updated_at' => now(),
        ]);

        $this->notification()->success(
            $title = __('Account updated'),
            $description = __('The account has been successfully updated.')
        );

        redirect()->route('accounts.index');
    }
}; ?>

<x-slot name="header">
    <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit :name', ['name' => $account->name]) }}
    </h2>
</x-slot>

<main class="py-12">
    <div class="max-w-2xl mx-auto space-y-4 sm:px-6 lg:px-8">
        <div
            class="flex flex-col w-full max-w-screen-md p-4 space-y-4 bg-white rounded-lg shadow-lg dark:bg-secondary-800">
            <x-card class="text-2xl font-bold text-center">
                <div class="flex justify-start mb-4">
                    <x-button xs href="{{route('accounts.index')}}" outline icon="arrow-long-left"
                              class="text-secondary-700 font-semibold hover:bg-tertiary-400 hover:text-secondary-600 mb-4"
                              rounded="full">
                        {{__('Back to Accounts')}}
                    </x-button>
                </div>
                <form wire:submit="updateAccount" class="space-y-4 text-secondary-900 dark:text-secondary-100">
                    <x-input label="Nombre de la cuenta" type="text" class="w-full"
                             wire:model="accountName" errorless/>@error('accountName') <span
                        class="text-sm text-tertiary-500">{{ $message }}</span> @enderror
                    <x-select wire:model="accountType" label="Tipo de cuenta"
                              class="w-full text-sm" placeholder="Selecciona el tipo de cuenta" errorless>
                        <x-select.option label="Cuenta corriente" value="checking"/>
                        <x-select.option label="Cuenta de ahorros" value="savings"/>
                        <x-select.option label="Tarjeta de crédito" value="credit"/>
                        <x-select.option label="Efectivo" value="cash"/>
                    </x-select>@error('accountType') <span
                        class="text-sm text-tertiary-500">{{ $message }}</span> @enderror
                    <x-input label="Saldo inicial" type="number" class="w-full" wire:model="balance"
                             errorless/>@error('balance') <span
                        class="text-sm text-tertiary-500">{{ $message }}</span> @enderror
                    <div class="pt-4">
                        <x-button type="submit" rounded="full"
                                  class="font-semibold bg-primary-500 hover:bg-tertiary-400 ring ring-offset-2 ring-secondary-300"
                                  spinner="updateAccount">{{__('Update')}}
                        </x-button>
                        <x-notifications/>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</main>

