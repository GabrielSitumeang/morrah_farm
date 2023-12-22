<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Mail\EmailAtach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function kirim()
    {
        Mail::to('otnielkalit25@gmail.com')->send(new Email());
    }

    public function attach()
    {
        $text = [
            'subject' => 'Pengiriman Dari Controller'
        ];
        Mail::to('otnielkalit25@gmail.com')->send(new EmailAtach($text));
    }
}
