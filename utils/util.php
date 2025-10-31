<?php

function formatPrice(int $price, string $prefix = "", string $suffix = ""): string
{
  $displayPrefix = "";
  if ($prefix !== "") {
    $displayPrefix = $prefix . " ";
  }

  $formattedPrice = 0;
  if ($price > 0) {
    $formattedPrice = number_format($price, 0, ",", ".");
  }

  return $displayPrefix . "Rp " . $formattedPrice . $suffix;
}