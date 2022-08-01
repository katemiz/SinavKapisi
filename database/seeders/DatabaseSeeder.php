<?php

namespace Database\Seeders;

use App\Models\HarunSonuc;
use App\Models\KapsamDal;
use App\Models\KapsamDers;
use App\Models\KapsamSinav;
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

        KapsamSinav::create([
            'id' => 1,
            'title' => 'Temel Yeterlilik Sınavı',
            'abbr' => 'TYT',
            'ssayisi' => 120,
        ]);

        KapsamSinav::create([
            'id' => 2,
            'title' => 'Alan Yeterlilik Sınavı',
            'abbr' => 'AYT',
            'ssayisi' => 80,
        ]);

        KapsamDal::create([
            'id' => 1,
            'kapsam_sinav_id' => 1,
            'title' => 'Türkçe',
            'abbr' => 'TYT-TUR',
            'ssayisi' => 40,
        ]);

        KapsamDal::create([
            'kapsam_sinav_id' => 1,
            'title' => 'Sosyal Bilgiler',
            'abbr' => 'TYT-SOS',
            'ssayisi' => 20,
        ]);

        KapsamDal::create([
            'kapsam_sinav_id' => 1,
            'title' => 'Matematik',
            'abbr' => 'TYT-MAT',
            'ssayisi' => 40,
        ]);

        KapsamDal::create([
            'kapsam_sinav_id' => 1,
            'title' => 'Fen Bilgisi',
            'abbr' => 'TYT-FEN',
            'ssayisi' => 20,
        ]);

        KapsamDal::create([
            'kapsam_sinav_id' => 2,
            'title' => 'Matematik',
            'abbr' => 'AYT-MAT',
            'ssayisi' => 40,
        ]);

        KapsamDal::create([
            'kapsam_sinav_id' => 2,
            'title' => 'Fen Bilgisi',
            'abbr' => 'AYT-FEN',
            'ssayisi' => 40,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 1,
            'kapsam_dal_id' => 2,
            'title' => 'Tarih',
            'abbr' => 'TYT-TAR',
            'ssayisi' => 5,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 1,
            'kapsam_dal_id' => 2,
            'title' => 'Coğrafya',
            'abbr' => 'TYT-COĞ',
            'ssayisi' => 5,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 1,
            'kapsam_dal_id' => 2,
            'title' => 'Felsefe',
            'abbr' => 'TYT-FEL',
            'ssayisi' => 5,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 1,
            'kapsam_dal_id' => 2,
            'title' => 'Din Bilgisi',
            'abbr' => 'TYT-DIN',
            'ssayisi' => 5,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 1,
            'kapsam_dal_id' => 4,
            'title' => 'Fizik',
            'abbr' => 'TYT-FİZ',
            'ssayisi' => 7,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 1,
            'kapsam_dal_id' => 4,
            'title' => 'Kimya',
            'abbr' => 'TYT-KIM',
            'ssayisi' => 7,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 1,
            'kapsam_dal_id' => 4,
            'title' => 'Biyoloji',
            'abbr' => 'TYT-BIY',
            'ssayisi' => 6,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 2,
            'kapsam_dal_id' => 6,
            'title' => 'Fizik',
            'abbr' => 'AYT-FİZ',
            'ssayisi' => 14,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 2,
            'kapsam_dal_id' => 6,
            'title' => 'Kimya',
            'abbr' => 'AYT-KIM',
            'ssayisi' => 13,
        ]);

        KapsamDers::create([
            'kapsam_sinav_id' => 2,
            'kapsam_dal_id' => 6,
            'title' => 'Biyoloji',
            'abbr' => 'AYT-BİY',
            'ssayisi' => 13,
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
            'sinav_tarihi' => '2020-07-24',
            'tur_dogru' => 26,
            'tur_yanlis' => 14,
            'sos_dogru' => 14,
            'sos_yanlis' => 6,
            'mat_dogru' => 25,
            'mat_yanlis' => 12,
            'fen_dogru' => 12,
            'fen_yanlis' => 8,
        ]);
    }
}
