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
        // $this->writeHTML($footer_table, false, false, false, false, 'L');
        $this->writeHTML('', false, false, false, false, 'L');
    }
    // public function Output($name = 'doc.pdf', $dest = 'D')
    // {
    //     $this->tcpdflink = false;
    //     // $this->tcpdflink = false;
    //     return parent::Output($name, $dest);
    // }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, "mm", PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('AVHSP');
// $pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($prescription_id);
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

/*
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
*/

$header_table = "
<table style='width:100%;'>
    <tbody>
        <tr>
            <td style='background-color:red;width: 33.33%; text-align: center;'>
                <div style='text-align: center;'>
                    <h1>
                        Dr hemant Wagh
                    </h1>
                </div>
            </td>
            <td style='background-color:yellow;width:33.33%; text-align: center;'>column blank</td>
            <td style='background-color:blue;width:33.33%; text-align: center;'>
                column 2
            </td>
        </tr>
    </tbody>
</table>
";

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, '');


// set header and footer fonts
// $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(0, 0, 0);
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

// convert TTF font to TCPDF format and store it on the fonts folder
$mundo = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'] . "hospital-management/assets/fonts/Mundo-Sans/Mundo-Sans-Std-Medium-Italic.ttf", 'TrueTypeUnicode', '', 96);
$mundo_light = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'] . "hospital-management/assets/fonts/Mundo-Sans/Mundo-Sans-Std-Light.ttf", 'TrueTypeUnicode', '', 96);

// use the font
// $pdf->setFontSubsetting(true);
$pdf->SetFont($mundo, '', 14, '', false);
$light = $pdf->AddFont($mundo_light,'','dejavusansb.php'); 
// $pdf->SetFont($mundo_light, '', 14, '', false);
// print_r($light);
// set font

// add a page
$pdf->AddPage();


// $mundo = $_SERVER['DOCUMENT_ROOT'] . "hospital-management/assets/fonts/Mundo-Sans/Mundo-Sans-Std-Medium-Italic.ttf";
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
.width-cust{
    width:40%;
}
.w-33{
    width:33.33%;
}
.w-50{
width:50%;
}
.red{
background-color:red;
}
.blue{
    background-color:blue;
}
.text-left{
    text-align:left;
}
.text-right{
    text-align:right;
}
.dr-name{
margin:0;
line-height:35px;
font-size:30px;
padding:0;
}
.dr-info{
    font-size:15px;
    line-height:18px;
}
.verticle-middle{
    vertical-align: middle;
}
.header-table>*{
    
}
.font-16{
    font-size:16px;
    line-height:20px;
}
.font-14{
    font-size:12px;
    line-height:14px;
}
fontweight-400{
    font-weight:100;
}
.pdf-blue{
    color:#0072BC
}
.text-left{
    text-align:left;
}
.header-table-address td{
    text-align:left;
}
.para{
    margin:0;
    padding:0;

}
.header-first-col{
    width:33.33%;
}
.header-second-col{
    width:25%;
}
.header-third-col{
    width:auto;
}
.dark{
    color:#000;
}
a{
    text-decoration:none;
    color:#000;
}
.line-height-td{
    
}
#header-table{
    border:2px solid red;
}
</style>





<table>
<tbody>
<tr>
<td width="2%"></td>

<td width="96%">

<table class="w-100 " id="header-table" >
<tbody>
    <tr><td style="height:10px;"></td></tr>
    <tr>
    <td class="text-left header-first-col">
        <table class="header-table-name ">
            <tr>
            <td><h1 class="dr-name pdf-blue">Dr Hemant Wagh</h1></td>
            </tr>
            <tr>
            <td><p class="dr-info"><span>MBBS, DNB, FICM, DGM</span><br><span>Diabetoligist & Physician</span><br><span>Reg. No. 2004/08/2861</span></p>
            </td>
            </tr>
        </table>
    </td>
    <td class="text-right header-second-col">
       <table>

       </table>
    </td>
    <td class="text-left header-third-col">
        <table class="header-table-address ">
            <tr>
            <td class="text-left line-height-td"><h1 class="font-16 pdf-blue">Avannah Hospital</h1></td>
            </tr>
            <tr>
            <td class="text-left line-height-td" style="font-family:mundosansstdlight;"><p class="font-14 fontweight-400 para">Ground Floor, Friendship Corner,<br>Lane Near Madhuram Hotel, Dindayal Nagar, Vasai (W) </p>
            </td>
            </tr>
            <tr>
            <td class="text-left line-height-td"><p class="font-14 fontweight-400 para">Tel:. <a href="tel:+919420292710">9420292710</a></p></td>
            </tr>
            <tr>
            <td class="text-left line-height-td"><p class="font-14 fontweight-400 para pdf-blue">For Appointment:. <a href="tel:+918484077565">8484077565</a></p></td>
            </tr>
            <tr>
            <td class="text-left line-height-td"><p class="font-14 fontweight-400 para pdf-blue">Consulting Timings : <span class="dark">Mon To Sat - 11.00 am to 3.00 pm </span></p></td>
            </tr>
            <tr>
            <td style="width:180px;"></td>
            <td class="text-right line-height-td" colspan="5"><p class="font-14 fontweight-400 para pdf-blue"><span class="dark">7.00 pm to 9.00 pm </span></p></td>
            </tr>
        </table>
    </td>
    </tr>
</tbody>
<tfoot>
<tr>
<td style="border-top:1px solid #333;" colspan=""></td>
<td style="border-top:1px solid #333;" colspan=""></td>
<td style="border-top:1px solid #333;" colspan=""></td>
</tr>
</tfoot>
</table>

<table>
<tbody>
    <tr>
    <td class="text-left w-80">
    <b>Patient name:</b>
    </td>
    <td class="text-left w-20">
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
<td width="2%"></td>
</tr>
</tbody>
</table>




';

$pdf->writeHTML($table_html, true, false, true, false, '');
// ---------------------------------------------------------
// $pdf->IncludeJS($js);

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');
