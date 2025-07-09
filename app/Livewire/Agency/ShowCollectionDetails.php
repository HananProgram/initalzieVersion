<?php

namespace App\Livewire\Agency;

use Livewire\Component;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use App\Models\DynamicListItemSub;
use App\Models\DynamicList;
class ShowCollectionDetails extends Component
{
    public $sale;

    public function mount($sale)
    {
        $this->sale = Sale::with([
            'customer',
            'collections.customerType',
            'collections.debtType',
            'collections.customerResponse',
            'collections.customerRelation'
        ])
        ->where('agency_id', Auth::user()->agency_id)
        ->findOrFail($sale);

        $this->totalAmount = $this->sale->usd_sell ?? 0;
        $this->paidFromSales = $this->sale->amount_received ?? 0;
        $this->paidFromCollections = $this->sale->collections->sum('amount');
        $this->paidTotal = $this->paidFromSales + $this->paidFromCollections;

        // تحديث قيمة المتغيرات المعروضة:
        $this->amountReceived = $this->paidTotal;
        $this->remainingAmount = $this->totalAmount - $this->paidTotal;
    }


    public function render()
    {
        return view('livewire.agency.show-collection-details')
            ->layout('layouts.agency');
    }

    public $services = [];
    public $saleId;
    public $totalAmount = 0; // قيمة الفاتورة
    public $amountReceived = 0; // المدفوع
    public $remainingAmount = 0; // المتبقي
    public $showEditModal = false;
    public $paidAmount;
    public $paidFromSales = 0;
    public $paidFromCollections = 0;
    public $paidTotal = 0;
    public $payRemainingNow = 0;

    public function openEditAmountModal($saleId)
    {
        $this->sale = Sale::with('collections')->findOrFail($saleId);

        $this->totalAmount = $this->sale->usd_sell ?? 0;
        $this->paidFromSales = $this->sale->amount_received ?? 0;
        $this->paidFromCollections = $this->sale->collections->sum('amount');
        $this->paidTotal = $this->paidFromSales + $this->paidFromCollections;
        $this->remainingAmount = $this->totalAmount - $this->paidTotal;

        // إذا لم يتبقى شيء، لا تفتح النافذة
        if ($this->remainingAmount <= 0) {
            session()->flash('message', 'تم سداد كامل المبلغ، لا يمكن التحصيل.');
            return;
        }

        $this->services = DynamicListItemSub::whereHas('parentItem', function($q) {
            $q->whereHas('dynamicList', fn($q) => $q->where('name', 'قائمة الخدمات'));
        })->get()->map(function ($service) {
            return ['id' => $service->id, 'name' => $service->label, 'amount' => 0, 'paid' => 0];
        })->toArray();

        $this->showEditModal = true;
    }

    public function saveAmounts()
    {
        $totalServiceAmount = collect($this->services)->sum('amount');
        $payAmount = $this->payRemainingNow ?? 0;

        $totalToPay = $totalServiceAmount + $payAmount;

        if ($totalToPay > $this->remainingAmount) {
            $this->addError('amount', 'المبلغ الكلي يتجاوز المتبقي!');
            return;
        }

        if ($totalToPay <= 0) {
            $this->addError('amount', 'لا يوجد مبلغ لتحصيله.');
            return;
        }

        \App\Models\Collection::create([
            'agency_id' => $this->sale->agency_id,
            'sale_id' => $this->sale->id,
            'amount' => $totalToPay,
            'payment_date' => now(),
            'note' => 'تحصيل تلقائي لباقي المبلغ.',
        ]);

        $this->showEditModal = false;
        session()->flash('success', 'تم تسجيل التحصيل بنجاح.');
    }

    public function cancelEdit()
    {
        $this->reset(['showEditModal', 'services', 'payRemainingNow']);
    }

}
