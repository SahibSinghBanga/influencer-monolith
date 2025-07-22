<?php

namespace App\Console\Commands;

use App\Jobs\OrderCompleted;
use App\Models\Order;
use Illuminate\Console\Command;

class ProduceCommand extends Command
{
    protected $signature = 'produce';

    public function handle()
    {
        $order = Order::find(1);
        
        OrderCompleted::dispatch($order->toArray());
    }
}
