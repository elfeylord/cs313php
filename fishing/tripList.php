<?php
	echo("<p>Select the month you desire to fish on:</p>");
					echo("<select type = 'list' id = 'month' name = 'month' form = 'lookup'>
							<option value = '01' selected = 'selected'/> Jan
							<option value = '02'/> Feb
							<option value = '03'/> March
							<option value = '04'/> April
							<option value = '05'/> May
							<option value = '06'/> June
							<option value = '07'/> July
							<option value = '08'/> Aug
							<option value = '09'/> Sept
							<option value = '10'/> Oct
							<option value = '11'/> Nov
							<option value = '12'/> Dec
						</select>
						<select type = 'list' name = 'year' id = 'year' form = 'lookup'>
							<option value = '" . (intval(date("Y"))) . "'selected = 'selected'/>" . (intval(date("Y"))) .
							"<option value = '" . (intval(date("Y")) + 1) . "'/>" . (intval(date("Y")) + 1) .
							"<option value = '" . (intval(date("Y")) + 2) . "'/>" . (intval(date("Y")) + 2) .
							"<option value = '" . (intval(date("Y")) + 3) . "'/>" . (intval(date("Y")) + 3) .
							"<option value = '" . (intval(date("Y")) + 4) . "'/>" . (intval(date("Y")) + 4) .
							"<option value = '" . (intval(date("Y")) + 5) . "'/>" . (intval(date("Y")) + 5) .
						"</select>
					<form id = 'lookup' action = 'bookTripSignedIn.php' method = 'POST'>
						<input type = 'submit' value = 'Enter'/>
						
					</form>");
?>