<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class TransactionsExport implements FromQuery,
ShouldAutoSize,
WithMapping,
WithHeadings,
WithEvents,
WithDrawings,
WithCustomStartCell
{
    use Exportable;
 
    /**
    * @return \Illuminate\Support\Collection
    */
    public $from;
    public $to;
    public $selected_wallet;
   
   

    public function __construct($from, $to, $selected_wallet)
    {
            $this->from = $from;
            $this->to = $to;
            $this->selected_wallet = $selected_wallet;
            
    }
    public function query()
    { 
        if ($this->from && $this->to && $this->selected_wallet) {
            return Transaction::query()->with('order','wallet','currency','transaction_type','charge')
            ->where('authorization', 'approved')->where('wallet_id',$this->selected_wallet->id)->whereBetween('created_at',[$this->from, $this->to] )->orderBy('created_at','asc');
        }else{
            return Transaction::query()->with('order','wallet','currency','transaction_type','charge')
            ->where('authorization', 'approved')->where('wallet_id',$this->selected_wallet->id)->whereYear('created_at', date('Y') )->orderBy('created_at','asc');
        }
       
       
    }


    public function map($transaction): array{

                if ($transaction->movement == "Crt"){
                   $credit = number_format($transaction->amount ? $transaction->amount : 0,2);
                }else{
                    $credit = "";  
                }
                if ($transaction->movement == "Dbt"){
                   $debit = number_format($transaction->amount ? $transaction->amount : 0,2);
                }else{
                    $debit = "";  
                }
              
                $symbol = $transaction->currency ? $transaction->currency->symbol : "";
                $currency = $transaction->currency ? $transaction->currency->name : "";
                $created_at = Carbon::parse($transaction->created_at)->format('d-m-Y');

                if ($transaction->transaction_type->name == "Deposit"){
                    $narration = 
                    "Your " . ($transaction->wallet ? $transaction->wallet->name : "") .
                    " wallet with account number " . ($transaction->wallet ? $transaction->wallet->wallet_number : "") .
                    " has been credited with " . ($transaction->currency ? $transaction->currency->name : "") . " " .
                    ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                    number_format($transaction->amount ?? 0, 2) .
                    " via " . ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "") . " " .
                    ucfirst($transaction->mop ?? "") .
                    " as of " . ($transaction->transaction_date ?? "") .
                    ". Your new Account Balance is " . 
                    ($transaction->currency ? $transaction->currency->name : "") . " " .
                    ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                    number_format($transaction->wallet_balance ?? 0, 2);
                }
                elseif ($transaction->transaction_type->name == "Withdrawal") {
                    $narration = 
                    "Your " . ($transaction->wallet ? $transaction->wallet->name : "") .
                    " wallet with account number " . ($transaction->wallet ? $transaction->wallet->wallet_number : "") .
                    " has been debited with " . ($transaction->currency ? $transaction->currency->name : "") . " " .
                    ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                    number_format($transaction->amount ?? 0, 2) .
                    " via Cash " . ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "") . " " .
                    ($transaction->charge ? "Bank Charges" : "") .
                    " as of " . ($transaction->transaction_date ?? "") .
                    ". Your new Account Balance is " .
                    ($transaction->currency ? $transaction->currency->name : "") . " " .
                    ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                    number_format($transaction->wallet_balance ?? 0, 2);
                }
                if ($transaction->transaction_type->name == "Internal Transfer") {
                    if ($receiving_wallet) {
                        $narration = 
                            "Your " . ($transaction->wallet ? $transaction->wallet->name : "") .
                            " wallet with account number " . ($transaction->wallet ? $transaction->wallet->wallet_number : "") .
                            " has been debited with " . ($transaction->currency ? $transaction->currency->name : "") . " " .
                            ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                            number_format($transaction->amount ?? 0, 2) .
                            " via " . ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "") .
                            " to " . ($receiving_wallet->name ?? "") . " " . ($receiving_wallet->wallet_number ?? "") .
                            " as of " . ($transaction->transaction_date ?? "") .
                            ". Your new Account Balance is " .
                            ($transaction->currency ? $transaction->currency->name : "") . " " .
                            ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                            number_format($transaction->wallet_balance ?? 0, 2) . ".";
                    } else {
                        $narration = 
                            "Your " . ($transaction->wallet ? $transaction->wallet->name : "") .
                            " wallet with account number " . ($transaction->wallet ? $transaction->wallet->wallet_number : "") .
                            " has been debited with " . ($transaction->currency ? $transaction->currency->name : "") . " " .
                            ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                            number_format($transaction->amount ?? 0, 2) .
                            " via " . ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "") . " " .
                            ($transaction->charge ? "Bank Charges" : "") .
                            " as of " . ($transaction->transaction_date ?? "") .
                            ". Your new Account Balance is " .
                            ($transaction->currency ? $transaction->currency->name : "") . " " .
                            ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                            number_format($transaction->wallet_balance ?? 0, 2) . ".";
                    }
                }
                elseif ($transaction->transaction_type->name == "Service Order") {
                    $narration = 
                        "Your " . ($transaction->wallet ? $transaction->wallet->name : "") .
                        " wallet with account number " . ($transaction->wallet ? $transaction->wallet->wallet_number : "") .
                        " has been debited with " . ($transaction->currency ? $transaction->currency->name : "") . " " .
                        ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                        number_format($transaction->amount ?? 0, 2) .
                        " via a " . ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "") .
                        " as of " . ($transaction->transaction_date ?? "") .
                        ". Your new Account Balance is " .
                        ($transaction->currency ? $transaction->currency->name : "") . " " .
                        ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                        number_format($transaction->wallet_balance ?? 0, 2) . ".";
                }
                else {
                    $narration = 
                        "Your " . ($transaction->wallet ? $transaction->wallet->name : "") .
                        " wallet with account number " . ($transaction->wallet ? $transaction->wallet->wallet_number : "") .
                        " has been debited with " . ($transaction->currency ? $transaction->currency->name : "") . " " .
                        ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                        number_format($transaction->amount ?? 0, 2) .
                        " via Bank Charges as of " . ($transaction->transaction_date ?? "") .
                        ". Your new Account Balance is " .
                        ($transaction->currency ? $transaction->currency->name : "") . " " .
                        ($transaction->currency ? $transaction->currency->symbol : "") . " " .
                        number_format($transaction->wallet_balance ?? 0, 2) . ".";
                }
               
              
      
                return   [
                    $created_at,
                    $narration,
                    $transaction->transaction_reference,
                    $currency.' '.$symbol,
                    $debit,
                    $credit,
                    number_format($transaction->wallet_balance,2)
                 
                     ];

    }

    public function headings(): array{
            return[
                'Date',
                'Narration',
                'Ref#',
                'Currency',
                'Debit',
                'Credit',
                'Balance',               
            ];
    }
    public function registerEvents(): array{
        return[
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getStyle('A7:L7')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ]
                ]);
            },
        ];

    }

    public function drawings()
    {
        $drawing = new Drawing();
        if (isset(Auth::user()->employee->company)) {
        $drawing->setName(Auth::user()->employee->company->name);
        $drawing->setDescription(Auth::user()->employee->company->name . 'Logo');
        if (file_exists(public_path('/images/uploads/'.Auth::user()->employee->company->logo))){
            $drawing->setPath(public_path('/images/uploads/'.Auth::user()->employee->company->logo));
        }else{
            $drawing->setPath(public_path('/images/uploads/logo.png'));
        }
        } 
        $drawing->setHeight(90);
        $drawing->setCoordinates('A2');
        return $drawing;
    }

    public function startCell(): string{
        return 'A7';
    }
}
