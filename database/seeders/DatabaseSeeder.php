<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Администратор',
            'login' => 'admin',
            'email' => 'admin@bukvoezhka.ru',
            'phone' => '+7(000)-000-00-00',
            'password' => bcrypt('bookworm'),
        ]);

        User::create([
            'name' => 'Иванов Иван Иванович',
            'login' => 'иванов',
            'email' => 'ivanov@mail.ru',
            'phone' => '+7(999)-123-45-67',
            'password' => bcrypt('123456'),
        ]);
    }
}
