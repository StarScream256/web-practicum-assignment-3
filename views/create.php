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

      <form action="../controllers/applicantController.php" method="post" id="createForm"
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
                <label for="<?= $package['id']; ?>"
                  class="pricing-card flex flex-col gap-2 w-full border border-black p-3.5 rounded-lg cursor-pointer">
                  <input type="radio" name="packages" value="<?= $package['id']; ?>" id="<?= $package['id']; ?>" onchange="
                      document.getElementById('selectedPackage').innerHTML = '<?= $package['name'] ?>';
                    " class="hidden" />
                  <div class="flex justify-between items-start">
                    <span class="w-fit h-fit p-1 rounded-md <?= $package['iconBg']; ?> flex items-center justify-center">
                      <span style="font-size: xx-large;" class="material-symbols-outlined  text-white">
                        <?= $package['iconName']; ?>
                      </span>
                    </span>
                    <?php if ($package['tag'] !== "") { ?>
                      <span class="w-fit text-sm px-3 py-1 rounded-full <?= $package['tagBg']; ?>">
                        <?= $package['tag']; ?>
                      </span>
                    <?php } ?>
                  </div>
                  <span class="">
                    <p class="card-title text-xl font-semibold"><?= $package['name']; ?></p>
                    <p class="text-gray-500">
                      <?= $package['description']; ?>
                    </p>
                  </span>
                  <span class="flex gap-2 items-end">
                    <span>
                      <?php if ($package['originalPrice'] != $package['price'])
                        echo '<p class="text-gray-500 discounted-price">' . formatPrice($package['originalPrice']) . '</p>'; ?>
                      <p class="font-bold text-3xl"><?= formatPrice($package['price']); ?></p>
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
                    name="addons[]" value="<?= $addon['id']; ?>" id="<?= $addon['id']; ?>" />
                  <label class="w-fit flex flex-row gap-2" for="<?= $addon['id']; ?>">
                    <p class="font-medium"><?= $addon['name']; ?></p>
                    <p class="text-gray-500"><?= formatPrice($addon['price'], "+"); ?></p>
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
                  <option value="<?= $location['id']; ?>">
                    <?= $location['name'] . formatPrice($location['price'], "( +", ")"); ?>
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
                  <option value="<?= $payment['id']; ?>">
                    <?= $payment['name'] . formatPrice($payment['price'], $payment['price'] > 0 ? " (+ " : "", $payment['price'] > 0 ? ")" : ""); ?>
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
          <a href="dashboard.php"
            class="flex gap-2 border border-gray-500 items-center px-3.5 py-2 rounded-md shadow-sm bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium">
            <span class="material-symbols-outlined">arrow_back</span>
            <p>Kembali ke dashboard</p>
          </a>
          <div class="w-fit h-fit flex gap-3">
            <button type="reset"
              class="border border-gray-500 px-3.5 py-2 rounded-md shadow-sm bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium">
              Kosongkan formulir
            </button>
            <button id="shadowSubmitCreate" type="button" onclick="
                document.getElementById('createForm').checkValidity()
                  ? document.getElementById('triggerModalCreate').click()
                  : document.getElementById('createSubmit').click();
              " class="px-3.5 py-2 rounded-md shadow-sm bg-blue-600 text-white hover:bg-blue-700 font-medium">
              Tambahkan
            </button>
            <button id="triggerModalCreate" type="button" command="show-modal" commandfor="confirm-submit"
              class="hidden"></button>

            <el-dialog>
              <dialog id="confirm-submit" aria-labelledby="dialog-title"
                class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
                <el-dialog-backdrop
                  class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

                <div tabindex="0"
                  class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
                  <el-dialog-panel
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                      <div class="sm:flex sm:items-start">
                        <div
                          class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:size-10">
                          <span class="material-symbols-outlined">
                            check_circle
                          </span>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                          <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Konfirmasi tambah data
                          </h3>
                          <div class="mt-2">
                            <p class="text-sm text-gray-500">
                              Anda memilih paket bimbel:
                              <b id="selectedPackage" class="underline text-black"></b>.
                              Apakah anda ingin melanjutkan?
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                      <button id="createSubmit" type="submit" command="close" commandfor="confirm-submit"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-medium text-white shadow-xs hover:bg-blue-500 sm:ml-3 sm:w-auto">
                        Ya, tambahkan
                      </button>
                      <button type="button" command="close" commandfor="confirm-submit"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-gray-200 px-3 py-2 text-sm font-medium text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-300 sm:mt-0 sm:w-auto">Batal</button>
                    </div>
                  </el-dialog-panel>
                </div>
              </dialog>
            </el-dialog>
          </div>
        </div>
      </form>
    </div>
  </div>

</body>

</html>