<?php

require_once dirname(__DIR__) . '/config/bootstrap.php';

if (isLoggedIn()) {
    redirect('../dashboard/index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("
        SELECT *
        FROM users
        WHERE email = ?
        AND status = 1
        LIMIT 1
    ");

    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        regenerateSession();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['company_id'] = $user['company_id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_name'] = $user['name'];

        $update = $pdo->prepare("
            UPDATE users
            SET last_login = NOW()
            WHERE id = ?
        ");

        $update->execute([$user['id']]);

        redirect('../dashboard/index.php');

    } else {

        $error = 'E-posta veya şifre hatalı.';
    }
}

require_once '../templates/header.php';
?>





<?php
require_once '../templates/header.php';
?>

<div class="login-page">

    <div class="container">

        <div class="login-glass-card">

            <div class="row align-items-center g-5">

                <!-- SOL TARAF -->

                <div class="col-lg-7">

                    <div class="hero-section">

                        <div class="brand">

                            <div class="brand-logo">
                                <i class="bi bi-tools"></i>
                                UstaAsistan
                            </div>

                            <h1>
                                İşlerini değil,<br>
                                işini yönet.
                            </h1>

                            <p class="hero-text">
                                Müşterilerini takip et, işlerini planla,
                                tahsilatlarını unutma ve yapay zekanın
                                önerileriyle işletmeni daha verimli yönet.
                            </p>

                        </div>

                        <!-- DASHBOARD ÖNİZLEME -->

                        <div class="dashboard-preview">

                            <div class="preview-header">

                                <span>
                                    📊 Bugünkü Durum
                                </span>

                            </div>

                            <div class="row g-3">

                                <div class="col-6 col-md-3">

                                    <div class="mini-card">

                                        <div class="mini-icon">
                                            👥
                                        </div>

                                        <h3>124</h3>

                                        <small>
                                            Aktif Müşteri
                                        </small>

                                    </div>

                                </div>

                                <div class="col-6 col-md-3">

                                    <div class="mini-card">

                                        <div class="mini-icon">
                                            📋
                                        </div>

                                        <h3>32</h3>

                                        <small>
                                            Açık İş
                                        </small>

                                    </div>

                                </div>

                                <div class="col-6 col-md-3">

                                    <div class="mini-card">

                                        <div class="mini-icon">
                                            💰
                                        </div>

                                        <h3>8</h3>

                                        <small>
                                            Tahsilat
                                        </small>

                                    </div>

                                </div>

                                <div class="col-6 col-md-3">

                                    <div class="mini-card">

                                        <div class="mini-icon">
                                            🏦
                                        </div>

                                        <h3>45K</h3>

                                        <small>
                                            Kasa
                                        </small>

                                    </div>

                                </div>

                            </div>

                            <!-- AI -->

                            <div class="ai-box">

                                <div class="ai-title">

                                    🤖 Yapay Zeka Analizi

                                </div>

                                <div class="ai-content">

                                    Son 7 gün içerisinde
                                    <strong>3 müşterinin ödeme tarihi geçti.</strong>

                                    Tahsilat listenizi kontrol etmeniz önerilir.

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SAĞ TARAF -->

                <div class="col-lg-5">

                    <div class="login-card">

                        <div class="login-header">

                            <h2>
                                Giriş Yap
                            </h2>

                            <p>
                                Hesabınıza güvenli giriş yapın.
                            </p>

                        </div>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger mb-3">
                                <?= e($error) ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">

                            <div class="mb-3">

                                <label class="form-label">
                                    E-Posta Adresi
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="ornek@mail.com"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Şifre
                                </label>

                               <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Şifreniz"
                                    required>

                            </div>

                            <div class="login-options">

                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="remember">

                                    <label
                                        class="form-check-label"
                                        for="remember">

                                        Beni Hatırla

                                    </label>

                                </div>

                                <a href="#">
                                    Şifremi Unuttum
                                </a>

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100 login-btn">

                                Hesabıma Giriş Yap

                            </button>

                        </form>

                        <div class="register-link">

                            Hesabınız yok mu?

                            <a href="#">
                                Ücretsiz Kayıt Ol
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
require_once '../templates/footer.php';
?>