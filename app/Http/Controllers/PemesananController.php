<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PemesananController extends Controller
{
    // Daftar produk (nama => harga & nama file gambar di public/images). Cukup statis, tidak perlu tabel produk.
    public const PRODUK = [
        'Kopi Gayo Bubuk 250gr'      => ['harga' => 45000, 'gambar' => 'kopi-gayo.jpg'],
        'Kopi Toraja Bubuk 250gr'    => ['harga' => 50000, 'gambar' => 'kopi-toraja.jpg'],
        'Kopi Lampung Robusta 250gr' => ['harga' => 35000, 'gambar' => 'kopi-lampung.jpg'],
        'Kopi Bali Kintamani 250gr'  => ['harga' => 48000, 'gambar' => 'kopi-bali.jpg'],
        'Kopi Flores Bajawa 250gr'   => ['harga' => 52000, 'gambar' => 'kopi-flores.jpg'],
        'Kopi Java Preanger 250gr'   => ['harga' => 42000, 'gambar' => 'kopi-java.jpg'],
    ];
    // Halaman utama + formulir + riwayat pesanan
    public function index()
    {
        return view('index', [
            'produk'  => self::PRODUK,
            'pesanan' => Pesanan::latest()->take(20)->get(),
        ]);
    }

    // Simpan pesanan ke database
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pemesan'      => ['required', 'string', 'max:100'],
            'produk'            => ['required', Rule::in(array_keys(self::PRODUK))],
            'jumlah'            => ['required', 'integer', 'min:1', 'max:100'],
            'alamat_pengiriman' => ['required', 'string', 'max:500'],
        ]);

        Pesanan::create($data);

        return redirect()->to(route('home') . '#pesanan')
            ->with('sukses', 'Pesanan berhasil dikirim. Terima kasih!');
    }

    // Health check: teks "OK" jika aplikasi & database terhubung
    public function health()
    {
        try {
            DB::select('SELECT 1');
            return response('OK', 200)->header('Content-Type', 'text/plain');
        } catch (\Throwable $e) {
            return response('DATABASE ERROR', 503)->header('Content-Type', 'text/plain');
        }
    }
}
