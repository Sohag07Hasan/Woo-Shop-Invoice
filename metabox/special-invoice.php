<style>
<!--
	div.special-invoice textarea{
		width: 100%
	}
-->
</style>

<?php 
	$special_invoice_text = $this->get_special_infoice_text($post->ID);
?>

<div class="special-invoice">
	
	<p> This note will only be sent in the invoice (at the top before payment details)</p>
	<textarea rows="5" name="spcial_invoice_text"><?php echo $special_invoice_text; ?></textarea>
	
</div>