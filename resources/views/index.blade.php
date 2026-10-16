<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kopi Bubuk Lokal Nusantara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box}
        body{margin:0;font-family:'Poppins',system-ui,Arial,sans-serif;background:#faf6f1;color:#3b2a20;line-height:1.6}
        h1,h2,h3{font-family:'Playfair Display',Georgia,serif}
        header h1{font-size:2.6rem;letter-spacing:.5px}
        h2{font-size:1.8rem}      
        .wrap{max-width:1000px;margin:0 auto;padding:0 20px}
        header{background:#4a2c1a;color:#fff;padding:48px 0;text-align:center}
        header h1{margin:0 0 8px;font-size:2rem}
        section{padding:32px 0}
        h2{border-bottom:3px solid #c68b59;display:inline-block;padding-bottom:4px}
        .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:16px;margin-top:16px}
        .card{background:#fff;border-radius:10px;padding:18px;box-shadow:0 2px 6px rgba(0,0,0,.08)}
        .card h3{margin:0 0 6px;font-size:1.05rem}
        .foto{position:relative;height:160px;border-radius:8px;background:#e8d9c8;display:flex;align-items:center;justify-content:center;font-size:3rem;margin-bottom:12px;overflow:hidden}
        .foto img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
        .harga{color:#a0522d;font-weight:700}
        form{background:#fff;padding:20px;border-radius:10px;box-shadow:0 2px 6px rgba(0,0,0,.08)}
        label{display:block;margin-top:12px;font-weight:600}
        input,select,textarea{width:100%;padding:10px;border:1px solid #ccc;border-radius:6px;font:inherit}
        button{margin-top:16px;background:#a0522d;color:#fff;border:0;padding:12px 24px;border-radius:6px;font-size:1rem;cursor:pointer}
        button:hover{background:#7d3f22}
        .ok{background:#e0f5e4;border:1px solid #8fd19e;padding:12px;border-radius:6px;margin-bottom:12px}
        .err{background:#fde8e8;border:1px solid #f0a0a0;padding:12px;border-radius:6px;margin-bottom:12px}
        .tabel{overflow-x:auto}
        table{width:100%;border-collapse:collapse;background:#fff;border-radius:10px;overflow:hidden}
        th,td{padding:10px 12px;text-align:left;border-bottom:1px solid #eee}
        th{background:#c68b59;color:#fff}
        footer{background:#2b1a10;color:#e8d9c8;text-align:center;padding:20px;font-size:.9rem}
    </style>
</head>
<body>
<header>
    <div class="wrap">
        <h1>☕ Kopi Bubuk Lokal Nusantara</h1>
        <p>Kopi bubuk berkualitas dari biji robusta &amp; arabika pilihan petani lokal Indonesia,
           digiling segar dan dikemas higienis. Aroma kuat, rasa khas, harga bersahabat.</p>
    </div>
</header>

<main class="wrap">
    <section id="produk">
        <h2>Produk Kami</h2>
        <div class="grid">
            @foreach ($produk as $nama => $p)
                <div class="card">
                    <div class="foto">☕<img src="{{ asset('images/' . $p['gambar']) }}" alt="{{ $nama }}" loading="lazy" onerror="this.remove()"></div>
                    <h3>{{ $nama }}</h3>
                    <div class="harga">Rp {{ number_format($p['harga'], 0, ',', '.') }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="pesan">
        <h2>Form Pemesanan</h2>

        @if (session('sukses'))
            <div class="ok">{{ session('sukses') }}</div>
        @endif
        @if ($errors->any())
            <div class="err">
                <ul style="margin:0;padding-left:18px">
                    @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('pesanan.store') }}">
            @csrf
            <label for="nama_pemesan">Nama Pemesan</label>
            <input type="text" id="nama_pemesan" name="nama_pemesan" value="{{ old('nama_pemesan') }}" required>

            <label for="produk">Produk</label>
            <select id="produk" name="produk" required>
                <option value="">-- Pilih produk --</option>
                @foreach ($produk as $nama => $p)
                    <option value="{{ $nama }}" @selected(old('produk') === $nama)>
                        {{ $nama }} - Rp {{ number_format($p['harga'], 0, ',', '.') }}
                    </option>
                @endforeach
            </select>

            <label for="jumlah">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" min="1" max="100" value="{{ old('jumlah', 1) }}" required>

            <label for="alamat_pengiriman">Alamat Pengiriman</label>
            <textarea id="alamat_pengiriman" name="alamat_pengiriman" rows="3" required>{{ old('alamat_pengiriman') }}</textarea>

            <button type="submit">Kirim Pesanan</button>
        </form>
    </section>

    <section id="pesanan">
        <h2>Riwayat Pesanan</h2>
        <div class="tabel" style="margin-top:16px">
            <table>
                <thead>
                <tr><th>#</th><th>Waktu</th><th>Nama</th><th>Produk</th><th>Jumlah</th><th>Alamat</th></tr>
                </thead>
                <tbody>
                @forelse ($pesanan as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $p->nama_pemesan }}</td>
                        <td>{{ $p->produk }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>{{ $p->alamat_pengiriman }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6">Belum ada pesanan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>

<footer>
    Nomor Kelompok: 5 | Anggota: Nayla Nur Fazrianti (241011700916),
    Novendra Eka Anggara (241011700427), Okta Firdaus (241011701428),
    Sarah Istikomah (241011700614)
</footer>
</body>
</html>
