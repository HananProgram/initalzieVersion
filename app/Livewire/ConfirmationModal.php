<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmationModal extends Component
{
    public $show = false;
    public $title = '';
    public $message = '';
    public $confirmAction;
    public $confirmText = 'تأكيد';
    public $cancelText = 'إلغاء';

    protected $listeners = ['showConfirmationModal' => 'showModal'];

    public function showModal($data)
    {
        $this->title = $data['title'] ?? 'تأكيد العملية';
        $this->message = $data['message'] ?? 'هل أنت متأكد من رغبتك في تنفيذ هذه العملية؟';
        $this->confirmAction = $data['action'] ?? null;
        $this->confirmText = $data['confirmText'] ?? 'تأكيد';
        $this->cancelText = $data['cancelText'] ?? 'إلغاء';
        $this->show = true;
    }

    public function confirm()
    {
        if ($this->confirmAction) {
            $this->dispatch($this->confirmAction);
        }
        $this->show = false;
    }

    public function cancel()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.confirmation-modal');
    }
}