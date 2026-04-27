<?php
$img = file_get_contents('https://smpn1singosari.sch.id/wp-content/uploads/2021/04/Logo-Tut-Wuri-Handayani-PNG-Warna.png');
if ($img) {
    if (!is_dir('public/images')) {
        mkdir('public/images', 0777, true);
    }
    file_put_contents('public/images/logo.png', $img);
    echo "Success";
} else {
    echo "Failed";
}
