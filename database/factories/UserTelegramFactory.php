<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTelegram>
 */
class UserTelegramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'chat_id' => 5556655,
            'username' => 'tg_username',
            'firstName' => 'FirstName',
            'lastName' => 'LastName',
            'languageCode' => 'en',
        ];
    }
}
