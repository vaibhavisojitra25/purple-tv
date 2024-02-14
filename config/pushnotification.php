<?php
/**
 * @see https://github.com/Edujugon/PushNotification
 */

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAAX4TLzu8:APA91bHo9nPyV3zql5ouNdTg5IZVmEMATiUjSmY6b7wQxldjZyi2TPMWj0Q4unvZcSG42EIsi2c2N-jLwfaEoReBdXn4FserIZE9iYw1RmqllGWkoW_AfnrkQ9DF_iaYvBO6QyvoXJ0x',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        'passPhrase' => 'secret', //Optional
        'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true,
    ],
];
