<?php

require_once '../config/bootstrap.php';

requireLogin();

require_once '../templates/header.php';
?>

<div class="container py-5">

    <div class="card shadow-sm">

        <div class="card-body">

            <h1 class="mb-3">
                Dashboard
            </h1>

            <p>
                Hoşgeldin
                <strong><?= e($_SESSION['user_name']) ?></strong>
            </p>

            <hr>

            <p>
                Kullanıcı ID:
                <?= (int)$_SESSION['user_id'] ?>
            </p>

            <p>
                Firma ID:
                <?= (int)$_SESSION['company_id'] ?>
            </p>

            <p>
                Rol:
                <?= e($_SESSION['role']) ?>
            </p>

            <a
                href="../auth/logout.php"
                class="btn btn-danger">

                Çıkış Yap

            </a>

        </div>

    </div>

</div>

<?php
require_once '../templates/footer.php';
?>