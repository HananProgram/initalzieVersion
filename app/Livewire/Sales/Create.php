<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Models\{Sale, ServiceType, Provider, Intermediary, Account};
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Create extends Component
{
    // public $beneficiary_name, $sale_date, $service_type_id, $provider_id,
    //        $intermediary_id, $usd_buy, $usd_sell, $note, $sale_profit = 0;


    // public function save()
    // {
    //     $this->validate([
    //         'beneficiary_name' => 'required|string|max:255',
    //         'sale_date' => 'required|date',
    //         'service_type_id' => 'required|exists:service_types,id',
    //         'provider_id' => 'nullable|exists:providers,id',
    //         'intermediary_id' => 'nullable|exists:intermediaries,id',
    //         'usd_buy' => 'nullable|numeric',
    //         'usd_sell' => 'nullable|numeric',
    //         'note' => 'nullable|string|max:1000',
    //     ]);

    //     Sale::create([
    //         'agency_id' => Auth::user()->agency_id,
    //         'user_id' => Auth::id(),
    //         'beneficiary_name' => $this->beneficiary_name,
    //         'sale_date' => $this->sale_date,
    //         'service_type_id' => $this->service_type_id,
    //         'provider_id' => $this->provider_id,
    //         'intermediary_id' => $this->intermediary_id,
    //         'usd_buy' => $this->usd_buy,
    //         'usd_sell' => $this->usd_sell,
    //         'sale_profit' => $this->sale_profit,
    //         'note' => $this->note,
    //     ]);

    //     session()->flash('success', 'تمت إضافة العملية بنجاح');
    //     return redirect()->route('sales.index');
    // }

    // public function render()
    // {
    //     return view('livewire.sales.create', [
    //         'serviceTypes' => ServiceType::all(),
    //         'providers' => Provider::all(),
    //         'intermediaries' => Intermediary::all(),
    //     ])->layout('layouts.agency');
    // }
}
