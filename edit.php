<?php
include "koneksi.php";

if (isset($_GET['npm'])) {
    $npm = $_GET['npm'];
    $query = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa WHERE npm='$npm'");
    $data = mysqli_fetch_assoc($query);
} else {
    echo "<script>alert('NPM tidak ditemukan'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4faff;
        }

        form {
            width: 400px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.2);
        }

        td {
            padding: 10px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>

<body>

    <form action="" method="post">
        <h3 style="text-align: center;">Edit Data Mahasiswa</h3>
        <table>
            <tr>
                <td>NPM:</td>
                <td><input type="text" name="npm" value="<?= $data['npm'] ?>" readonly></td>
            </tr>
            <tr>
                <td>Nama:</td>
                <td><input type="text" name="nama" value="<?= $data['nama'] ?>" required></td>
            </tr>
            <tr>
                <td>Program Studi:</td>
                <td>
                    <select name="prodi" required>
                        <option value="">--Pilih Prodi--</option>
                        <?php
                        $prodi_list = ["Pendidikan Informatika", "Teknologi Informasi", "Sistem Informasi", "Teknik Komputer", "Teknik Informatika"];
                        foreach ($prodi_list as $p) {
                            $selected = ($p == $data['prodi']) ? "selected" : "";
                            echo "<option value='$p' $selected>$p</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" value="<?= $data['email'] ?>"></td>
            </tr>
            <tr>
                <td>Alamat:</td>
                <td><textarea name="alamat"><?= $data['alamat'] ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="update" value="Update Data"></td>
            </tr>
        </table>
    </form>

    <p style="text-align: center;"><a href="index.php">← Kembali ke Daftar Mahasiswa</a></p>

    <?php
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $prodi = $_POST['prodi'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];

        $update = mysqli_query($conn, "UPDATE tbl_mahasiswa SET 
        nama='$nama',
        prodi='$prodi',
        email='$email',
        alamat='$alamat' 
        WHERE npm='$npm'");

        if ($update) {
            echo "<script>alert('Data berhasil diperbarui'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Data gagal diperbarui');</script>";
        }
    }
    ?>

</body>

</html>