<?php

namespace App\Http\Controllers;

use App\Mail\MailClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailSetting extends Controller
{
    public function sendForm(Request $request)
    {

        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required|max:100',
                'phone' => 'alpha_dash|max:20',
                'email' => 'required|email',
                'comment' => 'max:5000'
            ];
            $this->validate($request, $rules);

            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $comment = $request->comment;

            Mail::to('mdn81@ukr.net')->send(new MailClass($name, $email, $phone, $comment));

            return redirect()->route('promotions')->withTitle('promotions');
        }
    }

    public function sendCronStatus(){
        Mail::to('mdn81@ukr.net')->send(new MailClass($name, $email, $phone, $comment));
    }
}
