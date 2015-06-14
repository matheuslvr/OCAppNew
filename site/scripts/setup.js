
function changeToEdit(el) {
			alert(el)
				document.getElementById(el).style.display = "block"
				/*"
					<td class='title' valign='center'> First Name TESTE </td>"/*
					<td class='middle' align='center' valign='center'> <input type='text' value='<?php echo $first_name ?>'> </td>
					<td align='right' class='edit' valign='center' onclick='document.getElementById('save').submit()> Save </td></form>
				</tr>" */
		}

		function changeStyle(el) {
    		var display = document.getElementById(el).style.display;
    		if(display == "none")
        		document.getElementById(el).style.display = 'block';
    		else
        		document.getElementById(el).style.display = 'none';
		}