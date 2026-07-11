<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        return view('pages.track');
    }

    public function search(Request $request)
    {
        $request->validate([
            'instagram' => 'required|string|max:255'
        ]);

        $username = $request->instagram;

        // Clean up the input (remove @ or https://instagram.com/ if user accidentally pasted it)
        $username = str_replace(['@', 'https://www.instagram.com/', 'https://instagram.com/', 'http://www.instagram.com/', 'http://instagram.com/'], '', $username);
        $username = trim($username, '/'); // remove trailing slash if any

        // Find the photo (if multiple, get the latest)
        $photo = Photo::where('instagram', 'like', '%' . $username . '%')->orderBy('created_at', 'desc')->first();

        if (!$photo) {
            return back()->with('error', 'Mohon maaf, karya dengan username Instagram @' . $username . ' tidak ditemukan. Pastikan username yang Anda masukkan sama dengan saat pendaftaran.');
        }

        // Determine status
        $status = [
            'step' => 1,
            'title' => 'Menunggu Verifikasi',
            'message' => 'Foto berhasil terupload. Menunggu verifikasi panitia.',
            'color' => 'text-blue-400',
            'bg' => 'bg-blue-500/20 border-blue-500/30'
        ];

        if ($photo->is_disqualified || $photo->verification_status === 'Disqualified') {
            $status = [
                'step' => 0, // 0 for disqualified
                'title' => 'Diskualifikasi',
                'message' => 'Mohon maaf, karya Anda didiskualifikasi. Jika Anda memiliki pertanyaan, silakan <a href="' . url('/contact') . '" class="underline font-bold text-red-300 hover:text-white">hubungi panitia</a>.',
                'color' => 'text-red-400',
                'bg' => 'bg-red-500/20 border-red-500/30'
            ];
        } elseif ($photo->verification_status === 'Verified') {
            if ($photo->scores->isEmpty()) {
                $status = [
                    'step' => 2,
                    'title' => 'Menunggu Penilaian Juri',
                    'message' => 'Verifikasi berhasil. Menunggu penilaian juri (8-10 Agustus).',
                    'color' => 'text-yellow-400',
                    'bg' => 'bg-yellow-500/20 border-yellow-500/30'
                ];
            } else {
                $status = [
                    'step' => 3,
                    'title' => 'Selesai Dinilai',
                    'message' => 'Foto sudah dinilai oleh juri. Tunggu pengumuman hasil di web dan sosmed kasiinfo.id.',
                    'color' => 'text-green-400',
                    'bg' => 'bg-green-500/20 border-green-500/30'
                ];
            }
        }

        return view('pages.track', compact('photo', 'status', 'username'));
    }
}
