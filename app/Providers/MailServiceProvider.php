<?php

namespace App\Providers;

use Config;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('emailsettings')) {
            $mail = DB::table('emailsettings')->first();
            if ($mail) {
                $config = array(
                    'driver' => $mail->email_mail_driver,
                    'host' => $mail->email_mail_host,
                    'port' => $mail->email_mail_port,
                    'from' => array('address' => $mail->email_from_mail, 'name' => $mail->email_from_name),
                    'encryption' => $mail->email_mail_encryption,
                    'username' => $mail->email_mail_username,
                    'password' => $mail->email_mail_password,
                    'sendmail' => '/usr/sbin/sendmail -bs',
                    'pretend' => false,
                );
                Config::set('mail', $config);
            }
        }
    }

/**
 * Bootstrap services.
 *
 * @return void
 */
    public function boot()
    {
        //
    }

}
