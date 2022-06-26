<?php
require_once('TCPDF-main/tcpdf.php');
$imgg = "http://localhost/kis/Wykres/wykres.php";
date_default_timezone_set('Europe/Warsaw');
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Set font
        $this->SetFont('helvetica', 'i', 15);
        // Date Date 
        $datedate = date('d-m-Y H:i:s');
        // Title
        $this->Cell(0, 15, " Pdf wygenerowano: $datedate ", 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15); 
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', 'i', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$pdf->Image($imgg, 5, 10, 200, 80, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);

$pdf->SetFont('dejavusans', '', 10, '', true);

$html = "   
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Circle(10, 127, 1.5, 0, 360, 'DF', '', array(240, 0, 0));
$pdf->Circle(10, 135.5, 1.5, 0, 360, 'DF', '', array(128, 128, 128));

$html = '
<table>
<tr><td style="width:400">
<br>
Legenda:
<br><br>
- choroba
<br><br>
- brak pomiaru
</td>
<td style="width:100">
Pomiary:
</td> 
<td style="width:150">
<table border="1" style="text-align:center">
<tr>
<td>dzień</td>
<td>temp.</td>
</tr>';

$conn=mysqli_connect("localhost","root","","wykres");

if(!$conn) echo "Jakis tam blad z baza";

$wynik = mysqli_query($conn,"SELECT * FROM wykres");

$tablica=array();
$i=0;

while($row = mysqli_fetch_array($wynik)){
    $tablica[$i]=$row;
    $i++;
}

mysqli_close($conn);

for($i=0;$i<count($tablica);$i++){
    
    $html.='<tr><td>';
    $html.=$tablica[$i]["dzien_miesiaca"];
    $html.='</td><td>';
    if($tablica[$i]["temperatura"]===null){
        $html.="brak pom.";
    }elseif($tablica[$i]["temperatura"]==0){
        $html.="choroba";
    }else{  
        $html.=$tablica[$i]["temperatura"];
    }
    $html.='</td></tr>';
}

$html2='</table></td></tr></table>';

$html.=$html2;

// output the HTML content

$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('wykresik.pdf', 'I');
?>