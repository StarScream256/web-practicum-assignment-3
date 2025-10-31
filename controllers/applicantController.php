<?php

require_once '../config/app.php';
require_once '../config/connection.php';
require_once '../utils/json_loader.php';
require_once '../utils/util.php';

function index()
{
  global $conn;
  $query = "SELECT * FROM pendaftar";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
    return false;
  }
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  mysqli_stmt_close($stmt);
  return $result;
}

function create($name, $email, $package, $addons, $location, $payment, $note)
{
  global $conn, $data;

  $package = isset($package) && !empty($package)
    ? array_values(
      array_filter(
        $data['packages'],
        fn($pkg) => $pkg['id'] === $package
      )
    )[0]
    : $package = [
      'id' => 'undefined',
      'name' => 'Undefined',
      'price' => 0
    ];

  $location = array_values(
    array_filter(
      $data['locations'],
      fn($loc) => $loc['id'] === $location
    )
  )[0];

  $addons = $addons
    ? array_filter(
      $data['addons'],
      function ($addon) use ($addons) {
        return in_array($addon['id'], $addons);
      }
    )
    : [];

  $addonPrice = 0;
  foreach ($addons as $ad) {
    $addonPrice += $ad['price'];
  }

  $payment = array_values(
    array_filter(
      $data['payments'],
      fn($pmt) => $pmt['id'] === $payment
    )
  )[0];

  $totalPrice = $package['name'] !== 'Undefined'
    ? $package['price'] + $location['price'] + $addonPrice
    : 0;
  $tax_rate = $package['name'] !== 'Undefined' ? 10 : 0;
  $tax_amount = $totalPrice * $tax_rate / 100;
  $totalPrice += $package['name'] !== 'Undefined'
    ? $tax_amount + $payment['price']
    : 0;

  $addonString = implode(
    ', ',
    array_map(
      fn($ad) => $ad['id'],
      $addons
    )
  );
  $price1 = $package['price'];
  $price2 = $addonPrice;
  $price3 = $location['price'];
  $price4 = $payment['price'];
  $location = $location['id'];
  $payment = $payment['id'];
  $package = $package['id'];

  $query = "INSERT INTO pendaftar (
      nama, email, paket, fasilitas, 
      lokasi, metode_pembayaran, catatan, 
      price1, price2, price3, price4, 
      tax, taxes, total_biaya
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
    echo mysqli_error($conn);
    return;
  }

  mysqli_stmt_bind_param(
    $stmt,
    'sssssssiiiiiii',
    $name,
    $email,
    $package,
    $addonString,
    $location,
    $payment,
    $note,
    $price1,
    $price2,
    $price3,
    $price4,
    $tax_rate,
    $tax_amount,
    $totalPrice
  );

  $result = mysqli_stmt_execute($stmt);
  if ($result) {
    mysqli_stmt_close($stmt);
    header("Location: ../views/dashboard.php");
    return;
  } else {
    echo mysqli_error($conn);
    mysqli_stmt_close($stmt);
    return;
  }
}

function detail($id)
{
  global $conn;
  $query = "SELECT * FROM pendaftar WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
    return false;
  }
  mysqli_stmt_bind_param($stmt, 'i', $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  mysqli_stmt_close($stmt);
  return $result;
}

function update($id, $name, $email, $package, $addons, $location, $payment, $note)
{
  global $conn, $data;

  $package = isset($package) && !empty($package)
    ? array_values(
      array_filter(
        $data['packages'],
        fn($pkg) => $pkg['id'] === $package
      )
    )[0]
    : $package = [
      'id' => 'undefined',
      'name' => 'Undefined',
      'price' => 0
    ];

  $location = array_values(
    array_filter(
      $data['locations'],
      fn($loc) => $loc['id'] === $location
    )
  )[0];

  $addons = $addons
    ? array_filter(
      $data['addons'],
      function ($addon) use ($addons) {
        return in_array($addon['id'], $addons);
      }
    )
    : [];

  $addonPrice = 0;
  foreach ($addons as $ad) {
    $addonPrice += $ad['price'];
  }

  $payment = array_values(
    array_filter(
      $data['payments'],
      fn($pmt) => $pmt['id'] === $payment
    )
  )[0];

  $totalPrice = $package['price'] + $location['price'] + $addonPrice;
  $tax_rate = $package['name'] !== 'Undefined' ? 10 : 0;
  $tax_amount = $totalPrice * $tax_rate / 100;
  $totalPrice += $tax_amount + $payment['price'];

  $addonString = implode(
    ', ',
    array_map(
      fn($ad) => $ad['id'],
      $addons
    )
  );
  $price1 = $package['price'];
  $price2 = $addonPrice;
  $price3 = $location['price'];
  $price4 = $payment['price'];
  $location = $location['id'];
  $payment = $payment['id'];
  $package = $package['id'];

  $query = "UPDATE pendaftar SET 
      nama=?, 
      email=?, 
      paket=?, 
      fasilitas=?,
      lokasi=?, 
      metode_pembayaran=?, 
      catatan=?,
      price1=?, 
      price2=?, 
      price3=?, 
      price4=?,
      tax=?, 
      taxes=?, 
      total_biaya=?
    WHERE id=?";

  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
    echo mysqli_error($conn);
    return;
  }

  mysqli_stmt_bind_param(
    $stmt,
    'sssssssiiiiiiii',
    $name,
    $email,
    $package,
    $addonString,
    $location,
    $payment,
    $note,
    $price1,
    $price2,
    $price3,
    $price4,
    $tax_rate,
    $tax_amount,
    $totalPrice,
    $id
  );

  $result = mysqli_stmt_execute($stmt);
  if ($result) {
    mysqli_stmt_close($stmt);
    header("Location: ../views/dashboard.php");
    return;
  } else {
    echo mysqli_error($conn);
    mysqli_stmt_close($stmt);
    return;
  }
}

function delete($id)
{
  global $conn;

  $query = "DELETE FROM pendaftar WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);

  mysqli_stmt_bind_param($stmt, "i", $id);

  mysqli_stmt_execute($stmt);

  header("Location: ../views/dashboard.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';

  switch ($_POST['action']) {
    case 'create':
      create($_POST['name'], $_POST['email'], $_POST['packages'], $_POST['addons'], $_POST['locations'], $_POST['payments'], $_POST['note']);
      break;
    case 'update':
      update($_POST['id'], $_POST['name'], $_POST['email'], $_POST['packages'], $_POST['addons'], $_POST['locations'], $_POST['payments'], $_POST['note']);
      break;
  }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $action = $_GET['action'] ?? '';

  switch ($action) {
    case 'delete':
      if (isset($_GET['id'])) {
        delete($_GET['id']);
      }
      break;
  }
}