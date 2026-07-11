<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JuknisCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear old scores and criteria as the scoring model changed completely
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Score::truncate();
        \App\Models\Criteria::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $criterias = [
            [
                'name' => 'KESESUAIAN TEMA & NARASI',
                'weight' => 30, // max score
                'description' => "25 – 30 Poin: Sosok yang dipotret sangat jelas kontribusinya bagi lingkungan/Paser, relevan dengan semangat mengisi kemerdekaan, dan narasi menceritakan dedikasinya dengan sangat baik.\n15 – 24 Poin: Sosok relevan, namun hubungan dengan semangat kemerdekaan atau latar belakang khas Paser kurang kuat.\n< 15 Poin: Hubungan sosok dengan tema lemah, atau cerita tidak tersampaikan.",
                'order' => 1,
            ],
            [
                'name' => 'KOMPOSISI & ESTETIKA VISUAL',
                'weight' => 25,
                'description' => "21 – 25 Poin: Sudut pengambilan (angle) sangat kreatif, objek utama langsung menarik perhatian, latar belakang mendukung tanpa mengganggu.\n11 – 20 Poin: Komposisi standar (umum), posisi objek utama cukup baik namun kurang dinamis.\n< 10 Poin: Komposisi berantakan, membingungkan, atau objek terpotong tidak disengaja.",
                'order' => 2,
            ],
            [
                'name' => 'TEKNIS FOTOGRAFI',
                'weight' => 20,
                'description' => "*Untuk Kategori Smartphone, toleransi noise/sensor disesuaikan, ketajaman objek tetap jadi fokus utama.\n\n16 – 20 Poin: Gambar tajam di area krusial (mata/wajah), pencahayaan pas, warna natural.\n10 – 15 Poin: Ada sedikit misfokus atau pencahayaan kurang seimbang, momen masih terselamatkan.\n< 10 Poin: Foto buram parah (goyang) atau terlalu gelap/terang hingga detail hilang.",
                'order' => 3,
            ],
            [
                'name' => 'DAMPAK EMOSIONAL, MARTABAT & INSPIRASI',
                'weight' => 25,
                'description' => "21 – 25 Poin: Menangkap momen emas, memancarkan harga diri/martabat tinggi, sangat menginspirasi.\n11 – 20 Poin: Ekspresi objek datar, momen kurang kuat menggerakkan emosi penonton.\n< 10 Poin: Mengeksploitasi kesedihan berlebihan (poverty porn) atau objek terlihat tidak nyaman.",
                'order' => 4,
            ]
        ];

        foreach ($criterias as $c) {
            \App\Models\Criteria::create($c);
        }
    }
}
