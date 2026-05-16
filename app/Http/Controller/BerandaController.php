<?php

namespace App\Http\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/*
|--------------------------------------------------------------------------
| BerandaController - Gurau Tenda Palembang
|--------------------------------------------------------------------------
| Controller ini menangani halaman utama website Gurau Tenda.
| Berisi logika untuk menampilkan data dan mengecek ketersediaan kamar kost.
|--------------------------------------------------------------------------
*/

class BerandaController extends Controller
{
    /**
     * Menampilkan halaman beranda utama.
     * Mengambil data ketersediaan kamar dari database/session
     * lalu dikirim ke view Blade.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dataKamar = $this->ambilDataKamar();
        return view('beranda', compact('dataKamar'));
    }

    public function sewaTenda()
    {
        $dataKamar = $this->ambilDataKamar();
        return view('sewa-tenda', compact('dataKamar'));
    }

    public function kostPutri()
    {
        $dataKamar = $this->ambilDataKamar();
        return view('kost-putri', compact('dataKamar'));
    }

    public function testimoni()
    {
        $dataKamar = $this->ambilDataKamar();
        return view('testimoni-page', compact('dataKamar'));
    }

    /**
     * Mengecek ketersediaan kamar berdasarkan bulan yang dipilih pengunjung.
     * Dipanggil via AJAX dari halaman beranda (tombol "Cek Ketersediaan").
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cekKetersediaan(Request $request)
    {
        // Validasi: bulan wajib diisi
        $request->validate([
            'bulan' => 'required|string'
        ]);

        $bulan = $request->input('bulan');
        $dataKamar = $this->ambilDataKamar();

        // Cek apakah bulan yang diminta ada di data
        if (!isset($dataKamar[$bulan])) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Bulan tidak valid.'
            ], 422);
        }

        $info = $dataKamar[$bulan];

        return response()->json([
            'status'    => 'ok',
            'tersedia'  => $info['tersedia'],
            'jumlahKamar' => $info['jumlah_kamar'],
            'bulan'     => $bulan,
        ]);
    }

    /**
     * Mengambil data ketersediaan kamar.
     * Data diambil dari session (disimpan oleh admin melalui AdminController).
     * Jika belum ada, kembalikan data default (semua penuh, 0 kamar).
     *
     * @return array
     */
    private function ambilDataKamar(): array
    {
        if (session()->has('data_ketersediaan_kamar')) {
            return session('data_ketersediaan_kamar');
        }

        // Otomatis ambil tahun berjalan
        $tahun = date('Y');

        $bulanList = [
            'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        ];

        $data = [];
        foreach ($bulanList as $bulan) {
            $data[$bulan . ' ' . $tahun] = [
                'tersedia'     => false,
                'jumlah_kamar' => 0,
            ];
        }

        return $data;
    }
}