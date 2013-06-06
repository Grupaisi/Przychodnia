

<?php




     require_once'../pdf/fpdf.php';

     $daneKliniki = $_POST['daneKliniki'];
     $imie = $_POST['imie'];
     $nazwisko = $_POST['nazwisko'];
     $adres = $_POST['adres'];
     $pesel = $_POST['pesel'];

     $nazwaLeku = $_POST['nazwaLeku'];
     $dawka = $_POST['dawka'];
     $postac = $_POST['postac'];
     $ilosc = $_POST['ilosc'];
     $sposobDawkowania = $_POST['sposobDawkowania'];


     $pdf = new FPDF('P', 'mm', array(82, 172));
     $pdf->AddPage();
     $pdf->SetLeftMargin(18);
     $pdf->Image('nowa_recepta_nasza.png', 0, 0, 82, 172);
     $pdf->SetFont('Arial', '', 9);

//Dane Kliniki
     $pdf->MultiCell(0, -12, "29435675756");
     $pdf->MultiCell(0, 6, "");
     $pdf->MultiCell(0, 3, "
$daneKliniki");
     $pdf->SetLeftMargin(10);
     $pdf->MultiCell(0, 9, "");

// Dane Pacjenta
     $pdf->SetRightMargin(20);
     $pdf->MultiCell(0, 4, "$imie $nazwisko");
     $pdf->MultiCell(0, 4, "$adres");
     $pdf->MultiCell(0, 4, "pesel: $pesel");

// Wypisany Lek
     $pdf->SetFont('Arial', '', 11);
     $pdf->MultiCell(0, 14, "");
     $pdf->MultiCell(0, 4, "$nazwaLeku");
     $pdf->MultiCell(0, 4, "$dawka");
     $pdf->MultiCell(0, 4, "$postac");
     $pdf->MultiCell(0, 4, "$ilosc");
     $pdf->MultiCell(0, 4, "$sposobDawkowania");
     $pdf->Output();

?>