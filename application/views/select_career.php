<form method="post" action="<?php echo $this->config->item('base_url');?>/cvedit/cvheader">
<div>
	<label>Experience Level</label>
	<select name="exp_lv">
		<?php foreach ($exp_lv as $value){
		echo '<option value="'.$value["id"].'">'.$value["level_name"].'</option>';	
		}
		?>
	</select>
</div>
<div>
	<label>Career Field</label>
	<select id="careerField" name="career">
		<?php foreach ($career as $value){
		echo '<option value="'.$value["id"].'">'.$value["career_name"].'</option>';	
		}
		?>
	</select>
</div>
<div>
	<label>Sub Career Field</label>
	<select id="subCareerField" name="subcareer">
		
	</select>
</div>
</form>