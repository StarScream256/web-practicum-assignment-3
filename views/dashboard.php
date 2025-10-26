<?php

require_once '../utils/json_loader.php';
require_once '../utils/util.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php require_once '../resources/cdnResources.php' ?>
</head>

<body class="bg-gray-100 text-gray-900 ubuntu-regular">

  <?php require_once '../components/header.php' ?>

  <div class="w-full h-fit min-h-screen p-3 md:p-8">
    <div class="p-4 bg-white rounded-lg shadow-lg">
      <span class="w-full h-fit flex justify-start mb-3">
        <a href="create.php" class="px-3.5 py-2 rounded-md bg-blue-500 text-white flex items-center gap-2">
          <span class="material-symbols-outlined">person_add</span>
          <p class="font-medium">Tambah data</p>
        </a>
      </span>

      <?php

      require_once '../controllers/applicantController.php';

      if (!index())
        echo "Error: Show query failed!";
      else {
        ?>

        <table id="applicant" class="display">
          <thead>
            <tr>
              <th class="text-center!">No</th>
              <th>Name</th>
              <th>Paket</th>
              <th>Total Biaya</th>
              <th class="text-center!">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $packageNames = array_column($data['packages'], 'name', 'id');
            $no = 0;
            $applicants = index();
            while ($row = mysqli_fetch_assoc($applicants)) {
              $no++;
              ?>
              <tr>
                <td class="text-center!"><?= $no ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $packageNames[$row['paket']] ?></td>
                <td data-order="<?= $row['total_biaya'] ?>"><?= formatPrice($row['total_biaya']) ?></td>
                <td>
                  <span class="w-full h-fit flex justify-center gap-2">
                    <a href="detail.php?id=<?= $row['id'] ?>" class="px-1 rounded-md text-blue-400 hover:text-blue-500">
                      <span class="material-symbols-outlined">visibility</span>
                    </a>
                    <a href="update.php?id=<?= $row['id'] ?>" class="px-1 rounded-md text-orange-400 hover:text-orange-500">
                      <span class="material-symbols-outlined">edit</span>
                    </a>
                    <button command="show-modal" commandfor="dialog-<?= $row['id'] ?>"
                      class="px-1 rounded-md text-red-400 hover:text-red-500">
                      <span class="material-symbols-outlined">delete</span>
                    </button>

                    <el-dialog>
                      <dialog id="dialog-<?= $row['id'] ?>" aria-labelledby="dialog-title"
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
                                  class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    data-slot="icon" aria-hidden="true" class="size-6 text-red-600">
                                    <path
                                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"
                                      stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                  <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Hapus pendaftar</h3>
                                  <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah anda yakin untuk menghapus data ini?
                                      Pendaftar <b class="underline text-black"><?= $row['nama'] ?></b> akan dihapus secara
                                      permanen.
                                      Aksi ini tidak
                                      dapat
                                      dikembalikan.
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                              <a href="../controllers/applicantController.php?action=delete&id=<?= $row['id'] ?>"
                                command="close" commandfor="dialog-<?= $row['id'] ?>"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-medium text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">Hapus
                                pendaftar</a>
                              <button type="button" command="close" commandfor="dialog-<?= $row['id'] ?>"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-gray-200 px-3 py-2 text-sm font-medium text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-300 sm:mt-0 sm:w-auto">Batal</button>
                            </div>
                          </el-dialog-panel>
                        </div>
                      </dialog>
                    </el-dialog>
                  </span>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>

      <?php } ?>

    </div>
  </div>

  <?php require_once '../components/footer.php' ?>

  <script>
    new DataTable("#applicant");


  </script>
</body>

</html>