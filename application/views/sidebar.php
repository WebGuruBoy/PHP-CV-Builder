<nav class="nav flex-column cv-text-white">
	<a title="Professional summary" class="link insertSummary">
		<i class="fas fa-bars"></i>
		<span class="text">Professional summary</span>
	</a>
	<a title="Work history" class="link insertWork">
		<i class="fas fa-book"></i>
		<span class="text">Work history</span>
	</a>
	<a title="Education" class="link insertEdu">
		<i class="fas fa-graduation-cap"></i>
		<span class="text">Education</span>
	</a>
	<a title="Skills" class="link insertSkill">
		<i class="fas fa-magic"></i>
		<span class="text">Skills</span>
	</a>
	<a class="link dropdown-toggle" data-toggle="dropdown">
		<i class="fas fa-plus" aria-hidden="true"></i>
		<span class="text">Add a section</span>
	</a>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<a class="dropdown-item" onclick="addOtherPartWithTitle('Accomplishments', 'cv-acc')">Accomplishments</a>
		<a class="dropdown-item" onclick="addOtherPartWithTitle('Affiliations', 'cv-aff')">Affiliations</a>
		<a class="dropdown-item" onclick="addOtherPartWithTitle('Certifications', 'cv-cert')">Certifications</a>
		<a class="dropdown-item" onclick="addOtherPartWithTitle('Additional information', 'cv-add')">Additional information</a>
		<a class="dropdown-item addOtherPart">Add Your Own</a>
	</div>
</nav>