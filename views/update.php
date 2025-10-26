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
      <div class="flex flex-col justify-center w-full pb-3 border-b border-gray-300">
        <h3 class="text-3xl font-extrabold text-center">Bimbel Babarsari</h3>
        <p class="text-center text-gray-600">Form Update Data Pendaftaran Bimbingan Belajar</p>
      </div>

      <form action="../controllers/applicantController.php" method="post" id="updateForm"
        class="flex flex-col w-full gap-4">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <div class="flex flex-col md:flex-row w-full gap-3">
          <div class="flex flex-col gap-1 w-full">
            <label for="nameInput" class="font-semibold">Nama lengkap</label>
            <input type="text" name="name" required placeholder="Masukkan nama lengkap" id="nameInput"
              value="<?= $detail['nama']; ?>"
              class="block w-full rounded-md border border-gray-500 px-3 py-1.5 placeholder-gray-400" />
          </div>
          <div class="flex flex-col gap-1 w-full">
            <label for="emailInput" class="font-semibold">Email</label>
            <input type="email" name="email" required placeholder="Masukkan alamat email" id="emailInput"
              value="<?= $detail['email']; ?>"
              class=" block w-full rounded-md border border-gray-500 px-3 py-1.5 placeholder-gray-400" />
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
                  <input type="radio" name="packages" value="<?= $package['id']; ?>" id="<?= $package['id']; ?>"
                    class="hidden" <?= ($detail['paket'] == $package['id']) ? 'checked' : ''; ?> />
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
                    name="addons[]" value="<?= $addon['id']; ?>" id="<?= $addon['id']; ?>" <?= (in_array(
                          $addon['id'],
                          array_map('trim', explode(',', $detail['fasilitas']))
                        )) ? 'checked' : ''; ?> />
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
                  <option value="<?= $location['id']; ?>" <?= $detail['lokasi'] == $location['id'] ? 'selected' : '' ?>>
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
                  <option value="<?= $payment['id']; ?>" <?= $detail['metode_pembayaran'] == $payment['id'] ? 'selected' : '' ?>>
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
              placeholder="Write your additional note here" name="note"><?= $detail['catatan'] ?></textarea>
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
              class="border border-gray-500 px-3.5 py-2 rounded-md shadow-sm bg-gray-200 text-gray-800 hover:bg-gray-300">
              Reset perubahan
            </button>
            <button type="submit" id="submitUpdateBtn" disabled
              class="px-3.5 py-2 rounded-md shadow-sm bg-blue-600 disabled:bg-blue-200 text-white hover:bg-blue-700">
              Update data
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const form = document.getElementById("updateForm");
      const submitBtn = document.getElementById("submitUpdateBtn");

      function getFormData(form) {
        const data = {
          name: form.elements.name.value,
          email: form.elements.email.value,
          packages: form.elements.packages.value,
          locations: form.elements.locations.value,
          payments: form.elements.payments.value,
          note: form.elements.note.value,
          addons: Array.from(form.elements["addons[]"])
            .filter((cb) => cb.checked)
            .map((cb) => cb.value)
            .sort(),
        };
        return JSON.stringify(data);
      }

      const initialState = getFormData(form);

      const checkFormChanges = () => {
        const currentState = getFormData(form);

        if (currentState === initialState) {
          submitBtn.disabled = true;
        } else {
          submitBtn.disabled = false;
        }
      };

      checkFormChanges();

      form.addEventListener("input", checkFormChanges);
      form.addEventListener("change", checkFormChanges);
      form.addEventListener("reset", () => {
        setTimeout(checkFormChanges, 0);
      });
    });
  </script>
</body>

</html>