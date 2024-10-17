<?php

require('C:\Users\Lenovo\Desktop\PC\SFE\fpdf.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esto";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connexion échouée: " . $conn->connect_error);
}

$sql = "SELECT * FROM demande WHERE emprunter = 1";
$result = $conn->query($sql);


$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, ('Rapport des Emprunts'), 0, 1, 'C');
$pdf->Ln(15);


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, utf8_decode('Nom et prénom'), 1, 0, 'C');
$pdf->Cell(30, 10, ('CNI'), 1, 0, 'C');
$pdf->Cell(50, 10, utf8_decode('Nom du Matériel'), 1, 0, 'C');
$pdf->Cell(20, 10, utf8_decode('Quantité'), 1, 0, 'C');
$pdf->Cell(40, 10, utf8_decode('Date d\'Emprunt'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode('Restauré'), 1, 1, 'C');


$pdf->SetFont('Arial', '', 8);

while ($row = $result->fetch_assoc()) {
  $pdf->Cell(30, 10, utf8_decode($row['nom_user']), 1, 0, 'C'); 
  $pdf->Cell(30, 10, ($row['cni_user']), 1, 0, 'C');
  $pdf->Cell(50, 10, utf8_decode($row['nom_materiel']), 1, 0, 'C');
  $pdf->Cell(20, 10, $row['qauntit'], 1, 0, 'C');
  $pdf->Cell(40, 10, $row['date_emprunt'], 1, 0, 'C');
  
  if ($row['date_r'] == null) {
    $pdf->Cell(30, 10, ('Non'), 1, 1, 'C');
  } else {
    $pdf->Cell(30, 10, ( $row['date_r']), 1, 1, 'C');
  }
}

$pdf->Output('Rapport des emprunts.pdf' , 'D');


