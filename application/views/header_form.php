<div class="container">	
	<div class="choose-tpl-header">
		Please answer a few questions about yourself:
		<p class="dg-select-tpl">We will help you create a CV</p>
	</div>
	<div class="form-wrap">
	<form method="post" action="<?php echo $this->baseurl?>cvedit/cvheader">
	<div class="row">
		<div class="col">
			<div class="form-group">
				<label class="control-label ">First Name</label>
				<input type="text" tabindex="1" name="fname" value="" maxlength="50" class="form-control" autocomplete="given-name">
			</div>
		</div>
		<div class="col">
			<div class="form-group">
				<label class="control-label ">Surname</label>
				<input type="text" tabindex="2" name="lname" value="" maxlength="50" class="form-control" autocomplete="family-name">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<label class="control-label ">Street Address</label>
				<input type="text" tabindex="3" name="street" value="" maxlength="150" class="form-control" autocomplete="shipping street-address">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-6">
			<div class="form-group position-relative suggestion-empty">
				<label class="control-label">City/Town</label>
				<input type="text" value="" class="form-control " maxlength="100" tabindex="4" name="city">
			</div>
		</div>
		<div class="col-6 col-xl-3 pr-xl-0">
			<label class="control-label">County</label>
			<input type="text" value="" class="form-control " maxlength="50" tabindex="5" name="country">
		</div>
		<div class="col-6 col-xl-3 pl-xl-3">
			<label class="control-label">Postcode</label>
			<input type="text" value="" class="form-control " maxlength="10" tabindex="6" name="postcode">
		</div>
	</div>
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label class="control-label ">Phone</label>
				<input type="text" tabindex="7" name="phone" value="" maxlength="14" class="form-control">
			</div>
		</div>
		<div class="col-6 autosuggestEmail">
			<label class="control-label">Email Address</label>
			<input type="text" value="" class="form-control " maxlength="50" tabindex="9" name="email">
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<label class="control-label">Password</label>
			<input type="password" value="" class="form-control " maxlength="50" tabindex="9" name="password">
		</div>
	</div>
	<hr>
	<div class="row justify-content-between">
		<div class="col-3">
			<a class="btn btn-warning" href="<?php echo $this->baseurl;?>cvedit/cvlogin">Back</a>
		</div>
		<div class="col-3 text-right">
			<button type="submit" class="btn btn-success">Next</button>
		</div>
	</div>
	</form>
	</div>
</div>