<?php
require_once '../templates/header.php';
?>

<div class="container login-container d-flex align-items-center justify-content-center">

    <div class="row w-100">

        <div class="col-md-5 mx-auto">

            <div class="card login-card">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <h2 class="brand-title">
                            UstaAsistan
                        </h2>

                        <p class="text-muted">
                            İşlerini takip et, tahsilatını unutma.
                        </p>

                    </div>

                    <form>

                        <div class="mb-3">

                            <label class="form-label">
                                E-Posta
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                placeholder="ornek@mail.com">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Şifre
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                placeholder="Şifreniz">

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary btn-login w-100">

                            Giriş Yap

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
require_once '../templates/footer.php';
?>