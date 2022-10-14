<?php

namespace App\Mail;

use App\Models\Cake;
use App\Models\CakeLead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CakeAvailableMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private CakeLead $cakeLead)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cake = $this->cakeLead->cake;
        $lead = $this->cakeLead->lead;

        return $this
        ->to($lead->email, $lead->name)
        ->subject(__('cake.available', ['cake' => $cake->name]))
        ->markdown('mail.cake-available-mail', [
            'cake' => $cake,
            'lead' => $lead,
        ]);
    }
}
