<?php

namespace App\Listeners\AfterAPIExecuted;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\AfterAPIExecuted;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SendTelegram
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AfterAPIExecuted $event)
    {
        $data = $event->data;

        if(isset($data)) {
            $data = $data['telegram'];
            try{
                $send = (new Client())->request(
                    'POST',
                    config('tele.base_url') .'/bot'. config('tele.merapi_bot_id') . '/sendMessage?chat_id=' . $data['chat_id'] . '&text=' . $data['text']
                );
            }
            catch(RequestException $e){
                \Log::info($e);
            }
        }
    }
}
