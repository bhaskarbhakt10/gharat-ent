<?php



require_once $_SERVER['DOCUMENT_ROOT'] . "/hospital-management/backend/php-classes/tcpdf/tcpdf.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hospital-management/backend/php-classes/patients/patientsTreatmentSymptom.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hospital-management/backend/php-classes/patients/patients.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hospital-management/backend/php-classes/admin/admin.php";

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
                $hospital_pSym = $row['hospital_pSym'];
            }
        }
    }
} else {
    exit();
}   
    // echo $patient_id;
    // echo $patientTreatSym->generate_association_id($patient_id);

    


if (!empty($hospital_pMeds)) {
    // print_r($hospital_pMeds);
    $prescription = json_decode($hospital_pMeds, true);
    // echo "<pre>";
    // print_r($prescription);
    // echo "</pre>";
    foreach ($prescription as $key => $value) {
        // echo $value['ID'];
        if ($value['ID'] === $prescription_id) {
            // print_r($prescription[$key]);
            $medicine_name = $prescription[$key]['medicine_name'];
            $medicine_qty = $prescription[$key]['medicine_qty'];
            $medicine_volume = $prescription[$key]['medicine_volume'];
            $medicine_pattern = $prescription[$key]['medicine_pattern'];
            $medicine_notes = $prescription[$key]['medicine_notes'];
            $medicine_test = $prescription[$key]['medicine-test'];
            $follow_up_date = $prescription[$key]['follow_up_date'];
            // $other_medicine_test = $prescription[$key]['other_medicine_test'];
            $date = $prescription[$key]['date'];
            $patient_id = $prescription[$key]['ID'];
            $prescribedID = $prescription[$key]['prescribedID'];
            $associatedID = $prescription[$key]['associatedID'];
        }
    }

    // print_r($medicine_name);
    // print_r($medicine_qty);
    // print_r($medicine_volume);
    // print_r($medicine_pattern);
    // print_r($medicine_notes);

    if(!empty($hospital_pSym)){
        $symptoms = json_decode($hospital_pSym, true);
        // echo "<pre>";
        // print_r($symptoms);
        // echo "</pre>";
        foreach($symptoms as $key=>$value){
            if($value['associatedID'] === $associatedID){
                // print_r($value);
                $symptom_name = $symptoms[$key]['symptom_name'];
                $symptom_type = $symptoms[$key]['symptom_type'];
                $symptom_days = $symptoms[$key]['symptom_days'];
                if(array_key_exists('expected-delivery-date', $symptoms[$key])){
                $expected_delivery_date ='
                <tr>
                <th width="20%" class="text-justify"><b>&nbsp;&nbsp;Expected Delivery Date:</b></th>
                <td width="80%" class="text-left"> '.$symptoms[$key]['expected-delivery-date'].'</td>
                </tr>';
                }
            }
        }
    }

}





    $admin = new Admin();
    //docter name
    $who_prescribed = $admin->user_by_id($prescribedID);
    $otherInfo_json = $admin->otherinfouser_by_id($prescribedID);
    $otherInfo_arr = json_decode($otherInfo_json, true);
    // print_r($otherInfo_arr);
    if(!empty($otherInfo_arr['profile-degree'])){
        $who_degree = $otherInfo_arr['profile-degree'];
    }
    else{
        $who_degree = '';
    }
    if(!empty($otherInfo_arr['profile-regno'])){
        $who_regno = $otherInfo_arr['profile-regno'];
    }
    else{
        $who_regno = '';
    }
    if(!empty($otherInfo_arr['profile-specialization'])){
        $who_speciality = $otherInfo_arr['profile-specialization'];
    }
    else{
        $who_speciality = '';
    }
   
    

    // patinet name 
    $patient_id_array = explode('_', $patient_id);
    array_pop($patient_id_array);
    $patinetID__ = implode('_', $patient_id_array);
    $patient = new Patients();
    $res = $patient->get_genral_detials($patinetID__);
    
    $patient_name = '';
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $patient_name .= $row['hospital_PatientFirstName'] . " " . $row['hospital_PatientMiddleName'] . " " . $row['hospital_PatientLastName'];
        }
    }

    //test suggested
    $test_suggested = '';
    if(!empty($other_medicine_test)){
        $test_suggested .= '<tr><td class="text-left">Test To be Done:. ' . $other_medicine_test . '</td></tr>';
    }

    //Follow up date
    $follow_up = '';
    if(!empty($follow_up_date)){
        $follow_up .=  '<tr><td class="text-left">Next Followup date:. ' . $follow_up_date . '</td></tr>';
        
    }

    $test_and_followup ='<tfoot>';
    $test_and_followup .='<tr>';
    $test_and_followup .='<td colspan="4">';
    $test_and_followup .=' <table class="w-100">';
    $test_and_followup .= $test_suggested;
    $test_and_followup .= $follow_up;
    $test_and_followup .='</table>';
    $test_and_followup .='</td>';
    $test_and_followup .='</tr>';
    $test_and_followup .='</tfoot>';


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




// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        $headerData = $this->getHeaderData();
        $this->SetFont('mundosansstdlight', '', 10);
        $this->SetFont('mundosansstdmediumi', '', 10);
        $this->writeHTML($headerData['string']);
    }

    // Page footer
    public function Footer()
    {
        // $this->setX(0);
        $this->writeHTML('', false, false, false, false, 'L');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, "mm", PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('Avannah Hospital');
$pdf->SetTitle($prescription_id);

$header_table = '
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
line-height:30px;
font-size:27px;
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
.font-12{
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
            <td><h1 class="dr-name pdf-blue">Dr.' . $who_prescribed . '</h1></td>
            </tr>
            <tr>
            <td><p class="dr-info"><span>'.$who_degree.'</span><br><span>'.$who_speciality.'</span><br><span>Reg. No. '.$who_regno.'</span></p>
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
            <td class="text-left line-height-td" style="font-family:mundosansstd; font-weight:bold;
            font-style:italic"><p class="font-12 fontweight-400 para">Ground Floor, Friendship Corner,<br>Lane Near Madhuram Hotel, Dindayal Nagar, Vasai (W) </p>
            </td>
            </tr>
            <tr>
            <td class="text-left line-height-td"><p class="font-12 fontweight-400 para">Tel:. <a href="tel:+919420292710">9420292710</a></p></td>
            </tr>
            <tr>
            <td class="text-left line-height-td"><p class="font-12 fontweight-400 para pdf-blue">For Appointment:. <a href="tel:+918484077565">8484077565</a></p></td>
            </tr>
            <tr>
            <td class="text-left line-height-td"><p class="font-12 fontweight-400 para pdf-blue">Consulting Timings : <span class="dark">Mon To Sat - 11.00 am to 3.00 pm </span></p></td>
            </tr>
            <tr>
            <td style="width:180px;"></td>
            <td class="text-right line-height-td" colspan="5"><p class="font-12 fontweight-400 para pdf-blue"><span class="dark">7.00 pm to 9.00 pm </span></p></td>
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
</td>
<td width="2%"></td>
</tr>
</tbody>
</table>


';

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, $header_table);


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(0, 45, 0);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// convert TTF font to TCPDF format and store it on the fonts folder
$mundo = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'] . "hospital-management/assets/fonts/Mundo-Sans/Mundo-Sans-Std-Medium-Italic.ttf", 'TrueTypeUnicode', '', 96);
$mundo_light = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'] . "hospital-management/assets/fonts/Mundo-Sans/Mundo-Sans-Std-Light.ttf", 'TrueTypeUnicode', '', 96);
$mundo_regular = TCPDF_FONTS::addTTFfont($_SERVER['DOCUMENT_ROOT'] . "hospital-management/assets/fonts/Mundo-Sans/Mundo-Sans-Std-Regular.ttf", 'TrueTypeUnicode', '', 96);

// use the font
// $pdf->setFontSubsetting(true);

$pdf->SetFont($mundo_light, '', 11, '', false);
$pdf->SetFont($mundo, '', 11, '', false);
$pdf->SetFont($mundo_regular, '', 11, '', false);
// $pdf->SetFont($mundo_light,'','mundosansstdlight.php');
// print_r($light);
// $pdf->SetFont('dejavusans', '', 14, '', true);

// $light = $pdf->AddFont($mundo_light,'','dejavusansb.php'); 
// $pdf->SetFont($mundo_light, '', 14, '', false);
// print_r($light);
// set font

// add a page
$pdf->AddPage();


$table_html = '
<style>
.table-border{
    border:1px solid #eee;
    
}
th.meds-table{
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
.font-12{
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
.text-justify{
    text-align:justify
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
.symptom-table{
    background-color:#fafafa;
    border:1px solid #ccc;
}

.symptom-table th, .symptom-table td{
    border-bottom:1px solid #eee;
}
.symptom-table th b{
    border-left:1px solid #eee;
}
.symptom-table td{
    border-right:1px solid #eee;
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
<table>
<tbody>
    <tr>
    <td class="text-left w-80">
    <b>Patient name:</b> ' . $patient_name . '
    </td>
    <td class="text-left w-20">
    <b>Date:</b>' . $date . '
    </td>
    </tr>
    <tr><td></td></tr>
</tbody>
</table>

<table width="100%" id="symptom-table" class="symptom-table">
<tbody>
<tr>
<th width="20%" class="text-justify"><b>&nbsp;&nbsp;Symptoms:</b></th>
<td width="80%" class="text-left"> '.$symptom_name.'</td>
</tr>
<tr>

<th width="20%" class="text-justify"><b>&nbsp;&nbsp;Symptoms status:</b></th>
<td width="80%" class="text-left"> '.$symptom_type.'</td>
</tr>
<tr>

<th width="20%" class="text-justify"><b>&nbsp;&nbsp;No of days:</b></th>
<td width="80%" class="text-left"> '.$symptom_days.'</td>
</tr>
'
.
$expected_delivery_date
.
'
</tbody>
</table>

<h2 class=text-left>Medicine Table</h2>


<table class="table-border" id="medicine-prescription-table" cellpadding="5">
<thead>
<tr>
<th class="meds-table">
<b>Medicine Name</b>
</th>
<th  class="meds-table">
<b>Dosage</b>
</th>
<th  class="meds-table">
<b>Dosage Pattern</b>
</th>
<th  class="meds-table">
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
'
.
$test_and_followup
.
'
</table>



</td>
<td width="2%"></td>
</tr>
</tbody>
</table>
';

$pdf->writeHTML($table_html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');
