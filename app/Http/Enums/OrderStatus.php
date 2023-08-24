<?php

namespace App\Http\Enums;

enum OrderStatus: string
{
    case newOrder = 'New order';
    case pendingClientApprove = 'Pending client approve';
    case pendingMaintenanceConfirm = 'Pending maintenance confirm';
    case processing = 'Processing';
    case pendingClientApproveFinish = 'Pending client to approve finish order';
    case finished = 'Finished';
    case canceled = 'Canceled';

    public static function getOrderStatus()
    {
        return [
            self::newOrder, self::pendingClientApprove, self::pendingMaintenanceConfirm,
            self::processing,  self::pendingClientApproveFinish, self::finished, self::canceled
        ];
    }
}
