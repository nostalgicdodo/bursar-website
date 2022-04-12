<?php
?>
<div dir="ltr">
	<br>
	<div style="color: black">An enquiry has been made:</div>
	<div>
		<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Arial;width:0px;border-collapse:collapse;border:none">
			<colgroup>
				<col width="100">
				<col width="175">
			</colgroup>
			<tbody>
				<tr style="height:27px">
					<td style="overflow:hidden;padding:2px 3px;vertical-align:middle;border:1px solid rgb(204,204,204)">Name</td>
					<td style="overflow:hidden;padding:2px 3px;vertical-align:middle;text-align:right;border:1px solid rgb(204,204,204)"><?= $name ?></td>
				</tr>
				<tr style="height:27px">
					<td style="overflow:hidden;padding:2px 3px;vertical-align:middle;background-color:rgb(243,243,243);border:1px solid rgb(204,204,204)">Company</td>
					<td style="overflow:hidden;padding:2px 3px;vertical-align:middle;background-color:rgb(243,243,243);text-align:right;border:1px solid rgb(204,204,204)"><?= $company ?></td>
				</tr>
				<tr style="height:27px">
					<td style="overflow:hidden;padding:2px 3px;vertical-align:middle;border:1px solid rgb(204,204,204)">Phone number</td>
					<td style="overflow:hidden;padding:2px 3px;vertical-align:middle;font-family:'Courier New';text-align:right;border:1px solid rgb(204,204,204)"><a href="tel:<?= $phoneNumber ?>"><?= $phoneNumber ?></a></td>
				</tr>
				<tr style="height:27px">
					<td style="overflow:hidden;padding:2px 3px;vertical-align:middle;background-color:rgb(243,243,243);border:1px solid rgb(204,204,204)">Email address</td>
					<td style="overflow:hidden;padding:2px 3px;vertical-align:middle;background-color:rgb(243,243,243);text-align:right;border:1px solid rgb(204,204,204)"><a href="mailto:<?= $emailAddress ?>"><?= $emailAddress ?></a></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div>
		<br>
	</div>
	<div class="color: black">— the bursar butler bot, aka <i>"the botler"</i></div>
	<div>
		<br>
	</div>
</div>
