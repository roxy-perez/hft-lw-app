<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class Dashboard extends Component
{
    public $accounts;
    public $transactions;
    public $totalIncome;
    public $totalExpense;
    public $totalBalance;
    public $recentTransactions;

    public function mount()
    {
        $this->accounts = auth()->user()->accounts;
        $this->transactions = Transaction::where('user_id', auth()->id())->latest()->take(5)->get();
        $this->totalIncome = Transaction::where('user_id', auth()->id())->where('transaction_type_id', 1)->sum('amount');
        $this->totalExpense = Transaction::where('user_id', auth()->id())->where('transaction_type_id', 2)->sum('amount');
        $this->totalBalance = $this->totalIncome + $this->totalExpense;
        $this->recentTransactions = Transaction::where('user_id', auth()->id())->latest()->take(5)->get();
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
