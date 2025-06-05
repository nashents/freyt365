<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TransactionsTable extends DataTableComponent
{
    protected $model = Transaction::class;
    // protected ?string $primaryKey = 'id';

    public function columns(): array
    {
        $columns = [
            Column::make("Transaction#", "transaction_number")->sortable()->searchable(),
            Column::make("Reference", "transaction_reference")->sortable()->searchable(),
        ];

        if (Auth::user()->is_admin()) {
            $columns[] = Column::make("Company", "company_id")
                ->format(fn($value, $row) => optional($row->company)->name ?? '—');
        }

        $columns[] = Column::make("CreatedBy", "user_id")
            ->format(fn($value, $row) => optional($row->user)->name ?? '—');

        $columns[] = Column::make("Wallet", "wallet_id")
            ->format(fn($value, $row) => optional($row->wallet)->name ?? '—');

        $columns[] = Column::make("Date", "transaction_date")->sortable();

        $columns[] = Column::make("Type", "transaction_type_id")
            ->format(fn($value, $row) => optional($row->transactionType)->name ?? '—');

        $columns[] = Column::make("Ccy", "currency_id")
            ->format(fn($value, $row) => optional($row->currency)->code ?? '—');

        $columns[] = Column::make("Amt", "amount");

        if (!Auth::user()->is_admin()) {
            $columns[] = Column::make("Auth", "authorization");
        }

        $columns[] = Column::make("Verified/Declined", "verification")
            ->format(fn($value) => ucfirst($value));

        $columns[] = Column::make("Actions")
            ->label(fn($row) => view('livewire.transactions.actions', ['transaction' => $row]));

        return $columns;
    }

    public function query()
    {
        return Transaction::query()->with([
            'user',
            'wallet',
            'company',
            'currency',
            'transactionType'
        ]);
    }
}