<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;
    private $order;
    private $total;
    private $clientInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $total, $clientInfo)
    {
        $this->order=$order;
        $this->total=$total;
        $this->clientInfo=$clientInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sale= $this->order;
        $tot= $this->total;
        $infoClient= $this->clientInfo;

        return $this->from('noreply@FastAndFood.com')->view('email', compact('sale', 'tot', 'infoClient'));
    }
}
