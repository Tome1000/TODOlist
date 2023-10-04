<?php

namespace App\Services;

use App\Contracts\PaymentGateway;

class PayMe implements PaymentGateway
{
    public function pay(): void
    {
        dd('You paid throught PayMe');
    }
}
