<?php

namespace App\Dto;

use App\Models\Payment;
use App\Models\User;

class PaymentUpdateDto
{
    public Payment $payment;
    public User $userAdmin;
    public User $user;
    public int $status;
}
