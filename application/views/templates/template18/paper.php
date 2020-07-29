<div id="phpContent" class="paperpos">
	<div class="task-board clearfix">
		<div class="cv-page">
		<div class=" user-info">
			<section class="wrapper">
				<div class="cv-title">
				<div class="monogram">
					<div class="cv-circle" width="54px" height="54px">
						<span>CV</span>
					</div>
				</div>
				<div class="paragraph firstparagraph">
					<div class="text-row ui-sortable-handle">
						<span class="button dg-edit"><i class="fas fa-edit "></i></span>
						<div class="dg-wrap">
							<div class="name blue-color">
								<span class="field"><?php echo $userdata['firstname'];?></span>
								<span class="field"><?php echo $userdata['lastname'];?></span>
							</div>
							<div class="address">
								<div><b>Phone : <?php echo $userdata['phone'];?></b></div>
								<div><b>Email : <?php echo $userdata['email'];?></b></div>
								<div><b>Address : <?php echo $userdata['street'].", ".$userdata['city'].", ".$userdata['country']." ".$userdata['postcode'];?></b></div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</section>
		</div>
	<ul class="sortable ui-sortable addablePart" id="sort1"  data-status-id="1">
		<li class=" text-row ui-sortable-handle summaryPart">
			<span class="button dg-edit"><i class="fas fa-edit "></i></span>
			<span class="button dg-trash"><i class="fas fa-trash "></i></span>
			<div class="section">
				<div class="heading">
					<div class="sectiontitle">Professional summary</div>
				</div>
				<div class="paragraph">
					<div class="field singlecolumn tpl29-single dg-wrap <?php if(is_array($cvdata) && isset($cvdata['summary_content']) && $cvdata['summary_content']!='') echo 'cv-modified'; else echo 'rawData';?>">
						<?php if(is_array($cvdata) && isset($cvdata['summary_content']) && $cvdata['summary_content']!=''):?>
							<?php echo $cvdata['summary_content'];?>
						<?php else:?>
							<ul>
								<li>Detail-orientated [Job Title] who consistently exhibits sound judgment when scrutinising complex financial documents.</li>
								<li>Trustworthy [Job Title] with over [number] years in financial statement preparation and general ledger activity.</li>
							</ul>
						<?php endif;?>
					</div>
				</div>
			</div>
		</li>
		<li class=" text-row ui-sortable-handle workHisPart">
			<span class="button dg-work-plus"><i class="fas fa-plus-circle"></i></span>
			<span class="button dg-trash"><i class="fas fa-trash "></i></span>
				<div class="section">
					<div class="heading">
						<div class="sectiontitle">Work history</div>
					</div>
					<div class="paragraph">
						<div class="singlecolumn tpl29-single dg-wrap <?php if(! is_array($workdata)) echo 'rawData';?>">
							<ul class="workhis ui-sortable" id="work4">
							<?php if(is_array($workdata)):?>
								<?php foreach ($workdata as $each):?>
								<li class="text-row ui-sortable-handle">
									<span class="button dg-edit"><i class="fas fa-edit "></i></span>
									<span class="button dg-trash"><i class="fas fa-trash "></i></span>
									<div class="singlecolumn">
										<span class="cv-italic cv-work-duration"><span class="cv-work-sdate"><?php echo $each['s_date'];?></span><span> - </span><span class="cv-work-edate"><?php echo $each['e_date'];?></span></span>
										<div class="cv-job-title"><?php echo $each['job_title'];?></div>
										<div>
											<span class="cv-work-employer"><?php echo $each['employer'];?></span>
											<span> - </span>
											<span class="cv-work-city"><?php echo $each['city'];?></span>
											<span>, </span>
											<span class="cv-work-country"><?php echo $each['country'];?></span>
										</div>
										<div class="cv-work-detail dg-wrap cv-modified" cv-id="<?php echo $each['id'];?>">
											<?php echo $each['desc'];?>
										</div>
									</div>
								</li>
								<?php endforeach;?>
							<?php else:?>
								<li class="text-row ui-sortable-handle">
									<span class="button dg-edit"><i class="fas fa-edit "></i></span>
									<span class="button dg-trash"><i class="fas fa-trash "></i></span>
									<div class="singlecolumn">
										<span class=" cv-italic cv-work-duration"><span class="cv-work-sdate">00/0000</span><span> - </span><span class="cv-work-edate">xx/xxxx</span></span>
										<div class="cv-job-title">Job Title</div>
										<div>
											<span class="cv-work-employer">employer</span>
											<span> - </span>
											<span class="cv-work-city">city</span>
											<span>, </span>
											<span class="cv-work-country">country</span>
										</div>
										<div class="cv-work-detail dg-wrap rawData">
											<ul>
												<li>Led operations involved in running the brand including Marketing, IT, HR/training, development/construction, property and P&amp;L for 200 store locations.</li>
												<li>Oversaw operations for all regional company and franchise locations.</li>
											</ul>
										</div>
									</div>
								</li>
							<?php endif;?>

							</ul>
						</div>
					</div>
				</div>
		</li>
		<li class=" text-row ui-sortable-handle eduPart">
			<span class="button dg-edu-plus"><i class="fas fa-plus-circle"></i></span>
			<span class="button dg-trash"><i class="fas fa-trash "></i></span>
			<div class="section">
				<div class="heading">
					<div class="sectiontitle">Education</div>
				</div>
				<div class="paragraph">
					<div class="singlecolumn tpl29-single dg-wrap <?php if(! is_array($edudata)) echo 'rawData';?>">
						<ul class="edu-wrap ui-sortable" id="edu4">
						<?php if(is_array($edudata)):?>
							<?php foreach ($edudata as $each):?>
							<li class="text-row ui-sortable-handle">
								<span class="button dg-edit"><i class="fas fa-edit "></i></span>
								<span class="button dg-trash"><i class="fas fa-trash "></i></span>
								<div class="singlecolumn">
									<span class="cv-italic cv-edu-year"><?php echo $each['graduated_year'];?></span>
									<div>
										<span class="cv-edu-degree"><?php echo $each['degree'];?></span>
										<span> : </span>
										<span class="cv-edu-field"><?php echo $each['study_field'];?></span>
									</div>
									<div>
										<span class="cv-edu-school"><?php echo $each['inst_name'];?></span>
										<span> - </span>
										<span class="cv-edu-city"><?php echo $each['inst_loc'];?></span>
									</div>
									<div class="cv-edu-detail dg-wrap cv-modified" cv-id="<?php echo $each['id'];?>">
										<?php echo $each['desc'];?>
									</div>
								</div>
							</li>
							<?php endforeach;?>
						<?php else:?>
							<li class="text-row ui-sortable-handle">
								<span class="button dg-edit"><i class="fas fa-edit "></i></span>
								<span class="button dg-trash"><i class="fas fa-trash "></i></span>
								<div class="singlecolumn">
									<span class="cv-italic cv-edu-year">xxxx</span>
									<div>
										<span class="cv-edu-degree">Associate of Arts</span>
										<span> : </span>
										<span class="cv-edu-field">Study field</span>
									</div>
									<div>
										<span class="cv-edu-school">Institution Name</span>
										<span> - </span>
										<span class="cv-edu-city">Institution Location</span>
									</div>
									<div class="cv-edu-detail dg-wrap rawData">
										<ul>
											<li>Coursework in Professional Prospecting Skills</li>
											<li>Student government representative</li>
											<li>Coursework in Speech and Communication, Sociology and Psychology</li>
											<li>Graduated Magna Cum Laude</li>
										</ul>
									</div>
								</div>
							</li>
						<?php endif;?>
						</ul>
					</div>
				</div>
			</div>
		</li>
		<li class=" text-row ui-sortable-handle skillPart">
			<span class="button dg-edit"><i class="fas fa-edit "></i></span>
			<span class="button dg-trash"><i class="fas fa-trash "></i></span>
			<div class="section">
				<div class="heading">
					<div class="sectiontitle">Skills</div>
				</div>
				<div class="paragraph firstparagraph">
					<div class="singlecolumn tpl29-single dg-wrap maincolumn <?php if(is_array($cvdata) && isset($cvdata['skill_content']) && $cvdata['skill_content']!='') echo 'cv-modified'; else echo 'rawData';?>">
					<?php if(is_array($cvdata) && isset($cvdata['skill_content']) && $cvdata['skill_content']!=''):?>
						<?php echo $cvdata['skill_content'];?>
					<?php else:?>
						<div class="row">
							<div class="skil-left col-sm-6">
								<ul class="dg-skill-ul">
									<li>3D Modeling</li>
									<li>Mobile Design</li>
								</ul>
							</div>
						</div>
					<?php endif;?>
					</div>
				</div>
			</div>
		</li>
		<?php if(is_array($cvdata) && isset($cvdata['acc_content']) && $cvdata['acc_content']!=''):?>
		<li class="text-row ui-sortable-handle cv-acc">
			<span class="button dg-edit"><i class="fas fa-edit "></i></span>
			<span class="button dg-trash"><i class="fas fa-trash "></i></span>
			<div class="section">
				<div class="heading">
					<div class="sectiontitle">Accomplishments</div>
				</div>
				<div class="paragraph firstparagraph">
					<div class="singlecolumn tpl29-single dg-wrap cv-modified">
						<?php echo $cvdata['acc_content'];?>
					</div>
				</div>
			</div>
		</li>
		<?php endif;?>
		<?php if(is_array($cvdata) && isset($cvdata['aff_content']) && $cvdata['aff_content']!=''):?>
		<li class="text-row ui-sortable-handle cv-aff">
			<span class="button dg-edit"><i class="fas fa-edit "></i></span>
			<span class="button dg-trash"><i class="fas fa-trash "></i></span>
			<div class="section">
				<div class="heading">
					<div class="sectiontitle">Affiliations</div>
				</div>
				<div class="paragraph firstparagraph">
					<div class="singlecolumn tpl29-single dg-wrap cv-modified">
						<?php echo $cvdata['aff_content'];?>
					</div>
				</div>
			</div>
		</li>
		<?php endif;?>
		<?php if(is_array($cvdata) && isset($cvdata['cert_content']) && $cvdata['cert_content']!=''):?>
		<li class="text-row ui-sortable-handle cv-cert">
			<span class="button dg-edit"><i class="fas fa-edit "></i></span>
			<span class="button dg-trash"><i class="fas fa-trash "></i></span>
			<div class="section">
				<div class="heading">
					<div class="sectiontitle">Certifications</div>
				</div>
				<div class="paragraph firstparagraph">
					<div class="singlecolumn tpl29-single dg-wrap cv-modified">
						<?php echo $cvdata['cert_content'];?>
					</div>
				</div>
			</div>
		</li>
		<?php endif;?>
		<?php if(is_array($cvdata) && isset($cvdata['add_content']) && $cvdata['add_content']!=''):?>
		<li class="text-row ui-sortable-handle cv-add">
			<span class="button dg-edit"><i class="fas fa-edit "></i></span>
			<span class="button dg-trash"><i class="fas fa-trash "></i></span>
			<div class="section">
				<div class="heading">
					<div class="sectiontitle">Additional information</div>
				</div>
				<div class="paragraph firstparagraph">
					<div class="singlecolumn tpl29-single dg-wrap cv-modified">
						<?php echo $cvdata['add_content'];?>
					</div>
				</div>
			</div>
		</li>
		<?php endif;?>
		<?php if(is_array($cvdata) && isset($cvdata['other_content']) && $cvdata['other_content']!=''):?>
		<li class="text-row ui-sortable-handle cv-other">
			<span class="button dg-edit"><i class="fas fa-edit"></i></span>
			<span class="button dg-trash"><i class="fas fa-trash "></i></span>
			<div class="section">
				<div class="heading">
					<div class="sectiontitle"><span><?php echo $cvdata['other_name'];?></span>
					</div>
				</div>
				<div class="paragraph firstparagraph">
					<div class="singlecolumn tpl29-single dg-wrap cv-modified">
						<?php echo $cvdata['other_content'];?>
					</div>
				</div>
			</div>
		</li>
		<?php endif;?>
	</ul>
	</div>
	</div>

</div>
<link rel="stylesheet" href="<?php echo $this->config->item('base_url').CSS_PATH;?>template/paper18.css">
<script type="text/javascript">
	$('ul[id^="sort"]').sortable({
		connectWith: ".sortable",
	}).disableSelection();
	$('ul[id^="work"]').sortable({
		connectWith: ".workhis",
	}).disableSelection();
	$('ul[id^="edu"]').sortable({
		connectWith: ".edu-wrap",
	}).disableSelection();
	imgurl = '<?php echo $this->baseurl. IMAGE_PATH."1.jpg";?>';
</script>