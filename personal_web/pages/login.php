<?php
// =============================================
// pages/login.php - HALAMAN LOGIN
// =============================================

// Kalau sudah login, redirect ke home
if (isLogin()) {
    header("Location: index.php?page=home");
    exit;
}

$error = '';

// Proses form login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean($conn, $_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Username dan password wajib diisi!";
    } else {
        // Cari user di database
        // PENTING: Gunakan MD5 sesuai cara kita menyimpan password di SQL
        $pwd_md5 = MD5($password);
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$pwd_md5' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Login berhasil! Simpan data user ke session
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $user;

            // Redirect ke home
            header("Location: index.php?page=home");
            exit;
        } else {
            $error = "Username atau password salah!";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0"><i class="bi bi-shield-lock"></i> Login</h4>
                <small>Masuk untuk mengakses fitur CRUD</small>
            </div>
            <div class="card-body p-4">

                <!-- Tampilkan error kalau ada -->
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-x-circle"></i> <?= $error ?>
                    </div>
                <?php endif; ?>

                <!-- Form Login -->
                <form method="POST" action="index.php?page=login">

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-person"></i> Username
                        </label>
                        <input type="text"
                               name="username"
                               class="form-control form-control-lg"
                               placeholder="Masukkan username"
                               value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="bi bi-lock"></i> Password
                        </label>
                        <div class="input-group">
                            <input type="password"
                                   name="password"
                                   id="passwordInput"
                                   class="form-control form-control-lg"
                                   placeholder="Masukkan password"
                                   required>
                            <!-- Tombol show/hide password -->
                            <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePassword()">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>

                </form>

            </div>

            <!-- Info akun default -->
            <div class="card-footer bg-light">
                <div class="alert alert-info mb-0 small">
                    <i class="bi bi-info-circle"></i>
                    <strong>Akun Default:</strong><br>
                    Username: <code>sofy</code> | Password: <code>sofyimup99</code>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
// Fungsi show/hide password
function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
