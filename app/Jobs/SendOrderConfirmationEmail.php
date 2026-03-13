<?php

namespace App\Jobs;

use App\Mail\OrderConfirmedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $items;
    public $email;

    public function __construct($order, $items, $email)
    {
        $this->order = $order;
        $this->items = $items;
        $this->email = $email;
    }

    public function handle()
    {
        // Mail::to($this->email)
        //     ->send(new OrderConfirmedMail($this->order, $this->items));
    }
}