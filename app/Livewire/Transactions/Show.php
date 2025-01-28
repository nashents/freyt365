<?php

namespace App\Livewire\Transactions;

use App\Models\Wallet;
use Livewire\Component;
use App\Models\BankAccount;

class Show extends Component
{
    public $transaction;
    public $receiving_wallet;
    public $from_account;
    public $to_account;

    public function mount($transaction){
        $this->transaction = $transaction;
        $this->receiving_wallet = Wallet::find($transaction->receiving_wallet_id);
        $this->from_account = BankAccount::find($transaction->from);
        $this->to_account = BankAccount::find($transaction->to);
    }
    public function render()
    {
        return view('livewire.transactions.show');
    }
}
