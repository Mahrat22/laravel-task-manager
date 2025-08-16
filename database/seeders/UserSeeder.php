<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Optional: wipe current users (LOCAL DEV ONLY)
        // DB::table('users')->truncate();

        $names = [
            'Hanin Ali','Sara Nassar','Razan Hamdan','Hala Qassem','Mazen Matar',
            'Nada Saeed','Adonis Powlowski','Lonie Parker','Linwood Connelly',
            'Esmeralda Larson','Richie Hudson','Christopher Hamill','Estelle Rau',
            'Lucio Schiller','Pattie Corwin','Woodrow Gaylord','June Wehner',
            'Marco Walter','Claudie Leuschke','Holden Goodwin','Raphaelle Bahringer',
            'Chad Kessler','Julia Roberts','Kevin Parker','Freja Simone','Oscar Wilde',
            'Rachel Green','Mord Lmas','Tina Turner'
        ];

        $emailsUsed = [];

        foreach ($names as $name) {
            // build a unique-ish email each run
            $base = strtolower(str_replace(' ', '.', $name));
            $email = $base.'@example.com';
            if (in_array($email, $emailsUsed, true)) {
                $email = $base . '+' . Str::random(4) . '@example.com';
            }
            $emailsUsed[] = $email;

            DB::table('users')->insert([
                'name'       => $name,
                'email'      => $email,     // users.email is unique
                'password'   => bcrypt('password'),
                'age'        => rand(10, 40), // random ages for filtering
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
