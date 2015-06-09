<style>
table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}</style>
<div class="body_section">

	<div class="body_common_section">

			<h3>My Inbox :: Full Message View</h3>

		<?php 
		if ($this->hasInfo){ ?>
				<table>
				 <th>Date</th>
				 <th>From</th>
				 <th>To</th>
				 <th>Subject</th>
				 <th>Body</th>
				<tr>
					<td><?php echo $this->msgInfo->messageTime; ?></td>		
					<td><?php echo $this->msgInfo->fromName; ?></td>		    	
					<td><?php echo $this->msgInfo->toName; ?></td>		    						
					<td><?php echo $this->msgInfo->subject; ?></td>		    	    	
					<td><?php echo $this->msgInfo->messageBody; ?></td>		    	    						
				</tr>
				</table>

		<?php		}
			else {	?>
			Invalid Message!
		<br />


		<?php  } ?>

[	<a href="/messages/home">Back</a> ]

	</div>
</div>
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/messages.js"); ?>