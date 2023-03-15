<?php



require_once $_SERVER['DOCUMENT_ROOT'] . "/hospital-management/backend/php-classes/tcpdf/tcpdf.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hospital-management/backend/php-classes/patients/patientsTreatmentSymptom.php";

if (array_key_exists('ID', $_GET)) {
    $prescription_id = $_GET['ID'];
    $presc_arr = explode('_', $prescription_id);
    array_pop($presc_arr);
    $patient_id = implode('_', $presc_arr);
    $patientTreatSym = new PatientsTreatmentSymptom();
    $all_cols = $patientTreatSym->get_Db_cols($patient_id);
    if ($all_cols !== false) {
        if ($all_cols->num_rows > 0) {
            while ($row = $all_cols->fetch_assoc()) {
                $hospital_pMeds = $row['hospital_pMeds'];
            }
        }
    }
} else {
    exit();
}

if (!empty($hospital_pMeds)) {
    $prescription = json_decode($hospital_pMeds, true);
    foreach ($prescription as $key => $value) {
        if ($value['ID'] === $prescription_id) {
            // print_r($prescription[$key]);
            $medicine_name = $prescription[$key]['medicine_name'];
            $medicine_qty = $prescription[$key]['medicine_qty'];
            $medicine_volume = $prescription[$key]['medicine_volume'];
            $medicine_pattern = $prescription[$key]['medicine_pattern'];
            $medicine_notes = $prescription[$key]['medicine_notes'];
            $medicine_test = $prescription[$key]['medicine-test'];
            $follow_up_date = $prescription[$key]['follow_up_date'];
            $date = $prescription[$key]['date'];
        }
    }
    // print_r($medicine_name);
    // print_r($medicine_qty);
    // print_r($medicine_volume);
    // print_r($medicine_pattern);
    // print_r($medicine_notes);

    function meds_string($medicine_name)
    {
        $meds_string = '';
        $medicine_name_arr = explode(',', $medicine_name);
        foreach ($medicine_name_arr as $med_name) {
            $meds_string .= '<table class="" style="width:100%; ">';
            $meds_string .= '<tr>';
            $meds_string .= '<td style="padding:10px 0;">';
            $meds_string .=    $med_name;
            $meds_string .= ' </td>';
            $meds_string .= '</tr>';
            $meds_string .= '</table>';
        }
        return $meds_string;
    }
    function meds_qty($medicine_qty, $medicine_volume)
    {
        $meds_qty = '';
        $medicine_qty_arr = explode(',', $medicine_qty);
        $medicine_volume_arr = explode(',', $medicine_volume);
        foreach ($medicine_qty_arr as $key => $med_qty) {

            $meds_qty .= '<table class="" style="width:100%; ">';
            $meds_qty .= '<tr>';
            $meds_qty .= '<td style="padding:10px 0;">';
            $meds_qty .=  $med_qty .  $medicine_volume_arr[$key];
            $meds_qty .= '</td>';
            $meds_qty .= '</tr>';
            $meds_qty .= '</table>';
        }
        return $meds_qty;
    }

    function meds_pattern($medicine_pattern)
    {
        $meds_pattern = '';
        $medicine_pattern_arr = explode(',', $medicine_pattern);
        foreach ($medicine_pattern_arr as $key => $med_pattern) {
            $meds_pattern .= '<table class="" style="width:100%; ">';
            $meds_pattern .= '<tr>';
            $meds_pattern .= '<td style="padding:10px 0;">';
            $meds_pattern .=    $med_pattern;
            $meds_pattern .= '</td>';
            $meds_pattern .= ' </tr>';
            $meds_pattern .= '</table>';
        }
        return $meds_pattern;
    }

    function meds_notes($medicine_notes)
    {
        $meds_notess = '';
        $medicine_notes_arr = explode(',', $medicine_notes);
        foreach ($medicine_notes_arr as $key => $med_notes) {
            $meds_notess .= '<table class="" style="width:100%; ">';
            $meds_notess .= '<tr>';
            $meds_notess .= '<td style="padding:10px 0;">';
            $meds_notess .= $med_notes;
            $meds_notess .= '</td>';
            $meds_notess .= '</tr>';
            $meds_notess .= '</table>';
        }
        return $meds_notess;
    }
}


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // // Logo
        // $image_file = 'https://www.vurtegopogo.com/wp-content/uploads/2014/03/Red-Block.jpg';
        // $this->Image($image_file, 10, 10, 150, '', 'JPG', '', 'T', false, 300, '', false, false, 0, true, false, false);
        // // Set font
        // $this->SetFont('times', 'B', 20);
        // // Title
        // $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');


        $headerData = $this->getHeaderData();
        $this->SetFont('times', '', 10);
        $this->writeHTML($headerData['string']);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-71);
        $this->SetX(0);
        // $this->setXY(-10,-50);
        // // Set font
        $this->SetFont('times', '', 12);
        // // Page number
        // $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'L', 0, '', 0, false, 'T', 'M');

        $footer_image = $_SERVER['DOCUMENT_ROOT'] . "hospital-management/assets/images/pdf/footer-demo2.png";
        $footer_table = '
        <table class="footer" cellpadding="0" cellspacing="0" border="0" >
    <tbody style="text-indent: 10px">
    <tr>
        <td>
        <table ><tbody><tr><td style="width:60px"></td><td style="width:300px;"><p style="text-indent: -8px">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta aperiam praesentium rem quidem consectetur eum recusandae officia commodi asperiores nesciunt!
        </p></td></tr></tbody></table>
        </td>
        </tr>
        <tr>
        <td style="text-indent: -4px">
        <img src="' . $footer_image . '" style="width:900px;height:215px;text-indent: -4px" />
        </td>
        </tr>
    </tbody>
</table>
        ';
        $this->writeHTML($footer_table, false, false, false, false, 'L');
    }
    public function Output($name = 'doc.pdf', $dest = 'D')
    {
        $this->tcpdflink = false;
        // $this->tcpdflink = false;
        return parent::Output($name, $dest);
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, "mm", PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('AVHSP');
// $pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($prescription_id);
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$header_strip_image = $_SERVER['DOCUMENT_ROOT'] . "hospital-management/assets/images/pdf/header-strip.png";

$header_table = '
<table class="header">
<tbody width="100%">
<tr>
<td></td>
<td><img src="' . $header_strip_image . '"  class="" style="width:500px;height:80px"/></td>
</tr>
</tbody>
</table>

';
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, $header_table);


// set header and footer fonts
// $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(0, 20, 0);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
// if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//     require_once(dirname(__FILE__) . '/lang/eng.php');
//     $pdf->setLanguageArray($l);
// }

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

$image_icon = $_SERVER['DOCUMENT_ROOT'] . "hospital-management/assets/images/pdf/icon.png";


$table_html = '
<style>
.table-border{
    border:1px solid #eee;
    
}
th{
    width:25%;
    text-align:center;
    background-color:#fafafa;
    border-bottom:1px solid #ccc;
    
}
tr{
    border-bottom:1px solid #ccc;
}
td{
    text-align:center;
    line-height:30px;
}
.w-100{
    width:100%;
}
.w-80{
    width:80%;
}
.w-20{
    width:20%;
}
.text-left{
    text-align:left;
}
</style>





<table>
<tbody>
<tr>
<td width="10%"></td>
<td width="80%">

<table style="width:250px; background-color:#fff;">
<tbody>
<tr >
<td style="width:100px; line-height:15px;"  valign="middle">
<div>
<img src="' . $image_icon . '" style="width:250px;"/>
</div>
</td>
<td style="width:150px; line-height:15px;" valign="middle">
<div>
<h1 style="line-height:25px; font-size:22px;"> DR. KEVIN HARTNET</h1>
</div>
</td>
</tr>
</tbody>
</table>

<table>
<tbody>
    <tr>
    <td class="text-left w-80">
    <b>Patient name:</b>
    </td>
    <td class="w-20 text-left">
    <b>Date:</b>' . $date . '
    </td>
    </tr>
</tbody>
</table>


<table class="table-border" id="medicine-prescription-table" cellpadding="5">
<thead>
<tr>
<th>
<b>Medicine Name</b>
</th>
<th>
<b>Dosage</b>
</th>
<th>
<b>Dosage Pattern</b>
</th>
<th>
<b>Notes</b>
</th>
</tr>
</thead>
<tbody>
<tr>
<td>' .
    meds_string($medicine_name)
    . '
</td>
<td>'
    .
    meds_qty($medicine_qty, $medicine_volume)
    .
    '
</td>
<td>' . meds_pattern($medicine_pattern) . '</td>
<td>' . meds_notes($medicine_notes) . '</td>
</tr>
</tbody>
</table>



</td>
<td width="10%"></td>
</tr>
</tbody>
</table>




';

$pdf->writeHTML($table_html, true, false, true, false, '');
// ---------------------------------------------------------
// $pdf->IncludeJS($js);

//Close and output PDF document
$pdf->Output('example_003.pdf', 'D');
