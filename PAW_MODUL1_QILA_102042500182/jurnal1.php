<?php
    const BATAS_DISKON = 1000000;
    const PERSEN_DISKON = 10;

$produk = [
    ["nama" => "Laptop Nimbus 14",     "kategori" => "Laptop",      "harga" => 875000,  "stok" => 5],
    ["nama" => "Smartphone Astra X2",  "kategori" => "Smartphone",  "harga" => 3200000, "stok" => 12],
    ["nama" => "Headphone Wireless Echo", "kategori" => "Audio",    "harga" => 850000,  "stok" => 20],
    ["nama" => "Mouse Gaming Vector",   "kategori" => "Aksesoris",  "harga" => 275000,  "stok" => 0],
    ["nama" => "Keyboard Mekanik",      "kategori" => "Aksesoris",  "harga" => 1150000, "stok" => 7],
    ["nama" => "Power Bank 20.000 mAh", "kategori" => "Aksesoris",  "harga" => 349000,  "stok" => 34],
    ["nama" => "Smartwatch Pulse 5",    "kategori" => "Wearable",   "harga" => 1899000, "stok" => 0],
    ["nama" => "Speaker Bluetooth Boom", "kategori" => "Audio",     "harga" => 999000,  "stok" => 3],
];

function formatRupiah($angka)
{ 
    return "Rp"  . number_format($angka, 0, ",", ".");
}

function hitungHargaDiskon($harga, $persen)
{
    $potongan =$harga * $persen / 100;
    return $harga - $potongan;
}

$totalProduk = count($produk);

$totalTersedia = 0;
foreach ($produk as $p) {
    if ($p["stok"] > 0) {
        $totalTersedia++;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <title>Cia Store - Katalog Produk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts,gstatic.com" crssorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

 <header class="navbar">
    <div class="container navbar__inner">
        <a href="#" class="brand">Cia<span>Store</span></a>
        <nav class="menu">
            <a href="#beranda">Beranda</a>
            <a href="katalog">Katalog</a>
            <a hrf="#kontak">Kontak</a>
        </nav>
    </div>
</header>

    <section class="hero" id="beranda">
        <div class="container hero__inner">
            <h1>Perangkat dan aksesoris teknologi, langsung dari rak Cia.</h1>
            <p>
                Cek stok terkini setiap produk. Produk dengan harga
                <?= formatRupiah(BATAS_DISKON) ?> atau lebih dapat diskon
                <?= PERSEN_DISKON ?>%.
            </p>
            <a href="#katalog" class="btn btn--primary">Lihat katalog</a>
        </div>
    </section>

    <section class="info container">
        <div class="info__item">
            <strong><?= $totalProduk ?></strong>
            <span>Total produk</span>
        </div>
        <div class="info__item">
            <strong><?= $totalTersedia ?></strong>
            <span>Produk tersedia</span>
        </div>
        <div class="info__item">
            <strong><?= $totalProduk - $totalTersedia ?></strong>
            <span>Stok habis</span>
        </div>
    </section>

    <main class="container" id="katalog">
        <h2 class="section-title">Katalog produk</h2>

        <div class="grid">
            <?php foreach ($produk as $item): ?>

                <?php
                $tersedia = $item["stok"] > 0;

                $dapatDiskon = $item["harga"] >= BATAS_DISKON;

                if ($dapatDiskon) {
                    $hargaAkhir = hitungHargaDiskon($item["harga"], PERSEN_DISKON);
                }
                ?>

                <article class="card <?= $tersedia ? '' : 'card--habis' ?>">

                    <div class="card__top">
                        <span class="kategori"><?= htmlspecialchars($item["kategori"]) ?></span>
                        <?php if ($dapatDiskon): ?>
                            <span class="badge badge--diskon">-<?= PERSEN_DISKON ?>%</span>
                        <?php endif; ?>
                    </div>

                    <h3 class="card__nama"><?= htmlspecialchars($item["nama"]) ?></h3>

                    <div class="harga">
                        <?php if ($dapatDiskon): ?>
                            <span class="harga__normal"><?= formatRupiah($item["harga"]) ?></span>
                            <span class="harga__akhir"><?= formatRupiah($hargaAkhir) ?></span>
                        <?php else: ?>
                            <span class="harga__akhir"><?= formatRupiah($item["harga"]) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="stok">
                        <span>Stok: <?= $item["stok"] ?></span>
                        <?php if ($tersedia): ?>
                            <span class="badge badge--tersedia">Tersedia</span>
                        <?php else: ?>
                            <span class="badge badge--habis">Stok Habis</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($tersedia): ?>
                        <a href="#" class="btn btn--primary btn--full">Beli Sekarang</a>
                    <?php else: ?>
                        <button class="btn btn--disabled btn--full" disabled>Tidak Tersedia</button>
                    <?php endif; ?>

                </article>

            <?php endforeach; ?>
        </div>
    </main>

    <footer class="footer" id="kontak">
        <div class="container footer__inner">
            <p><strong>Cia Store</strong>.</p>
            <p>&copy; <?= date("Y") ?>.</p>
        </div>
    </footer>

</body>
</html>


    
   