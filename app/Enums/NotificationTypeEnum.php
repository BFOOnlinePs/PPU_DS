<?php

namespace App\Enums;

// enum NotificationTypeEnum: string
// {
//     case Default = 'default';
//     case MESSAGE = 'message'; // target id is conversation id
//     case PAYMENT = 'payment'; // target id is student company id
//     case PAYMENT_CONFIRMATION = 'payment_confirmation'; // target id is student company id
// }

class NotificationTypeEnum
{
    const DEFAULT = 'default';
    const MESSAGE = 'message'; // target id is conversation id
    const PAYMENT = 'payment'; // target id is student company id
    const PAYMENT_CONFIRMATION = 'payment_confirmation'; // target id is student company id
}


