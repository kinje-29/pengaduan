<?php
session_start();

// Menghasilkan bilangan acak 5 digit
$bilangan = rand(10000, 99999);

// Mendaftarkan variabel di dalam session
$_SESSION["bilangan"] = $bilangan;

// Memeriksa apakah GD library tersedia
if (function_exists('imagecreatetruecolor')) {
  // Membuat gambar captcha
  $gambar = imagecreatetruecolor(65, 30);
  $background = imagecolorallocate($gambar, 244, 67, 54); // Warna background
  $foreground = imagecolorallocate($gambar, 255, 255, 255); // Warna teks
  imagefill($gambar, 0, 0, $background);
  imagestring($gambar, 5, 10, 6, $bilangan, $foreground);

  // Menentukan header
  header("Cache-Control: no-cache, must-revalidate");
  header("Content-Type: images/png");

  // Output gambar
  imagepng($gambar);
  imagedestroy($gambar);
} else {
  echo "GD Library tidak tersedia. Aktifkan GD Library di server.";
}
