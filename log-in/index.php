<?php require_once '../components/header.php'; ?>
<?php require_once '../backend/constants/constants-static.php'; ?>
<main class="viewport center-viewport">
    <div class="container">
        <form action="" method="post" autocomplete="off">
            <div class="row">
                <div class="col-md-12">
                    <div class="log-in-wrapper">
                        <div class="brand-wrapper mb-2">
                            <div class="text-center">
                                <img src='<?php echo $brand_logo_blue; ?>' class="img-fluid brand-logo w-60" />
                            </div>
                        </div>
                        <div class="form-heading-wrapper ">
                            <h1 class="text-uppercase text-center form-heading mb-4">
                                Login
                            </h1>
                        </div>
                        <div class="mb-4">
                            <input type="text" name="username" id="username" class="form-control form-field" placeholder="example@login.com" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control form-field" placeholder="***********" required autocomplete="off">
                        </div>
                        <div class="mb-4">
                            <div class="forgot-remember">
                            <div class="">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-label">Remember Me</label>
                            </div>
                            <div class="">
                                <p class="">
                                    <a href="#" class="brand-color"> Forgot Password ?</a>
                                </p>
                            </div>
                            </div>
                        </div>
                        <div class="d-grid mb-5">
                            <button class="btn btn-md btn-blue d-block">Log In</button>
                        </div>
                        <div class="mb-2">
                            <p class="text-center mb-0">
                                Don’t have an account? <span><a href="#" class="brand-color">Signup</a></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>








<?php require_once '../components/footer.php'; ?>