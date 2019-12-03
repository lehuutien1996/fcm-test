<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\PayloadNotificationBuilder;

class SendMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fcm:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Message';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notification = (new PayloadNotificationBuilder('Đài PTHH Việt Nam'))
            ->setBody('Tin Bão Khẩn Cấp. Cơn bão số 7.')
            ->setSound('sound')
            ->setBadge('badge')
            ->build();

        FCM::sendTo(
            '',
            null,
            $notification,
            null
        );
    }
}
