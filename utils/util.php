<?php

function formatPrice(int $price, string $prefix = "", string $suffix = ""): string
{
  if ($price <= 0) {
    return '';
  }

  $displayPrefix = "";
  if ($prefix !== "") {
    $displayPrefix = $prefix . " ";
  }

  $formattedPrice = number_format($price, 0, ",", ".");

  return $displayPrefix . "Rp " . $formattedPrice . $suffix;
}