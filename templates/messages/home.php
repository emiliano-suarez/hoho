<style>
table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}</style>
<div class="body_section">

	<div class="body_common_section">

			<h3>My Inbox</h3>

		<?php 
		if ($this->hasInfo){ ?>
				<table>
				 <th>Date</th>
				 <th>From</th>
				 <th>Subject</th>
		 <?php
			for ($x=0; $x<count($this->allMessages); $x++){ ?>
				<tr>
					<td><?php echo $this->allMessages[$x]->messageTime; ?></td>		
					<td><?php echo $this->allMessages[$x]->fromName; ?></td>		    	
					<td><a href="/messages/view?msgid=<?php echo $this->allMessages[$x]->id; ?>"><?php echo $this->allMessages[$x]->subject; ?></a></td>		    	    	
				</tr>
		<?php 
			} 
				echo "</table>";

				}
			else {	?>
			No messages here
		<br />


		<?php  } ?>

	</div>
</div>
<?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/messages.js"); ?>