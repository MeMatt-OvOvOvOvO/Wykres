<?php
if(isset($_GET["szerokosc"])) $szerokosc=$_GET['szerokosc'];
else $szerokosc = 1000;

if(isset($_GET["wysokosc"])) $wysokosc=$_GET['wysokosc'];
else $wysokosc = 500;
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
$conn=mysqli_connect("localhost","root","","wykres");

if(!$conn) echo "Jakis tam blad z baza";

$q1 = 'UPDATE wymiary SET szerokosc ='.$szerokosc.' WHERE id=1;';
$q2 = 'UPDATE wymiary SET wysokosc ='.$wysokosc.' WHERE id=1;';
mysqli_query($conn,$q1);
mysqli_query($conn,$q2);
mysqli_close($conn);

echo "<img src='wykres.php?szerokosc=".$szerokosc."&wysokosc=".$wysokosc."&date=".date('d-m-Y H:i:s')." ' usemap='#main'/></br>";
?>
</div>

<a href="pdf.php"><input type="submit" value="Pobierz plik PDF"></a>

</body>
</html>
