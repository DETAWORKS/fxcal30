<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Language" content="hu" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Forex AI heti hozam kalkulátor - Forex AI</title>
		<style>
			body {
				background-color: #f2f2f2;
			}

			table {
				border-collapse: collapse;
				width: 100%;
			}

			th, td {
				border: 1px solid black;
				padding: 8px;
				text-align: left;
			}

			th {
				background-color: #f2f2f2;
			}

		</style>

</head>
<body>

<h2>Forex AI heti hozam kalkulátor</h2>
<h4 style='font-size: 18px; font-weight:bold;'><a target="" href="https://bit.ly/forexai-kalkulator">Új számítás</a></h4>
<p style='font-size: 16px; font-weight:bold; font-style:italic;'>Jelmagyarázat:</p>
<p>
Féléves levonás hete(i):
<svg width="80" height="22" style="vertical-align: bottom;">
  <rect width="60" height="20" style="fill:white;stroke-width:0.1;stroke:black;" />
</svg>
<br>
Teljes kezdő egyenleg megtérüléstől:
<svg width="80" height="22" style="vertical-align: bottom;">
  <rect width="60" height="20" style="fill:lightgreen;stroke-width:0.1;stroke:black;" />
</svg>
<br>
Féléves levonás összege:
<svg width="80" height="22" style="vertical-align: bottom;">
  <rect width="60" height="20" style="fill:red;stroke-width:0.1;stroke:black" />
</svg>
</p>
<p>
  <!-- Az oldal tartalma -->
  <button id="back-to-top-button" title="Oldal Teteje">&uarr; Fel</button>
  <button id="back-to-bottom-button" title="Oldal Alja">Le &darr;</button>
  
  <!-- A kód stílusa -->
  <style>
	#back-to-top-button {
	  display: none;
	  position: fixed;
	  bottom: 20px;
	  right: 20px;
	  z-index: 99;
	  font-size: 18px;
	  border: none;
	  outline: none;
	  background-color: blue;
	  color: white;
	  cursor: pointer;
	  padding: 15px;
	  border-radius: 4px;
	}
	#back-to-bottom-button {
	  display: none;
	  position: fixed;
	  bottom: 20px;
	  right: 100px;
	  z-index: 99;
	  font-size: 18px;
	  border: none;
	  outline: none;
	  background-color: blue;
	  color: white;
	  cursor: pointer;
	  padding: 15px;
	  border-radius: 4px;
	}

	#back-to-top-button:hover {
	  background-color: #555;
	}
	#back-to-bottom-button:hover {
	  background-color: #555;
	}
  </style>

  <!-- A kód script része -->
  <script>
  // When the user scrolls down 20px from the top of the document, show the buttons
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("back-to-top-button").style.display = "block";
          document.getElementById("back-to-bottom-button").style.display = "block";
      } else {
          document.getElementById("back-to-top-button").style.display = "none";
          document.getElementById("back-to-bottom-button").style.display = "none";
      }
  }

  // When the user clicks on the "Back to Top" button, scroll to the top of the document
  document.getElementById("back-to-top-button").addEventListener("click", function() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
  });

  // When the user clicks on the "Back to Bottom" button, scroll to the bottom of the document
  document.getElementById("back-to-bottom-button").addEventListener("click", function() {
      document.body.scrollTop = document.body.scrollHeight;
      document.documentElement.scrollTop = document.documentElement.scrollHeight;
  });
  </script>
</p>
<p style='font-size: 16px; font-weight:bold; font-style:italic;'>Lekérdezett adatok:</p>

<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	//if (isset($_POST["sub"])) {
	//if (!empty($_POST["sub"])) {
    $principal = $_POST["principal"];
	echo "Kezdő egyenleg: $principal USDT</br>";
    $interest = $_POST["interest"];
	echo "Heti kamat: $interest % </br>";
    $start_date = $_POST["start_date"];
	echo "Kezdő dátum: $start_date </br>";
    $years = $_POST["years"];
	echo "Futamidő: $years év</br>";
    $weeks = $years*52;
 	echo "Hetek száma: $weeks </br>";
    $half_year = 26;
    $half_year_deduct = 0.3;
    $profit = 0;
    $total_profit = 0;
    $half_year_deduct_total = 0;
	$next_week = $half_year + 1;
 	echo "<p></p>";
	
    if ($years < 0.5) {
        echo "Minimum half year required";
    } else if ($years > 5) {
        echo "Maximum 5 years allowed";
    } else {
		echo "<table>";
		echo "
		<tr>
		<th>Hét</th>
		<th>Heti kezdő egyenleg</th>
		<th>Heti Hozam</th>
		<th>Heti záró egyenleg</th>
		<th>Összes Hozam</th>
		<th>Kötelező féléves 30%-os levonás</th>
		<th>Nettó kikérhető hozam</th>
		<th>Nettó kikérhető hozam %-ban</th>
		<th>Dátum</th>
		</tr>";
        for ($i = 1; $i <= $weeks; $i++) {
            
            if ($i % $half_year == 0 && $i != 0) { //levonás hét
				$start_principal = $end_principal;
				$profit = ($start_principal * $interest) / 100;
				$end_principal = $start_principal + $profit;
				$total_profit += $profit;
				$netto_profit = ($total_profit * 0.7);
				$netto_profit_percent = ($netto_profit / $principal) * 100;
				$date = date("Y-m-d", strtotime("+$i weeks", strtotime($start_date)));
                $half_year_deduct_total += ($end_principal - $principal) * $half_year_deduct;
				
                //echo "<tr style='background-color: #04AA6D;'>";
                echo "<tr style='background-color: white;'>";
                echo "<td style='font-weight:bold;'>" . $i . "</td>";
                echo "<td>" . number_format($start_principal, 2, '.', '') . "</td>";
                echo "<td>" . number_format($profit, 2, '.', '') . "</td>";
                echo "<td style='font-weight:bold;'>" . number_format($end_principal, 2, '.', '') . "</td>";
                echo "<td>" . number_format($total_profit, 2, '.', '') . "</td>";
                echo "<td style='font-weight:bold; background-color:red;'>" . number_format($half_year_deduct_total, 2, '.', '') . "</td>";
				if ($netto_profit >= $principal){
				echo "<td style='font-weight:bold; background-color:lightgreen;'>" . number_format($netto_profit, 2, '.', '') . "</td>";	
				}else{
				echo "<td style='font-weight:bold;'>" . number_format($netto_profit, 2, '.', '') . "</td>";								
				}
				echo "<td>" . number_format($netto_profit_percent, 2, '.', '') . "</td>";								
				echo "<td>" . $date . "</td>";
                echo "</tr>";
            } else {
				    if ($i == $next_week && $i != 0) { //levonás utáni hét
						$start_principal = $end_principal - $half_year_deduct_total;
						$profit = ($start_principal * $interest) / 100;
						$end_principal = $start_principal + $profit;
						$total_profit = $end_principal - $principal;
						$netto_profit = ($total_profit * 0.7);
						$netto_profit_percent = ($netto_profit / $principal) * 100;
						$date = date("Y-m-d", strtotime("+$i weeks", strtotime($start_date)));
						$half_year_deduct_total = 0;
						$next_week = $half_year + $next_week;
						echo "<tr>";
						//echo "<tr style='background-color: #f1f1f1;'>";
						echo "<td style='font-weight:bold;'>" . $i . "</td>";
						echo "<td>" . number_format($start_principal, 2, '.', '') . "</td>";
						echo "<td>" . number_format($profit, 2, '.', '') . "</td>";
						echo "<td style='font-weight:bold;'>" . number_format($end_principal, 2, '.', '') . "</td>";
						echo "<td>" . number_format($total_profit, 2, '.', '') . "</td>";
						echo "<td>" . number_format($half_year_deduct_total, 2, '.', '') . "</td>";
						if ($netto_profit >= $principal){
						echo "<td style='font-weight:bold; background-color:lightgreen;'>" . number_format($netto_profit, 2, '.', '') . "</td>";	
						}else{
						echo "<td style='font-weight:bold;'>" . number_format($netto_profit, 2, '.', '') . "</td>";								
						}
						echo "<td>" . number_format($netto_profit_percent, 2, '.', '') . "</td>";								
						echo "<td>" . $date . "</td>";
						echo "</tr>";
						}else{ // minden maradék hét
						$start_principal = $principal;
						$start_principal += $total_profit;
						$profit = ($start_principal * $interest) / 100;
						$end_principal = $start_principal + $profit;
						$total_profit += $profit;
						$netto_profit = ($total_profit * 0.7);
						$netto_profit_percent = ($netto_profit / $principal) * 100;
						$date = date("Y-m-d", strtotime("+$i weeks", strtotime($start_date)));
						$half_year_deduct_total = 0;
						echo "<tr>";
						echo "<td style='font-weight:bold;'>" . $i . "</td>";
						echo "<td>" . number_format($start_principal, 2, '.', '') . "</td>";
						echo "<td>" . number_format($profit, 2, '.', '') . "</td>";
						echo "<td style='font-weight:bold;'>" . number_format($end_principal, 2, '.', '') . "</td>";
						echo "<td>" . number_format($total_profit, 2, '.', '') . "</td>";
						echo "<td>" . number_format($half_year_deduct_total, 2, '.', '') . "</td>";
						if ($netto_profit >= $principal){
						echo "<td style='font-weight:bold; background-color:lightgreen;'>" . number_format($netto_profit, 2, '.', '') . "</td>";	
						}else{
						echo "<td style='font-weight:bold;'>" . number_format($netto_profit, 2, '.', '') . "</td>";								
						}
						echo "<td>" . number_format($netto_profit_percent, 2, '.', '') . "</td>";								
						echo "<td>" . $date . "</td>";
						echo "</tr>";							
						}												
					}
					
        }
        echo "</table>";		
    }

	// Összes profit és levonás megjelenítése
	echo "<p style='font-size: 16px; font-weight:bold; font-style:italic;'>Eredmény:</p>";
	echo "Kezdő egyenleg: " . number_format($principal, 2) . " USDT</br>";
	echo "Záró egyenleg: " . number_format($end_principal, 2) . " USDT</br>";
	echo "Összes profit: " . number_format($total_profit, 2) . " USDT</br>";
	echo "Minimum Kikérés: 100 USDT (2023.02.10-től)</br>";
	echo "Kikérés díja: 8 USDT (2023.02.10-től)</br>";
	$netto_profit = ($total_profit - 8 ) * 0.7;
	echo "Nettó kikérhető profit: " . number_format($netto_profit, 2) . " USDT</br>";

	
}else{	
	echo "<h4 style='font-size: 18px; font-weight:bold; background-color: red;'>Hiányzó adatok, kattintson a linkre!</h4>";
}

?>
