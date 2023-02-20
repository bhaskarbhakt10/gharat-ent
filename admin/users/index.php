<?php require_once '../../components/header.php'; ?>
<?php require_once '../../backend/constants/constants-static.php'; ?>

<main class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                sidebar goes here
            </div>
            <div class="col-md-10">
                <div class="wrapper viewport">
                    <div class="dashboard-row">
                        <div class="dashboard-box">
                            <a href="create-users.php">
                                <div class="dashboard-icon">

                                    <i class="fa fa-users">
                                    </i>
                                    <h3 class="text-uppercase">Users</h3>
                                </div>
                                <div class="dashboard-count">
                                    <h4>
                                        7
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <div class="dashboard-box">
                            <a href="create-users.php">
                                <div class="dashboard-icon">
                                    <i class="fa fa-users">
                                    </i>
                                    <h3 class="text-uppercase">List Users</h3>
                                </div>
                                <div>
                                    <h4>
                                        7
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once '../../components/footer.php'; ?>