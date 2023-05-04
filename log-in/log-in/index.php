<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/gharat-ent/hospital-management/components/header.php';
// require_once '../../components/header.php'; 
?>

<main class="viewport center-viewport">
    <div class="container">
        <form action="" method="post" autocomplete="off">
            <div class="row">
                <div class="col-md-12">
                    <div class="log-in-wrapper">
                        <div class="brand-wrapper mb-2">
                            <div class="text-center">
                                <img src='<?php echo BASE_URL .'log-in/log-in/images/avannah-logo.png' ; ?>' class="img-fluid brand-logo w-60" />
                            </div>
                        </div>
                        <div class="form-heading-wrapper ">
                            <h1 class="p-0 text-uppercase text-center form-heading mb-4">
                                Login
                            </h1>
                        </div>
                        <div class="mb-4">
                            <input type="text" name="username" id="username" class="form-control form-field border-solid" placeholder="example@login.com" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control form-field border-solid" placeholder="***********" required autocomplete="off">
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
                            <button class="btn btn-md btn-blue d-block log-in">Log In</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/gharat-ent/hospital-management/components/footer.php'; 
// require_once '../../components/footer.php'; 

?>