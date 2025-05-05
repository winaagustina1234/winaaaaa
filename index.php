<!DOCTYPE html>
<html>

<head>
    <title>Daftar Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color:dimgray;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color:black;
            margin-top: 30px;
            font-size: 36px;
            font-weight: bold;
        }

        a.button {
            text-decoration: none;
            color: white;
            background-color:darkslategray;
            padding: 12px 20px;
            border-radius: 6px;
            transition: 0.3s ease;
            font-size: 16px;
            font-weight: bold;
        }

        a.button:hover {
            background-color:darkslategray;
        }

        .button-container {
            text-align: center;
            margin: 20px 0;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto 40px auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        th {
            background-color:darkslategray;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color:darkgray;
        }

        tr:hover {
            background-color: #e6f2ff;
        }

        .aksi a {
            margin: 0 5px;
            padding: 8px 12px;
            border-radius: 4px;
            color: white;
            font-size: 14px;
            font-weight: bold;
        }

        .edit {
            background-color:darkolivegreen;
        }

        .edit:hover {
            background-color:darkolivegreen;
        }

        .hapus {
            background-color:darkgoldenrod;
        }

        .hapus:hover {
            background-color:darkgoldenrod;
        }
    </style>
</head>

<body>

    <h2>Daftar Mahasiswa</h2>
    <div class="button-container">
        <a class="button" href="tambah.php">+ Tambah Data Mahasiswa</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php
        include "koneksi.php";
        $query = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa");
        $no = 1;

        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>
                    <td>$no</td>
                    <td>{$data['npm']}</td>
                    <td>{$data['nama']}</td>
                    <td>{$data['prodi']}</td>
                    <td>{$data['email']}</td>
                    <td>{$data['alamat']}</td>
                    <td class='aksi'>
                        <a class='edit' href='edit.php?npm={$data['npm']}'>Edit</a>
                        <a class='hapus' href='hapus.php?npm={$data['npm']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                    </td>
                  </tr>";
            $no++;
        }
        ?>
    </table>

</body>

</html>