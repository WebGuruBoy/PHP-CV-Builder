<form method="post" action="<?php echo $this->baseurl?>cvedit/weblink">
<div class="clearfix">
	<div class="col-12">
		<p class="subhead choose-tpl-header">Add your website, portfolio or professional profiles.</p>
	</div>
</div>
<div class="clearfix">
	<div class="col-5">
		<div class="form-group">
			<label class="control-label ">Personal Link 1</label>
			<input type="text" tabindex="1" name="link1" value="" maxlength="100" title="Personal link 1" class="form-control">
		</div>
		<div class="form-group">
			<label class="control-label ">Personal Link 2</label>
			<input type="text" tabindex="2" name="link2" value="" maxlength="100" title="Personal link 2" class="form-control">
		</div>
		<div class="form-group">
			<label class="control-label ">Personal Link 3</label>
			<input type="text" tabindex="3" name="link3" value="" maxlength="100" title="Personal link 3" class="form-control">
		</div>
	</div>
</div>
<div class="clearfix">
	<div class="col-12 text-right">
		<a class="btn btn-warning" href="<?php echo $this->baseurl?>cvedit/others">Skip</a>
		<button type="submit" class="btn btn-success" >Save and Next</button>
	</div>
</div>
</form>