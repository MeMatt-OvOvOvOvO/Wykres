<?php
$szerokosc=1000;
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

if (isset($_GET['wysokosc'])) $wysokosc = $_GET['wysokosc'];
else $wysokosc=500;

if (isset($_GET['szerokosc'])) $szerokosc = $_GET['szerokosc'];
else $szerokosc=1000;
    
header ('Content-Type: image/png');
$imagg = imagecreatetruecolor($szerokosc, $wysokosc);
$dotka = 2/100*$wysokosc;
$blue = imagecolorallocate($imagg, 0, 0, 255);
$gray = imagecolorallocate($imagg, 128, 128, 128);
$black = imagecolorallocate($imagg, 0, 0, 0);
$white = imagecolorallocate($imagg, 255, 255, 255);
$red = imagecolorallocate($imagg, 255, 0, 0);

imagefilledrectangle($imagg,0,0,$szerokosc,$wysokosc,$white);

$arr=[$white,$white,$white,$white,$black,$black,$black,$black];

imagestringup($imagg, 4, 5, $wysokosc/1.5, 'temperatura', $black);
imagestring($imagg, 4, $szerokosc/2.3, $wysokosc-20, 'dzien miesiaca', $black);

imageline($imagg,(0.1*$szerokosc),0.9*$wysokosc,0.9*$szerokosc,0.9*$wysokosc,$black);
imageline($imagg,(0.1*$szerokosc),0.1*$wysokosc,0.1*$szerokosc,0.9*$wysokosc,$black);
imagesetstyle ($imagg, $arr);

$a=0.1*$szerokosc;
$b=0.1*$wysokosc;
$c=0.9*$szerokosc;
$d=0.1*$wysokosc;

$XXX=(0.9*$szerokosc-0.1*$szerokosc)/28;
$YYY=(0.9*$wysokosc-0.1*$wysokosc)/6;

//linie poziom

for($i=0;$i<6;$i++){
    if($i==1){
        imageline($imagg, $a,$b,$c,$d, $red);
        $b=$b+$YYY;
        $d=$d+$YYY;
    }else{
        imageline($imagg, $a,$b,$c,$d, IMG_COLOR_STYLED);
        $b=$b+$YYY;
        $d=$d+$YYY;
    }
}

//linie pion
$a=0.1*$szerokosc+$XXX;
$b=0.1*$wysokosc;
$c=0.1*$szerokosc+$XXX;
$d=0.9*$wysokosc;

for($i=0;$i<28;$i++){    
    imageline ($imagg, $a,$b,$c,$d, IMG_COLOR_STYLED);
    $a=$a+$XXX;
    $c=$c+$XXX;
}

//kresli poziom
$a=0.1*$szerokosc-6;
$b=0.1*$wysokosc;
$c=0.1*$szerokosc+6;
$d=0.1*$wysokosc;

for($i=0;$i<7;$i++){
    imageline ($imagg, $a,$b,$c,$d, $black);
    $b=$b+$YYY;
    $d=$d+$YYY;
}

//kreski pion
$a=0.1*$szerokosc;
$b=0.9*$wysokosc-6;
$c=0.1*$szerokosc;
$d=0.9*$wysokosc+6;

for($i=0;$i<29;$i++){
    imageline ($imagg, $a,$b,$c,$d, $black);
    $a=$a+$XXX;
    $c=$c+$XXX;
}

//liczby pozioma os
$lll=1;
$a=0.1*$szerokosc;
for($i=0;$i<28;$i++){
    $a=$a+$XXX;
    imagestring($imagg,2,$a-3,0.9*$wysokosc+7,$lll,$black);
    $lll++;      
}

//liczby pionowa os
$lll=37.2;
$b=0.1*$wysokosc;
for($i=0;$i<6;$i++){  
    imagestring($imagg,2,0.1*$szerokosc-30,$b-7,$lll,$black);
    $b=$b+$YYY;
    $lll=$lll-0.2;       
}


//kropeczki
$arrr1=[];
$arrr2=[];

$a=0.1*$szerokosc;
for($i=0;$i<28;$i++){ 
    $a=$a+$XXX;

    if($tablica[$i]["temperatura"]==0.0){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+6*$YYY,$dotka,$dotka,$red);
        $arrr1[$i]=0;
        $arrr2[$i]=0;
    }elseif($tablica[$i]["temperatura"]==36.1){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+5*$YYY+1/2*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+5*$YYY+1/2*$YYY;
    }elseif($tablica[$i]["temperatura"]==36.2){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+5*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+5*$YYY;
    }elseif($tablica[$i]["temperatura"]==36.3){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+4*$YYY+1/2*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+4*$YYY+1/2*$YYY;
    }elseif($tablica[$i]["temperatura"]==36.4){
        imagefilledellipse($imagg,$a,10/100*$wysokosc+4*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+4*$YYY;
    }elseif($tablica[$i]["temperatura"]==36.5){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+3*$YYY+1/2*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+3*$YYY+1/2*$YYY;
    }elseif($tablica[$i]["temperatura"]==36.6){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+3*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+3*$YYY;
    }elseif($tablica[$i]["temperatura"]==36.7){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+2*$YYY+1/2*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+2*$YYY+1/2*$YYY;
    }elseif($tablica[$i]["temperatura"]==36.8){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+2*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+2*$YYY;
    }elseif($tablica[$i]["temperatura"]==36.9){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+1*$YYY+1/2*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+1*$YYY+1/2*$YYY;
    }elseif($tablica[$i]["temperatura"]==37.0){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+$YYY;
    }elseif($tablica[$i]["temperatura"]==37.1){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+1/2*$YYY,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc+1/2*$YYY;
    }elseif($tablica[$i]["temperatura"]==37.2){
        imagefilledellipse($imagg,$a,0.1*$wysokosc,$dotka,$dotka,$blue);
        $arrr1[$i]=$a;
        $arrr2[$i]=0.1*$wysokosc;
    }

    if($tablica[$i]["temperatura"]==NULL){
        imagefilledellipse($imagg,$a,0.1*$wysokosc+6*$YYY,$dotka,$dotka,$gray);
        $arrr1[$i]=0;
        $arrr2[$i]=0;
    }
}

//linie laczace
$arr2=[$white,$white,$white,$white,$blue,$blue,$blue,$blue];
imagesetstyle ($imagg, $arr2);

for($i=0;$i<27;$i++){
    if($arrr1[$i]==0||$arrr1[$i+1]==0) $cos=1;
    else imageline($imagg, $arrr1[$i],$arrr2[$i],$arrr1[$i+1],$arrr2[$i+1], IMG_COLOR_STYLED);
}
imagepng($imagg);
?>