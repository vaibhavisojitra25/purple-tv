<?php

namespace App\Helper;

use Edujugon\PushNotification\Facades\PushNotification;

class Helper
{
    public static function removeArrayElement($array, $value)
    {
        if (($key = array_search($value, $array)) !== false) {
            unset($array[$key]);
        }
        return $array;
    }

    public static function sendNotification($message, $tokens, $data = [])
    {
        $result = PushNotification::setService('fcm')
            ->setMessage([
                'notification' => [
                    'title' => 'Purple Smart TV',
                    'body' => $message,
                    'sound' => 'default'
                ],
                'data' => $data
            ])
            ->setDevicesToken($tokens)
            ->send()
            ->getFeedback();
            // ->sendByTopic('goldenplayers')
    }
}
