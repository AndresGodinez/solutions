<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

use Session;
use Config;

class MailController extends Controller
{
    public function index()
    {
        return view("pages.mail.notificacion");
    }
    public function send($dispatch)
    {


        $url  = config('pages.globals.url');
        $link = new \stdClass();
        $link->url = $url .'detalle/show/'.$dispatch;
        $mail = 'juan_gustavo_vazquez_trevino_teknna@whirlpool.com';
             //$mail = Session::get('mail');
        Mail::to($mail)->send(new DemoEmail($link));
    }
}
