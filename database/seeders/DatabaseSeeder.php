<?php

namespace Database\Seeders;

use App\Models\Kapsam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Kapsam::create([
            'id' => 1,
            'parent_id' => 0,
            'title' => 'Temel Yeterlilik Sınavı',
            'abbr' => 'TYT',
            'tur' => 'sinav',
        ]);

        Kapsam::create([
            'id' => 2,
            'parent_id' => 0,
            'title' => 'AYT - Alan Yeterlilik Sınavı',
            'abbr' => 'AYT',
            'tur' => 'sinav',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Matematik',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'title' => 'Matematik',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Fizik',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'title' => 'Fizik',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Türkçe',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Tarih',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Coğrafya',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Felsefe',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Din Bilgisi',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Kimya',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Biyoloji',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'title' => 'Kimya',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'title' => 'Biyoloji',
            'tur' => 'ders',
        ]);
    }
}
