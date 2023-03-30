<?php require_once 'title.php'; ?>

<footer>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.script.jQuery.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.material-bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.select2.min.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.datatables.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.datatables.responsive.js" type="text/javascript"></script>
    <!-- <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script> -->


    <script src="<?php echo BASE_URL; ?>assets/js/jquery.script.main.js?ver=<?php echo time(); ?>" type="text/javascript"></script>
    <?php
    $file_name_script = "./js/script." . enqueue_script_css() . ".js";
    $file_name_script_jquery = "./js/jquery.script." . enqueue_script_css() . ".js";
    if (file_exists($file_name_script)) {
    ?>
        <script src="<?php echo $file_name_script . "?ver=" . time() . ""; ?>" type="text/javascript"></script>
    <?php }
    if (file_exists($file_name_script_jquery)) {

    ?>
        <script src="<?php echo $file_name_script_jquery . "?ver=" . time() . ""; ?>" type="text/javascript"></script>
    <?php } ?>

    <script src="<?php echo BASE_URL; ?>components/js/jquery.script.component.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>components/js/script.component.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script>
        if (document.getElementById("myChart") !== null) {
            let ctx = document.getElementById("myChart").getContext('2d');

            let myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                            label: 'New Patients',
                            // Name the series
                            data: [10, 20, 30, 100],
                            // Specify the data values array
                            fill: false,
                            borderColor: '#C1E4FA',
                            // Add custom color border (Line)
                            backgroundColor: '#C1E4FA',
                            // Add custom color background (Points and Fill)
                            borderWidth: 4
                            // Specify bar border width
                        },
                        {
                            label: 'Old Patients',
                            // Name the series
                            data: [60, 70, 90, 120],
                            // Specify the data values array
                            fill: false,
                            borderColor: '#0072BC',
                            // Add custom color border (Line)
                            backgroundColor: '#0072BC',
                            // Add custom color background (Points and Fill)
                            borderWidth: 4
                            // Specify bar border width
                        }
                    ]
                },
                options: {
                    responsive: true,
                    // Instruct chart js to respond nicely.
                    maintainAspectRatio: false,
                    // Add to prevent default behaviour of full-width/height 
                    legend: {
                        position: 'top',
                    },
                    elements: {
                        point: {
                            radius: 2
                        }
                    }
                }
            });
        }
    </script>
</footer>
</body>

</html>