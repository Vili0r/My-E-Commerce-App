<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart extends Component
{
    public $days = [];
    public $sales = [];
    public $recentSales;
    public $orders;

    public function mount()
    {
        $this->recentSales = Order::sum('subtotal');

        $this->orders = Order::select(
            DB::raw("(sum(subtotal)) as total_date"),
            DB::raw("(DATE(created_at)) as my_date")
        )
        ->orderBy('created_at')
        ->groupBy('my_date')
        ->pluck('total_date', 'my_date');

        $this->sales = $this->orders->keys();
        
        $this->days = $this->orders->values();
    }

    public function render()
    {
         return view('livewire.admin.chart');
    }
}
