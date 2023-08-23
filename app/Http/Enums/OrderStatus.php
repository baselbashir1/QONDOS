<?php

namespace App\Http\Enums;

enum OrderStatus: string
{
    case newOrder = 'New order';
    case pendingClientApprove = 'Pending client approve';
    case pendingMaintenanceConfirm = 'Pending maintenance confirm';
    case requestMaintenanceToFinish = 'Request maintenance to finish order';
    case pendingClientApproveFinish = 'Pending client to approve finish order';
    case finished = 'Finished';
    case canceled = 'Canceled';

    public static function getOrderStatus()
    {
        return [
            self::canceled, self::pendingMaintenanceConfirm, self::pendingClientApprove, self::requestMaintenanceToFinish,
            self::pendingClientApproveFinish, self::finished, self::canceled
        ];
    }
}
