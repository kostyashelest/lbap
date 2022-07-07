<?php

namespace App\Services;

use App\Models\Address;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;

class AddressService
{
    /**
     * @return bool
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public static function checkFreeAddress(): bool
    {
        $freeAddress = self::getFreeAddress();

        if ($freeAddress <= 5) {
            SystemNoticeService::createNotice('Attention', 'Available address count: ' . $freeAddress);

            $bot = new BotApi(env('TELEGRAM_BOT_TOKEN'));
            $bot->sendMessage(env('TELEGRAM_CHAT_ID'), 'Available address count: ' . $freeAddress);
        }

        return true;
    }

    /**
     * @return int
     */
    public static function getFreeAddress(): int
    {
        return Address::whereNull('user_id')->count();
    }

    /**
     * @return Address|bool
     */
    public static function getAddress(): Address|bool
    {
        return Address::whereNull('user_id')->first() ?? false;
    }
}
