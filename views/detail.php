<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bimbel Babarsari | Tambah</title>
  <?php require_once '../resources/cdnResources.php' ?>
</head>

<?php
require_once '../utils/json_loader.php';
require_once '../utils/util.php';
require_once '../controllers/applicantController.php';
$detail = mysqli_fetch_assoc(detail($_GET['id']));
?>

<body class="bg-gray-100 text-gray-900 ubuntu-regular">
  <div class="mx-auto p-3 md:p-8 flex justify-center">
    <div class="flex flex-col w-full gap-3 p-6 rounded-lg bg-white shadow-sm">
      <div class="flex flex-col justify-center w-full pb-3 border-b border-gray-200">
        <h3 class="text-2xl font-extrabold text-center">Bimbel Babarsari</h3>
        <p class="text-center text-gray-600">Data Pendaftaran Bimbingan Belajar</p>
      </div>
      <div class="flex flex-col justify-center items-center gap-2 w-full p-3 rounded-md border border-gray-800">
        <div class="w-full">
          <div class="flex py-2 border-b border-gray-800">
            <div class="w-1/4 font-semibold">Nama</div>
            <div class="w-3/4"><?= $detail['nama']; ?></div>
          </div>
          <div class="flex py-2 border-b border-gray-800">
            <div class="w-1/4 font-semibold">Email</div>
            <div class="w-3/4"><?= $detail['email']; ?></div>
          </div>
          <div class="flex py-2 border-b border-gray-800">
            <div class="w-1/4 font-semibold">Paket bimbel</div>
            <div class="w-3/4">
              <?= $detail['paket'] != "undefined" ? "Paket " . array_values(
                array_filter(
                  $data['packages'],
                  fn($pkg) => $pkg['id'] === $detail['paket']
                )
              )[0]['name'] : "Undefined"; ?>
            </div>
          </div>
          <div class="flex py-2 border-b border-gray-800">
            <div class="w-1/4 font-semibold">Lokasi belajar</div>
            <div class="w-3/4"><?= array_values(
              array_filter(
                $data['locations'],
                fn($loc) => $loc['id'] === $detail['lokasi']
              )
            )[0]['name']; ?></div>
          </div>
          <div class="flex py-2 border-b border-gray-800">
            <div class="w-1/4 font-semibold">Fasilitas tambahan</div>
            <div class="w-3/4">
              <?php
              $addons = array_values(
                array_filter(
                  $data['addons'],
                  fn($add) => in_array($add['id'], array_map('trim', explode(',', $detail['fasilitas'])))
                )
              );

              $addonNames = array_map(fn($add) => $add['name'], $addons);
              echo implode(', ', $addonNames);
              ?>
            </div>
          </div>
          <div class="flex py-2 border-b border-gray-800">
            <div class="w-1/4 font-semibold">Pajak</div>
            <div class="w-3/4"><?= $detail['paket'] !== 'undefined' ? "10%" : "0%"; ?></div>
          </div>
          <div class="flex py-2 border-b border-gray-800">
            <div class="w-1/4 font-semibold">Catatan</div>
            <div class="w-3/4"><?= $detail['catatan'] != "" ? $detail['catatan'] : "-"; ?></div>
          </div>
          <div class="flex py-2 border-b border-gray-800">
            <div class="w-1/4 font-semibold">Metode pembayaran</div>
            <div class="w-3/4"><?= array_values(
              array_filter(
                $data['payments'],
                fn($pmt) => $pmt['id'] === $detail['metode_pembayaran']
              )
            )[0]['name'] ?></div>
          </div>
          <?php if ($detail['paket'] !== "undefined") { ?>
            <div class="flex py-2">
              <div class="w-1/4 font-semibold">Total harga</div>
              <div class="w-3/4 flex flex-col gap-2">
                <div class="flex px-2 py-1 rounded-md border border-gray-800">
                  <div class="w-1/2 font-medium">Paket</div>
                  <div class="w-1/2 text-right"><?= formatPrice($detail['price1']); ?></div>
                </div>
                <div class="flex px-2 py-1 rounded-md border border-gray-800">
                  <div class="w-1/2 font-medium">Lokasi belajar</div>
                  <div class="w-1/2 text-right"><?= formatPrice($detail['price3']); ?></div>
                </div>
                <div class="flex px-2 py-1 rounded-md border border-gray-800">
                  <div class="w-1/2 font-medium">Fasilitas tambahan</div>
                  <div class="w-1/2 text-right"><?= formatPrice($detail['price2']); ?></div>
                </div>
                <div class="flex px-2 py-1 rounded-md border border-gray-800">
                  <div class="w-1/2 font-medium">Pajak</div>
                  <div class="w-1/2 text-right"><?= formatPrice($detail['taxes']); ?></div>
                </div>
                <div class="flex px-2 py-1 rounded-md border border-gray-800">
                  <div class="w-1/2 font-medium">Biaya layanan</div>
                  <div class="w-1/2 text-right"><?= formatPrice($detail['price4']); ?></div>
                </div>
                <div class="flex px-2 py-1 rounded-md border border-gray-800">
                  <div class="w-1/2 font-medium">Total biaya</div>
                  <div class="w-full text-right font-bold text-2xl"><?= formatPrice($detail['total_biaya']); ?></div>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <span class="w-fit h-fit flex gap-2 mt-3 bg-red-200 border border-red-500 px-3 py-2 rounded-md">
              <span class="material-symbols-outlined">warning</span>
              <p class="">Paket belum dipilih, harga tidak dihitung</p>
            </span>
          <?php } ?>
        </div>
      </div>
      <div class="flex flex-row gap-3 w-full justify-center lg:justify-start">
        <a href="dashboard.php"
          class="flex gap-2 border border-gray-500 items-center px-3.5 py-2 rounded-md shadow-sm bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium">
          <span class="material-symbols-outlined">arrow_back</span>
          <p>Kembali ke dashboard</p>
        </a>
      </div>
    </div>
  </div>

  <script src="main.js"></script>
</body>

</html>