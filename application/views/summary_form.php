<form method="post" action="<?php echo $this->baseurl?>cvedit/summary">

	<div class="choose-tpl-header">
		Let’s fill out about your background
		<p class="dg-select-tpl">Write a career summary to show companies how your background matches the job you want.</p>
		<textarea class="tiny-editor" name="summary_detail"></textarea>
	</div>
	<hr>
	<div class="text-right">
		<a class="btn btn-warning" href="<?php echo $this->baseurl?>cvedit/weblink">Skip</a>
		<button type="submit" class="btn btn-success" >Save and Next</button>
	</div>
</form>