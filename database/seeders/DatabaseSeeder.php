<?php

namespace Database\Seeders;

use App\Models\HarunSonuc;
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

        HarunSonuc::create([
            'sinav_tarihi' => '2020-06-24',
            'tur_dogru' => 25,
            'tur_yanlis' => 15,
            'sos_dogru' => 7,
            'sos_yanlis' => 13,
            'mat_dogru' => 9,
            'mat_yanlis' => 11,
            'fen_dogru' => 7,
            'fen_yanlis' => 10,
        ]);

        HarunSonuc::create([
            'sinav_tarihi' => '2020-06-29',
            'tur_dogru' => 26,
            'tur_yanlis' => 13,
            'sos_dogru' => 11,
            'sos_yanlis' => 8,
            'mat_dogru' => 12,
            'mat_yanlis' => 10,
            'fen_dogru' => 9,
            'fen_yanlis' => 8,
        ]);

        HarunSonuc::create([
            'sinav_tarihi' => '2020-01-01',
            'tur_dogru' => 30,
            'tur_yanlis' => 9,
            'sos_dogru' => 15,
            'sos_yanlis' => 4,
            'mat_dogru' => 18,
            'mat_yanlis' => 2,
            'fen_dogru' => 13,
            'fen_yanlis' => 6,
        ]);

        HarunSonuc::create([
            'sinav_tarihi' => '2020-07-05',
            'tur_dogru' => 29,
            'tur_yanlis' => 11,
            'sos_dogru' => 14,
            'sos_yanlis' => 6,
            'mat_dogru' => 17,
            'mat_yanlis' => 6,
            'fen_dogru' => 13,
            'fen_yanlis' => 4,
        ]);

        HarunSonuc::create([
            'sinav_tarihi' => '2020-07-07',
            'tur_dogru' => 30,
            'tur_yanlis' => 10,
            'sos_dogru' => 14,
            'sos_yanlis' => 6,
            'mat_dogru' => 23,
            'mat_yanlis' => 5,
            'fen_dogru' => 13,
            'fen_yanlis' => 5,
        ]);

        HarunSonuc::create([
            'sinav_tarihi' => '2020-07-11',
            'tur_dogru' => 31,
            'tur_yanlis' => 9,
            'sos_dogru' => 11,
            'sos_yanlis' => 9,
            'mat_dogru' => 21,
            'mat_yanlis' => 9,
            'fen_dogru' => 15,
            'fen_yanlis' => 5,
        ]);

        HarunSonuc::create([
            'sinav_tarihi' => '2020-07-13',
            'tur_dogru' => 31,
            'tur_yanlis' => 9,
            'sos_dogru' => 16,
            'sos_yanlis' => 2,
            'mat_dogru' => 29,
            'mat_yanlis' => 3,
            'fen_dogru' => 15,
            'fen_yanlis' => 5,
        ]);

        HarunSonuc::create([
            'sinav_tarihi' => '2020-07-19',
            'tur_dogru' => 27,
            'tur_yanlis' => 13,
            'sos_dogru' => 16,
            'sos_yanlis' => 4,
            'mat_dogru' => 22,
            'mat_yanlis' => 11,
            'fen_dogru' => 13,
            'fen_yanlis' => 5,
        ]);

        HarunSonuc::create([
            'sinav_tarihi' => '2020-07-21',
            'tur_dogru' => 23,
            'tur_yanlis' => 17,
            'sos_dogru' => 14,
            'sos_yanlis' => 6,
            'mat_dogru' => 29,
            'mat_yanlis' => 8,
            'fen_dogru' => 11,
            'fen_yanlis' => 8,
        ]);

        HarunSonuc::create([
            'sinav_tarihi' => '2020-07-21',
            'tur_dogru' => 23,
            'tur_yanlis' => 17,
            'sos_dogru' => 14,
            'sos_yanlis' => 6,
            'mat_dogru' => 29,
            'mat_yanlis' => 8,
            'fen_dogru' => 11,
            'fen_yanlis' => 8,
        ]);
    }
}
