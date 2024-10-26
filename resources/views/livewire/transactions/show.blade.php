<?php

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public $accounts;
    public $selectedAccountId;
    public $transactions;

    public function mount(): void
    {
        $this->accounts = Auth::user()->accounts()->get();
        $this->transactions = collect();
        $this->selectedAccountId = null;
    }

    public function updatedSelectedAccountId($value)
    {
        $this->transactions = $value ? Transaction::where('account_id', $value)->get() : collect();
        dd($this->transactions);
    }

    public function render(): mixed
    {
        return view('livewire.transactions.show', [
            'transactions' => $this->transactions,
            'accounts' => $this->accounts,
            'selectedAccountId' => $this->selectedAccountId
        ]);
    }

}; ?>

<main>

    <div class="space-y-4">
        <div>
            <label for="accountSelect" class="block text-sm font-medium text-gray-700">Select Account:</label>
            <x-select wire:model="selectedAccountId" id="accountSelect" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <x-select.option value="">Select an Account</x-select.option>
                @foreach($accounts as $account)
                    <x-select.option :value="$account->id">{{ $account->name }}</x-select.option>
                @endforeach
            </x-select>
        </div>

        <div class="mt-4">
            {{$this->selectedAccountId}}
        </div>

        <div class="mt-4">
            <h2 class="text-lg font-bold">Transactions</h2>
            @if($transactions->isEmpty())
                <p>No transactions available for this account.</p>
            @else
                <ul class="mt-2">
                    @foreach($transactions as $transaction)
                        <li class="border-b py-2">
                            {{ $transaction->description }} - {{ $transaction->amount }}
                            on {{ $transaction->date->format('Y-m-d') }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</main>
