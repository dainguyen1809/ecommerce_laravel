<?php

namespace app\helpers;

use App\Models\EmailConfiguration;

class MailHelper
{
    //override env mail
    public static function mailConfigure()
    {
        $emailConfig = EmailConfiguration::first();
        $config = [
            'transport' => 'smtp',
            'host' => $emailConfig->host,
            'port' => $emailConfig->port,
            'encryption' => $emailConfig->encryption,
            'username' => $emailConfig->username,
            'password' => $emailConfig->password,
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ];

        config(['mail.mailers.smtp' => $config]);
        config(['mail.from.address' => $emailConfig->email]);
    }
}
