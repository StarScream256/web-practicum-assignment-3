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
          <p>Tambah data</p>
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
                    <a href="../controllers/applicantController.php?action=delete&id=<?= $row['id'] ?>"
                      onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                      class="px-1 rounded-md text-red-400 hover:text-red-500">
                      <span class="material-symbols-outlined">delete</span>
                    </a>
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