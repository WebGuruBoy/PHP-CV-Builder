<?php
	$this->document->loadRenderer('head');
	$base_url = $this->config->item('base_url');
	$this->document->setType("text/html");
	$this->document->setMimeEncoding($this->document->_type);
	$this->document->setMetaData('cache-control', 'no-cache', true);
	$this->document->setMetaData('pragma', 'no-cache', true);
	$this->document->addStyleSheet($base_url.CSS_PATH."bootstrap.min.css");
	$this->document->addStyleSheet($base_url.CSS_PATH."all.min.css");
	$this->document->addStyleSheet($base_url.CSS_PATH."jquery-ui.css");
	$this->document->addStyleSheet($base_url.CSS_PATH."jquery.auto-complete.css");
	//$this->document->addStyleSheet($base_url.CSS_PATH."our.css");
	$this->document->addStyleSheet($base_url.CSS_PATH."mainframe.css");
	$this->document->addScript($base_url.JS_PATH."jquery-3.4.1.min.js");
	$this->document->addScript($base_url.JS_PATH."jquery.nicescroll.min.js");
	$this->document->addScript($base_url.JS_PATH."jquery-ui.js");
	$this->document->addScript($base_url.JS_PATH."popper.min.js");
	$this->document->addScript($base_url.JS_PATH."bootstrap.min.js");
	$this->document->addScript($base_url."resources/tinymce/tinymce.min.js");
	$this->document->addScript($base_url.JS_PATH."jquery.auto-complete.min.js");
	$this->document->addScript($base_url.JS_PATH."script.js");
	
	$this->document->setTitle($this->lang->line('CV_BUILDER'));	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<?php echo $this->document->head->render(true);?>
		<!-- META FOR IOS & HANDHELD -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<style type="text/stylesheet">
			@-webkit-viewport	{ width: device-width; }
			@-moz-viewport		{ width: device-width; }
			@-ms-viewport		{ width: device-width; }
			@-o-viewport		{ width: device-width; }
			@viewport			{ width: device-width; }
		</style>
		<script type="text/javascript">
			//<![CDATA[
			if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
				var msViewportStyle = document.createElement("style");
				msViewportStyle.appendChild(
					document.createTextNode("@-ms-viewport{width:auto!important}")
				);
				document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
			}
			//]]>
		</script>
		<meta name="HandheldFriendly" content="true"/>
		<meta name="apple-mobile-web-app-capable" content="YES"/>
	<!-- //META FOR IOS & HANDHELD -->
	</head>
<body>
<div class="off-canvas-overlay"></div>

<div class="off-canvas boxscroll">
	<div class="wrap">
		<ul class="list-group">
			<?php for($i=1;$i<=30;$i++):?>
			<li class="list-group-item">
				<a href="<?php echo $this->baseurl,'cvedit/cvlogin/',$i;?>">
					<?php if($i!= 15 && $i != 16):?>
					<img src="<?php echo $this->baseurl,'assets/images/tpl/',($i),'.svg';?>" alt="Cinque Terre" width="600" height="400">
					<?php else:?>
					<img src="<?php echo $this->baseurl,'assets/images/tpl/',($i),'.jpg';?>" alt="Cinque Terre" width="600" height="400">
					<?php endif;?>
				</a>
			</li>
			<?php endfor;?>
		</ul>
	</div>
</div>
<div class="dgnav-group">
	<div class="dg-nav container-fluid"> 
		<div class="row">
			<div class="col-sm-6">
				<a href="<?php echo $this->baseurl;?>">
				<img class ="dgmark" src="<?php echo $this->baseurl;?>assets/images/logo_blue.png" >
				</a>
			</div>
			<div class="col-sm-6 dg-slogan">Free Online CV Builder with  our simple CV Templates</div>
		</div>
  	</div>
  	<div class="nav-menu">
  		<div class="container">
  			<div class="row">
  				<div class="col-auto mr-auto"></div>
  				<div class="col-auto">
					<ul class="mb-0">
						<?php if(! $this->session->userdata('user_id')):?>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $base_url;?>cvedit/cvlogin"><i class="fas fa-sign-in-alt">&nbsp;</i>Sign In</a>
						</li>
						<?php else:?>
						<li class="nav-item">
							<a href="#" class="off-canvas-toggle nav-link"><i class="fas fa-award"></i> CV templates</a>
						</li>
						<li class="nav-item">
							<a class="nav-link"><i class="fas fa-user">&nbsp;</i> <?php echo $this->session->userdata('fullname');?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $base_url;?>cvedit/cvlogout"><i class="fas fa-sign-out-alt">&nbsp;</i>Logout</a>
						</li>
						<?php endif;?>
					</ul>
				</div>
			</div>
		</div>
  	</div>
  <div class="main-container container-fluid">
    <div class="row justify-content-md-center">
        <div class="left-side col-sm-2">
          <?php 
          if(isset($lsidebar) && $lsidebar!=''){
            $this->load->view($lsidebar); 
          }
          ?>
        </div>
        <div class="middle-side col-sm-8">
          <div class="content <?php if(isset($btnflag) && $btnflag) echo 'pdfwrap';?>">
			<?php 
			if(isset($content) && $content!=''){
				$this->load->view($content); 
			}
			?>
			<?php if(isset($btnflag) && $btnflag):?>
          	<div class="bookmark"><a id="expertPDF" href="#"><i class="fas fa-print"></i></a></div>
			<?php endif;?>
          </div>
        </div>
        <div class="right-side col-sm-2">
          <?php 
            if(isset($rsidebar) && $rsidebar!=''){
              $this->load->view($rsidebar); 
            }
            ?>
        </div>
    </div>
    <div class="row justify-content-md-center">
    	<?php 
		if(isset($firstpage) && $firstpage!=''){
			$this->load->view($firstpage); 
		}
		?>
    </div>
  </div>
<div class="modal " id="myModal" data-backdrop="false" >
	<div class="modal-dialog dg-modal modal-xl">
		<div class="modal-content">
		<!-- Modal Header -->
			<div class="dg-mo-header">
			  <h4 class="dg-mo-title">Modal Heading</h4>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="cv-other-name">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label ">Section Title</label>
								<input id="cv_other_name" type="text" tabindex="1" name="job_title" value="" maxlength="60" title="Job Title" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="cv-work">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label ">Job Title</label>
								<input id="job_title" type="text" tabindex="1" name="job_title" value="" placeholder="e.g. Account representative" maxlength="60" title="Job Title" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label ">Employer</label>
								<input id="employer" type="text" tabindex="2" name="employer" value="" placeholder="e.g. Somersby &amp; Smithers" maxlength="60" title="Employer" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group position-relative">
								<label class="control-label">City/Town</label>
								<input id="workcity" type="text" value="" class="form-control " maxlength="60" placeholder="e.g. Birmingham" tabindex="3" name="city" title="City/Town">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">County</label>
								<input id="workcountry" type="text" value="" class="form-control " maxlength="60" placeholder="e.g. West Midlands" tabindex="4" name="country" title="County">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label ">Start Month</label>
										<select id="work_s_month" name="s_month" class="form-control">
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
										<select id="work_s_year" name="s_year" class="form-control">
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
										<select id="work_e_month" name="e_month" class="form-control">
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
										<select id="work_e_year" name="e_year" class="form-control">
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
					</div>
				</div>
				<div class="cv-edu">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label ">Institution Name</label>
								<input id="schoolname" type="text" tabindex="2" name="inst_name" value="" placeholder="e.g. University of Liverpool" maxlength="60" title="Institution Name" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<label class="control-label">Institution Location</label>
							<input id="schoolcity" type="text" tabindex="2" name="inst_loc" value="" placeholder="e.g. University of Liverpool" maxlength="60" title="Institution Name" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label ">Enter your degree</label>
								<input id="degree" type="text" tabindex="4" name="degree" value="" maxlength="60" title="Enter your degree" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label ">Field of Study</label>
								<input id="study_field" type="text" tabindex="5" name="study_field" value="" placeholder="e.g. Economics" title="FIELD OF STUDY" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group grad-year">
								<label class="control-label ">Year of graduation</label>
								<input id="grad_year" type="text" tabindex="6" name="graduated_year" value="" placeholder="e.g. 2015" maxlength="60" title="YEAR OF GRADUATION" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<p class="cv-work">Work Details</p>
				<p class="cv-edu">Education Details</p>
				<div class="row">
					<div class="col">
						<textarea id="texteditor" class="tiny-editor"></textarea>
					</div>
					<div class="col cv-sample">
						<div class="form-group has-search">
						<span class="fa fa-search form-control-feedback"></span>
						<input type="text" id="cv-field"class="form-control" placeholder="Search">
						</div>
						<div class="sample-wrap">

						</div>
					</div>
				</div>
			</div>

		<!-- Modal footer -->
			<div class="modal-footer">
			  <button type="button" class="btn btn-success btn-change" >Save</button>
			  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			  <input type="hidden" id="fieldType">
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="base_url" value="<?php echo $base_url;?>">
<script type="text/javascript">
	<?php if(isset($this->fields)):?>
	cvfield = <?php echo json_encode($this->fields);?>;
	$('#cv-field').autoComplete({
    	minChars: 1,
    	source: function(term, suggest){
	        term = term.toLowerCase();
	        var choices = cvfield;
	        var matches = [];
	        for (i=0; i<choices.length; i++)
	            if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
	        suggest(matches);
	    },
		onSelect: function(e, term, item){
			getSampleContent(term);
			searchFieldVal = term;
		}
	});
	<?php endif;?>
</script>
</body>
</html>