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
?>

<body class="bg-gray-100 text-gray-900 ubuntu-regular">
  <div class="mx-auto p-3 md:p-8 flex justify-center">
    <div class="flex flex-col w-full gap-3 p-6 rounded-lg bg-white shadow-sm">
      <div class="flex flex-col justify-center w-full pb-3 border-b border-gray-300">
        <h3 class="text-3xl font-extrabold text-center">Bimbel Babarsari</h3>
        <p class="text-center text-gray-600">Form Tambah Data Pendaftaran Bimbingan Belajar</p>
      </div>

      <form action="../controllers/applicantController.php" method="post" id="registrationForm"
        class="flex flex-col w-full gap-4">
        <input type="hidden" name="action" value="create">
        <div class="flex flex-col md:flex-row w-full gap-3">
          <div class="flex flex-col gap-1 w-full">
            <label for="nameInput" class="font-semibold">Nama lengkap</label>
            <input type="text" name="name" required placeholder="Masukkan nama lengkap" id="nameInput"
              class="block w-full rounded-md border border-gray-500 px-3 py-1.5 placeholder-gray-400" />
          </div>
          <div class="flex flex-col gap-1 w-full">
            <label for="emailInput" class="font-semibold">Email</label>
            <input type="email" name="email" required placeholder="Masukkan alamat email" id="emailInput"
              class="block w-full rounded-md border border-gray-500 px-3 py-1.5 placeholder-gray-400" />
          </div>
        </div>

        <div class="flex flex-col gap-2">
          <div class="">
            <p class="font-semibold">Paket bimbingan</p>
            <p class="text-gray-500">
              Pilih paket bimbingan yang cocok untukmu
            </p>
          </div>
          <div class="flex flex-col lg:flex-row gap-3.5 w-full justify-between">
            <?php
            foreach ($data['packages'] as $package) {
              if ($package['id'] != 'undefined') {
                ?>
                <label for="<?php echo $package['id']; ?>"
                  class="pricing-card flex flex-col gap-2 w-full border border-black p-3.5 rounded-lg cursor-pointer">
                  <input type="radio" name="packages" value="<?php echo $package['id']; ?>"
                    id="<?php echo $package['id']; ?>" class="hidden" />
                  <div class="flex justify-between items-start">
                    <span
                      class="w-fit h-fit p-1 rounded-md <?php echo $package['iconBg']; ?> flex items-center justify-center">
                      <span style="font-size: xx-large;" class="material-symbols-outlined  text-white">
                        <?php echo $package['iconName']; ?>
                      </span>
                    </span>
                    <?php if ($package['tag'] !== "") { ?>
                      <span class="w-fit text-sm px-3 py-1 rounded-full <?php echo $package['tagBg']; ?>">
                        <?php echo $package['tag']; ?>
                      </span>
                    <?php } ?>
                  </div>
                  <span class="">
                    <p class="card-title text-xl font-semibold"><?php echo $package['name']; ?></p>
                    <p class="text-gray-500">
                      <?php echo $package['description']; ?>
                    </p>
                  </span>
                  <span class="flex gap-2 items-end">
                    <span>
                      <?php if ($package['originalPrice'] != $package['price'])
                        echo '<p class="text-gray-500 discounted-price">' . formatPrice($package['originalPrice']) . '</p>'; ?>
                      <p class="font-bold text-3xl"><?php echo formatPrice($package['price']); ?></p>
                    </span>
                    <p class="pb-2">/bulan</p>
                  </span>
                </label>
                <?php
              }
            }
            ?>
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-3">
          <div class="flex flex-col gap-2 w-full">
            <div class="">
              <p class="font-semibold">Fasilitas tambahan</p>
              <p class="text-gray-500">
                Pilih fasilitas tambahan yang cocok untukmu
              </p>
            </div>
            <div class="flex flex-col gap-1">
              <?php foreach ($data['addons'] as $addon) { ?>
                <div class="flex items-center gap-2">
                  <input class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" type="checkbox"
                    name="addons[]" value="<?php echo $addon['id']; ?>" id="<?php echo $addon['id']; ?>" />
                  <label class="w-fit flex flex-row gap-2" for="<?php echo $addon['id']; ?>">
                    <p class="font-medium"><?php echo $addon['name']; ?></p>
                    <p class="text-gray-500"><?php echo formatPrice($addon['price'], "+"); ?></p>
                  </label>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="flex flex-col gap-3 w-full">
            <div class="flex flex-col gap-2 w-full">
              <div class="">
                <p class="font-semibold">Lokasi cabang</p>
                <p class="text-gray-500">
                  Pilih lokasi cabang sesuai domisili kamu
                </p>
              </div>
              <select required
                class="block w-full rounded-md border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                aria-label="Default select example" name="locations">
                <?php foreach ($data['locations'] as $location) { ?>
                  <option value="<?php echo $location['id']; ?>">
                    <?php echo $location['name'] . formatPrice($location['price'], "( +", ")"); ?>
                  </option>
                <?php } ?>
              </select>
            </div>

            <div class="flex flex-col gap-2 w-full">
              <p class="font-semibold">Metode pembayaran</p>
              <select required
                class="block w-full rounded-md border-gray-300 py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                aria-label="Default select example" name="payments">
                <?php foreach ($data['payments'] as $payment) { ?>
                  <option value="<?php echo $payment['id']; ?>">
                    <?php echo $payment['name'] . formatPrice($payment['price'], $payment['price'] > 0 ? " (+ " : "", $payment['price'] > 0 ? ")" : ""); ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="flex flex-col gap-2 w-full">
          <p class="font-semibold">Catatan tambahan</p>
          <div class="">
            <textarea
              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 h-24 p-2 placeholder-gray-400"
              placeholder="Write your additional note here" name="note"></textarea>
          </div>
        </div>

        <div class="flex flex-row gap-3 w-full justify-between">
          <a href="dashboard.php" class="px-3.5 py-2 rounded-md shadow-sm bg-gray-200 text-gray-800 hover:bg-gray-300">
            Kembali ke dashboard
          </a>
          <div class="w-fit h-fit flex gap-3">
            <button type="reset" class="px-3.5 py-2 rounded-md shadow-sm bg-gray-200 text-gray-800 hover:bg-gray-300">
              Kosongkan formulir
            </button>
            <button type="submit" class="px-3.5 py-2 rounded-md shadow-sm bg-blue-600 text-white hover:bg-blue-700">
              Tambahkan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    // js
  </script>
  <script src="../resources/main.js"></script>
</body>

</html>