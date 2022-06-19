<?php

namespace App\Http\Livewire;

use App\Models\Order;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Gate;

class EditOrder extends ModalComponent
{
    public $order;
    public $selectedStatus;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.edit-order');
    }

    public function update()
    {
        Gate::authorize('create', $this->order);

        if($this->selectedStatus == 1){
            $this->order->packaged_at = now();
        }
        
        if($this->selectedStatus == 2){
            $this->order->shipped_at = now();
        }

        $this->order->save();

        $this->closeModal();

        return redirect()->route('admin.orders.index');
    }
}
