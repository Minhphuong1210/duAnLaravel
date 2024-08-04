<?php

namespace App\Mail;

use App\Models\DonHang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;
    public $donHang;
    /**
     * Create a new message instance.
     */
    public function __construct(DonHang $donHang)
    {
        $this->donHang = $donHang;
    }
    // build the messaage
    public function build()
    {
        return $this->subject('Xác nhận đơn hàng')
            ->view('email.mailDonhang')
            ->with('donHang', $this->donHang);
    }


}
