<form method="post" action="<?php echo $this->baseurl?>cvedit/others">
	<input type="hidden" name="others" value="others">
	<div class="clearfix">
		<p class="dg-select-tpl">Accomplishments</p>
		<textarea class="tiny-editor" name="acc_detail"></textarea>
	</div>
	<div class="clearfix">
		<p class="dg-select-tpl">Affiliations</p>
		<textarea class="tiny-editor" name="aff_detail"></textarea>
	</div>
	<div class="clearfix">
		<p class="dg-select-tpl">Certifications</p>
		<textarea class="tiny-editor" name="cert_detail"></textarea>
	</div>
	<div class="clearfix">
		<p class="dg-select-tpl">Your own Section</p>
		<div class="form-group">
			<label class="control-label ">Section Name</label>
			<input type="text" tabindex="2" name="other_name" value="" maxlength="60" class="form-control">
		</div>
		<div class="form-group">
			<label class="control-label ">Section Content</label>
			<textarea class="tiny-editor" name="other_detail"></textarea>
		</div>
	</div>
	<hr>
	<div class="text-right">
		<a class="btn btn-warning" href="<?php echo $this->baseurl?>cvedit/overview">Skip</a>
		<button type="submit" class="btn btn-success" >Save and Next</button>
	</div>
</form>