<div class="choose-tpl-header">
		Now, let’s fill out your work history 
		<p class="dg-select-tpl">What do you want your CV to look like?</p>
</div>
<form method="post" action="<?php echo $this->baseurl?>cvedit/work_his">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label ">Job Title</label>
				<input type="text" tabindex="1" name="job_title" value="" placeholder="e.g. Account representative" maxlength="60" title="Job Title" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label ">Employer</label>
				<input type="text" tabindex="2" name="employer" value="" placeholder="e.g. Somersby &amp; Smithers" maxlength="60" title="Employer" class="form-control">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group position-relative">
				<label class="control-label">City/Town</label>
				<input type="text" value="" class="form-control " maxlength="60" placeholder="e.g. Birmingham" tabindex="3" name="city" title="City/Town">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">County</label>
				<input type="text" value="" class="form-control " maxlength="60" placeholder="e.g. West Midlands" tabindex="4" name="country" title="County">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label ">Start Month</label>
						<select name="s_month" class="form-control">
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
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label ">Start Year</label>
						<select name="s_year" class="form-control">
							<?php 
							for($i=1980;$i <= @date('Y'); $i++){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label ">End Month</label>
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
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label ">End Year</label>
						<select name="e_year" class="form-control">
							<?php 
							for($i=1950;$i <= @date('Y'); $i++){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p>Work Details</p>
			<textarea class="tiny-editor" name="work_detail"></textarea>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6 text-left"><button type="submit" class="btn btn-info" name="postype" value="more">Save and More</button></div>
		<div class="col-md-6 text-right"><button type="submit" class="btn btn-success" name="postype" value="next">Save and Next</button></div>
	</div>
</form>