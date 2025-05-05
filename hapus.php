<?php
if (isset($_GET['npm'])) {
    include "koneksi.php";

    $npm = $_GET['npm'];

    // jalankan query hapus
    $hapus = mysqli_query($conn, "DELETE FROM tbl_mahasiswa WHERE npm='$npm'");

    if ($hapus) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('NPM tidak ditemukan'); window.location.href='index.php';</script>";
}
