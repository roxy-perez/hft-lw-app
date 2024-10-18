<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use WireUi\Traits\WireUiActions;

new class extends Component {
    use WireUiActions;

    public $accountName;
    public $accountType;
    public $balance;

    protected $rules = [
        'accountName' => ['required', 'string', 'min:5'],
        'accountType' => ['required', 'in:checking,savings,credit,cash'],
        'balance' => ['required', 'numeric']
    ];

    protected $messages = [
        'accountName.required' => 'El nombre de la cuenta es obligatorio',
        'accountName.string' => 'El nombre de la cuenta debe ser un texto',
        'accountName.min' => 'El nombre de la cuenta debe tener al menos 5 caracteres',
        'accountType.required' => 'Debes seleccionar un tipo de cuenta',
        'accountType.in' => 'Debes seleccionar un tipo de cuenta de la lista',
        'balance.required' => 'Debes especificar un saldo inicial para la cuenta',
        'balance.numeric' => 'El saldo de la cuenta debe ser una cifra numérica'
    ];

    public function submitAccount()
    {

        $this->validate();

        $account = Auth::user()->accounts()->create([
            'name' => $this->accountName,
            'type' => $this->accountType,
            'balance' => $this->balance,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->notification()->success(
            $title = __('Account created'),
            $description = __('The account has been successfully created.')
        );

        redirect()->route('accounts.index');
    }
}; ?>

<div class="flex justify-center items-center m-auto min-w-screen">
    <div class="flex flex-col w-full max-w-screen-md p-4 space-y-4 bg-white rounded-lg shadow-lg dark:bg-secondary-800">
        <x-card class="text-2xl font-bold text-center">
            <form wire:submit="submitAccount" class="space-y-4 text-secondary-900 dark:text-secondary-100">
                <x-select wire:model="accountType" label="Tipo de cuenta"
                          class="w-full text-sm" placeholder="Selecciona el tipo de cuenta" errorless>
                    <x-select.option label="Cuenta corriente" value="checking"/>
                    <x-select.option label="Cuenta de ahorros" value="savings"/>
                    <x-select.option label="Tarjeta de crédito" value="credit"/>
                    <x-select.option label="Efectivo" value="cash"/>
                </x-select>@error('accountType') <span
                    class="text-sm text-tertiary-500">{{ $message }}</span> @enderror
                <x-input wire:model="accountName" label="Nombre de la cuenta" type="text" class="w-full"
                         placeholder="Ejemplo: Cuenta Naranja" errorless/>@error('accountName') <span
                    class="text-sm text-tertiary-500">{{ $message }}</span> @enderror
                <x-input wire:model="balance" label="Saldo inicial" type="number" placeholder="1000.00" class="w-full"
                         errorless/>@error('balance') <span
                    class="text-sm text-tertiary-500">{{ $message }}</span> @enderror
                <div class="pt-4">
                    <x-button type="submit" rounded="full" right-icon="check"
                              class="font-semibold bg-primary-500 hover:bg-tertiary-400 ring ring-offset-2 ring-secondary-300" spinner="submitAccount">
                        {{__('Save')}}
                    </x-button>
                    <x-notifications />
                </div>
            </form>
        </x-card>
    </div>
</div>


