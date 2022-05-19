<?php

namespace Database\Seeders;

use App\Models\PaymentSystem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Notifications\NotificationSender;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingSeeder::class,
            PaymentSystemSeeder::class,
            ContentSeeder::class,
            UserRoleSeeder::class,
            UserAdminSeeder::class,
            UserSeeder::class,
            PaymentSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
