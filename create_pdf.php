<?php


require_once __DIR__ . '/TCPDF/mpdf-development/vendor/autoload.php';
//$stylesheet = file_get_contents( __DIR__ . '/TCPDF/mpdf-development.'style.css');

$html = '<table class="table">
    <tr>
        <td style="font-family: freeserif;" ><label> प्रयागराज, कानपुर, आगरा, लखनऊ एवं राजधानी दिल्ली
से एक साथ प्रकाशित 
पता : 1, अमरनाथ झा मार्ग, जार्ज टाउन, प्रयागराज: <span>*</span></label></td>
        <td>' . $authname[0]['authority_name'] . '</td>
    </tr>
    <tr>
        <td style="font-family: freeserif;"><label> आवेदक का नाम  <span>*</span></label></td>
        <td>' . $feeDetails['applicant_name'] . '</td>
    </tr>
    <tr>
        <td style="font-family: freeserif;"><label> आवदेक का पता  : <span>*</span></label></td>
        <td>' . $feeDetails['applicant_address'] . '</td>
    </tr>
    <tr>
        <td style="font-family: freeserif;" ><label> भूखण्ड संख्या : <span>*</span></label></td>
        <td>' . $feeDetails['land_no'] . '</td>
    </tr>
    <tr>
        <td style="font-family: freeserif;"><label> योजना का नाम : <span>*</span></label></td>
        <td>' . $feeDetails['plan_name'] . '</td>
    </tr>
    </table>';


$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);

//call watermark content aand image
$mpdf->SetWatermarkText('phpflow.COM');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->Output("phpflow.pdf", 'F');

$mpdf->Output();

exit;


?>