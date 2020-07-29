<div class="choose-tpl-header">
Now, let’s fill out your school
		<p class="dg-select-tpl">Include every school, even if you're still there or didn't graduate.</p>
</div>
<form method="post" action="">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label ">Institution Name</label>
				<input type="text" tabindex="2" name="inst_name" value="" placeholder="e.g. University of Liverpool" maxlength="60" title="Institution Name" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<label class="control-label">Institution Location</label>
			<input type="text" tabindex="2" name="inst_loc" value="" placeholder="e.g. University of Liverpool" maxlength="60" title="Institution Name" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label ">Enter your degree</label>
				<input type="text" tabindex="4" name="degree" value="" maxlength="60" title="Enter your degree" class="form-control">
			</div>
		</div>
		<div class="col-md-6 d-none">
			<div class="form-group">
				<label class="control-label ">Degree</label>
				<select name="e_month" class="form-control">
					<option value="01">Jan</option>
					<option value="02">Feb</option>
					<option value="03">Mar</option>
					<option value="04">Apr</option>
					<option value="05">May</option>
					<option value="06">Jun</option>
					<option value="07">Jul</option>
					<option value="08">Aug</option>
					<option value="09">Sep</option>
					<option value="10">Oct</option>
					<option value="11">Nov</option>
					<option value="12">Dec</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label ">Field of Study</label>
				<input type="text" tabindex="5" name="study_field" value="" placeholder="e.g. Economics" title="FIELD OF STUDY" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group grad-year">
				<label class="control-label ">Year of graduation</label>
				<input type="text" tabindex="6" name="graduated_year" value="" placeholder="e.g. 2015" maxlength="60" title="YEAR OF GRADUATION" class="form-control">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p>Work Details</p>
			<textarea class="tiny-editor" name="edu_detail"></textarea>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6 text-left"><button type="submit" class="btn btn-info" name="postype" value="more">Save and More</button></div>
		<div class="col-md-6 text-right"><button type="submit" class="btn btn-success" name="postype" value="next">Save and Next</button></div>
	</div>
</form>