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
            'abbr' => 'MAT',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'title' => 'Matematik',
            'abbr' => 'MAT',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Fizik',
            'abbr' => 'FİZ',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'title' => 'Fizik',
            'abbr' => 'FİZ',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Türkçe',
            'abbr' => 'TUR',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Tarih',
            'abbr' => 'TAR',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Coğrafya',
            'abbr' => 'COG',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Felsefe',
            'abbr' => 'FEL',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Din Bilgisi',
            'abbr' => 'DIN',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Kimya',
            'abbr' => 'KIM',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Biyoloji',
            'abbr' => 'BIY',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'title' => 'Kimya',
            'abbr' => 'KIM',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'title' => 'Biyoloji',
            'abbr' => 'BIY',
            'tur' => 'ders',
        ]);
    }
}
