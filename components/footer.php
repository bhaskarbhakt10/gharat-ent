<?php require_once 'title.php'; ?>

<footer>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.script.jQuery.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.material-bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.select2.min.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jspdf.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/html2canvas.js" type="text/javascript"></script>

    <script src="<?php echo BASE_URL; ?>assets/js/jquery.script.main.js" type="text/javascript"></script>


    <?php
    $file_name_script = "./js/script." . enqueue_script_css() . ".js";
    $file_name_script_jquery = "./js/jquery.script." . enqueue_script_css() . ".js";
    if (file_exists($file_name_script)) {
    ?>
        <script src="<?php echo $file_name_script; ?>" type="text/javascript"></script>
    <?php }
    if (file_exists($file_name_script_jquery)) {

    ?>
        <script src="./js/jquery.script.<?php echo enqueue_script_css(); ?>.js" type="text/javascript"></script>
    <?php } ?>

    <script src="<?php echo BASE_URL; ?>components/js/jquery.script.component.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>components/js/script.component.js" type="text/javascript"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <script>
        // https://html2canvas.hertzen.com/configuration
        // https://rawgit.com/MrRio/jsPDF/master/docs/module-html.html#~html
        // https://artskydj.github.io/jsPDF/docs/jsPDF.html
        window.jsPDF = window.jspdf.jsPDF;

        function generatePdf() {
            a4 = [595.28, 841.89];
            let jsPdf = new jsPDF('p', 'pt', 'a4');
            var htmlElement = document.getElementById('download-prescription');
            let pdf_obj = htmlElement.offsetWidth;
            console.log(pdf_obj);
            const pageWidth = jsPdf.internal.pageSize.getWidth();
            const pageHeight = jsPdf.internal.pageSize.getHeight();
            console.log(pageWidth);
            console.log(pageHeight);
            // you need to load html2canvas (and dompurify if you pass a string to html)
            let new_width =  (a4[0] * 1.33333) - 0;
            console.log(new_width);
            const opt = {
                callback: function(jsPdf) {
                    // htmlElement.style.width = new_width;
                    // htmlElement.style.maxWidth = 'none';
                    jsPdf.save("Test.pdf");
                    htmlElement.style.width =pdf_obj+"px";

                    // to open the generated PDF in browser window
                    // window.open(jsPdf.output('bloburl'));
                },
                margin: [50, 50, 50, 50],
                autoPaging: 'text',
                html2canvas: {
                    allowTaint: true,
                    dpi: 900,
                    letterRendering: true,
                    logging: true,
                    scale: 0.6,
                    width:new_width,
                    backgroundColor: '#eee'
                }
            };

            jsPdf.html(htmlElement, opt);
        }
    </script>


</footer>
</body>

</html>