<?php

namespace Database\Seeders;

use App\Models\Kapsam;
use App\Models\KapsamGroup;
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

        KapsamGroup::create([
            'id' => 1,
            'title' => 'TYT-SOS',
        ]);

        KapsamGroup::create([
            'id' => 2,
            'title' => 'TYT-FEN',
        ]);

        KapsamGroup::create([
            'id' => 3,
            'title' => 'AYT-FEN',
        ]);

        Kapsam::create([
            'id' => 1,
            'parent_id' => 0,
            'kapsam_group_id' => null,
            'title' => 'Temel Yeterlilik Sınavı',
            'abbr' => 'TYT',
            'tur' => 'sinav',
        ]);

        Kapsam::create([
            'id' => 2,
            'parent_id' => 0,
            'kapsam_group_id' => null,
            'title' => 'Alan Yeterlilik Sınavı',
            'abbr' => 'AYT',
            'tur' => 'sinav',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'kapsam_group_id' => null,
            'title' => 'Matematik',
            'abbr' => 'MAT',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'kapsam_group_id' => null,
            'title' => 'Matematik',
            'abbr' => 'MAT',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'kapsam_group_id' => 2,
            'title' => 'Fizik',
            'abbr' => 'FİZ',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'kapsam_group_id' => 3,
            'title' => 'Fizik',
            'abbr' => 'FİZ',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'kapsam_group_id' => null,
            'title' => 'Türkçe',
            'abbr' => 'TUR',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'kapsam_group_id' => 1,
            'title' => 'Tarih',
            'abbr' => 'TAR',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'kapsam_group_id' => 1,
            'title' => 'Coğrafya',
            'abbr' => 'COG',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Felsefe',
            'kapsam_group_id' => 1,
            'abbr' => 'FEL',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'title' => 'Din Bilgisi',
            'kapsam_group_id' => 1,
            'abbr' => 'DIN',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'kapsam_group_id' => 2,
            'title' => 'Kimya',
            'abbr' => 'KIM',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 1,
            'kapsam_group_id' => 2,
            'title' => 'Biyoloji',
            'abbr' => 'BIY',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'kapsam_group_id' => 3,
            'title' => 'Kimya',
            'abbr' => 'KIM',
            'tur' => 'ders',
        ]);

        Kapsam::create([
            'parent_id' => 2,
            'kapsam_group_id' => 3,
            'title' => 'Biyoloji',
            'abbr' => 'BIY',
            'tur' => 'ders',
        ]);
    }
}
