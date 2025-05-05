<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Data Mahasiswa</title>
    <style>
        /* ... CSS Anda tetap ... */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color:#666;
            margin: 0;
            padding: 0;
        }

        h3 { text-align: center; color:black; margin-top: 30px; }
        p { text-align: center; color:black; }
        form { width: 400px; margin: 30px auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 0 15px rgba(80, 80, 80, 0.1); }
        table { width: 100%; }
        td { padding: 10px; }
        input[type="text"], input[type="email"], textarea, select {
            width: 100%; padding: 8px; border: 1px solid #bbb; border-radius: 6px; font-size: 14px; background-color:666; color:dimgray;
        }
        input[type="submit"], .cancel-btn {
            background-color: #666; color: white; border: none; padding: 10px 20px; font-size: 14px; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover, .cancel-btn:hover { background-color:dimgray }
        .button-group { display: flex; justify-content: center; gap: 10px; }
        a { background-color:dimgray; color: white; text-decoration: none; padding: 8px 16px; border-radius: 6px; transition: background-color 0.3s ease; }
        a:hover { background-color: #555; }
        .error { color: #d9534f; font-size: 12px; margin-top: 5px; }
        .error-border { border: 1px solid #d9534f !important; }
    </style>
</head>
<body>
    <h3>Entry Data Mahasiswa</h3>
    <p>Silakan masukkan data mahasiswa berdasarkan formulir berikut:</p>

    <form action="" method="post" id="formMahasiswa" onsubmit="return validateForm()">
        <table>
            <tr><td><label for="npm">NPM:</label></td>
                <td><input type="text" name="npm" id="npm" maxlength="12" required>
                    <div id="npmError" class="error"></div></td></tr>
            <tr><td><label for="nama">Nama:</label></td>
                <td><input type="text" name="nama" id="nama" required>
                    <div id="namaError" class="error"></div></td></tr>
            <tr><td><label for="prodi">Program Studi:</label></td>
                <td><select name="prodi" id="prodi" required>
                        <option value="">--Pilih Prodi--</option>
                        <option value="Pendidikan Informatika">Pendidikan Informatika</option>
                        <option value="Teknologi Informasi">Teknologi Informasi</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Komputer">Teknik Komputer</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                    </select>
                    <div id="prodiError" class="error"></div></td></tr>
            <tr><td><label for="email">Email:</label></td>
                <td><input type="email" name="email" id="email">
                    <div id="emailError" class="error"></div></td></tr>
            <tr><td><label for="alamat">Alamat:</label></td>
                <td><textarea name="alamat" id="alamat" rows="3"></textarea>
                    <div id="alamatError" class="error"></div></td></tr>
            <tr><td colspan="2">
                <div class="button-group">
                    <input type="submit" name="submit" value="Simpan Data">
                    <a href="index.php" class="cancel-btn">Batal</a>
                </div></td></tr>
        </table>
    </form>

    <p style="text-align: center; margin-top: 10px;">
        <a href="index.php">← Kembali ke Daftar Mahasiswa</a>
    </p>

    <script>
        function validateForm() {
            resetErrors();
            const npm = document.getElementById('npm').value.trim();
            const nama = document.getElementById('nama').value.trim();
            const prodi = document.getElementById('prodi').value;
            const email = document.getElementById('email').value.trim();
            let isValid = true;

            if (npm === '') {
                document.getElementById('npmError').textContent = 'NPM harus diisi';
                document.getElementById('npm').classList.add('error-border');
                isValid = false;
            } else if (!/^\d+$/.test(npm)) {
                document.getElementById('npmError').textContent = 'NPM harus berupa angka';
                document.getElementById('npm').classList.add('error-border');
                isValid = false;
            } else if (npm.length < 8 || npm.length > 12) {
                document.getElementById('npmError').textContent = 'NPM harus 8-12 digit';
                document.getElementById('npm').classList.add('error-border');
                isValid = false;
            }

            if (nama === '') {
                document.getElementById('namaError').textContent = 'Nama harus diisi';
                document.getElementById('nama').classList.add('error-border');
                isValid = false;
            } else if (nama.length < 3) {
                document.getElementById('namaError').textContent = 'Nama terlalu pendek';
                document.getElementById('nama').classList.add('error-border');
                isValid = false;
            }

            if (prodi === '') {
                document.getElementById('prodiError').textContent = 'Program studi harus dipilih';
                document.getElementById('prodi').classList.add('error-border');
                isValid = false;
            }

            if (email !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById('emailError').textContent = 'Email tidak valid';
                document.getElementById('email').classList.add('error-border');
                isValid = false;
            }

            return isValid;
        }

        function resetErrors() {
            const errorElements = document.querySelectorAll('.error');
            errorElements.forEach(e => e.textContent = '');
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(e => e.classList.remove('error-border'));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <?php
    if (isset($_POST['submit'])) {
        $npm = htmlspecialchars(strip_tags($_POST['npm']));
        $nama = htmlspecialchars(strip_tags($_POST['nama']));
        $prodi = htmlspecialchars(strip_tags($_POST['prodi']));
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $alamat = htmlspecialchars(strip_tags($_POST['alamat']));

        $errors = [];

        if (empty($npm)) $errors[] = "NPM harus diisi";
        elseif (!preg_match('/^\d+$/', $npm)) $errors[] = "NPM harus berupa angka";
        elseif (strlen($npm) < 8 || strlen($npm) > 12) $errors[] = "NPM harus 8-12 digit";

        if (empty($nama)) $errors[] = "Nama harus diisi";
        elseif (strlen($nama) < 3) $errors[] = "Nama terlalu pendek";

        if (empty($prodi)) $errors[] = "Program studi harus dipilih";

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email tidak valid";
        }

        if (empty($errors)) {
            include "koneksi.php";
            $check = $conn->prepare("SELECT npm FROM tbl_mahasiswa WHERE npm = ?");
            $check->bind_param("s", $npm);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                echo "<script>
                    Swal.fire({
                        title: 'Data gagal disimpan',
                        text: 'NPM sudah terdaftar',
                        icon: 'error',
                        didOpen: () => {
                            const modal = Swal.getPopup();
                            interact(modal).draggable({
                                listeners: {
                                    move (event) {
                                        const target = event.target;
                                        const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                                        const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
                                        target.style.transform = `translate(${x}px, ${y}px)`;
                                        target.setAttribute('data-x', x);
                                        target.setAttribute('data-y', y);
                                    }
                                }
                            });
                        }
                    });
                </script>";
            } else {
                $stmt = $conn->prepare("INSERT INTO tbl_mahasiswa (npm, nama, prodi, email, alamat) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $npm, $nama, $prodi, $email, $alamat);

                if ($stmt->execute()) {
                    echo "<script>
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil disimpan',
                            icon: 'success',
                            didOpen: () => {
                                const modal = Swal.getPopup();
                                interact(modal).draggable({
                                    listeners: {
                                        move (event) {
                                            const target = event.target;
                                            const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                                            const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
                                            target.style.transform = `translate(${x}px, ${y}px)`;
                                            target.setAttribute('data-x', x);
                                            target.setAttribute('data-y', y);
                                        }
                                    }
                                });
                            }
                        }).then(() => {
                            window.location.href = 'index.php';
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Gagal menyimpan',
                            text: '". addslashes($conn->error) ."',
                            icon: 'error',
                            didOpen: () => {
                                const modal = Swal.getPopup();
                                interact(modal).draggable({ listeners: { move (event) {
                                    const target = event.target;
                                    const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                                    const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
                                    target.style.transform = `translate(${x}px, ${y}px)`;
                                    target.setAttribute('data-x', x);
                                    target.setAttribute('data-y', y);
                                }}});
                            }
                        });
                    </script>";
                }

                $stmt->close();
            }

            $check->close();
            $conn->close();
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Validasi Gagal',
                    html: '". implode("<br>", array_map('addslashes', $errors)) ."',
                    icon: 'error',
                    didOpen: () => {
                        const modal = Swal.getPopup();
                        interact(modal).draggable({
                            listeners: {
                                move (event) {
                                    const target = event.target;
                                    const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                                    const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
                                    target.style.transform = `translate(${x}px, ${y}px)`;
                                    target.setAttribute('data-x', x);
                                    target.setAttribute('data-y', y);
                                }
                            }
                        });
                    }
                });
            </script>";
        }
    }
    ?>
</body>
</html>
