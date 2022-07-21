<?php

namespace App\Http\Livewire\Admin\Qarzdorlar;

use App\Models\Debtor;
use Livewire\Component;

class Ruyhat extends Component
{
    public $debtors, $status;

    public function render()
    {
        // $this->debtors = Debtor::whereNull('returned_time')->orderBy('return_time', 'asc')->get();
        $this->debtors = Debtor::orderBy('return_time', 'desc')->get();
        return view('livewire.admin.qarzdorlar.ruyhat');
    }

    

}
