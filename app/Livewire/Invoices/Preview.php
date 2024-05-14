<?php

namespace App\Livewire\Invoices;

use Livewire\Component;

class Preview extends Component
{

    public $invoice;

    public function mount($invoice){
        $this->invoice = $invoice;
    }

    public function render()
    {
        return view('livewire.invoices.preview');
    }
}
