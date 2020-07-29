tinymce.init({
    selector:   ".tiny-editor",
    height: 300,
    plugins: "code,lists,advlist",
});
var targetObject;
var insertHTML = '';
var imgurl;
var bookmarkPos;
var cvfield;
var searchFieldVal = "Accountants";

// Close on mouseup and touchend
$(document).on('mouseup touchend', function(event) {
  var offCanvas = $('.off-canvas')
  if (!offCanvas.is(event.target) && offCanvas.has(event.target).length === 0) {
    $('body').removeClass('off-canvas-active')
  }
});
$(document).ready(function(){
	if($(".bookmark").length > 0)
		bookmarkPos = $(".bookmark").position().top;
	$(".boxscroll").niceScroll(".wrap");
	$("div.text-row .dg-wrap").removeClass("rawData");
	$("div.text-row .dg-wrap").addClass("cv-modified");
	$(window).scroll(function(){
		var scrollLength = $(this).scrollTop();
		if(scrollLength > 150){
			$(".bookmark").css("top", bookmarkPos+scrollLength-150);
		}
	});
	$('.off-canvas-toggle').on('click', function(event) {
		event.preventDefault();
		$('body').toggleClass('off-canvas-active');
	});

	$("#careerField").change(function(){
		$.ajax({
			url: $("#base_url").val() + 'cvedit/getSubCareer/'+$(this).val(),
			type: "POST",
			data: {},
			success: function(data) {
				$("#subCareerField").html(data);
			}
		});
	});
	
	$("#expertPDF").click(function(){
		var html = $("#phpContent").html();
		var form = '<form method="post" id="sendform"><input type="hidden" name="htmlcontent" value=""></form>';
		$("body").append(form);
		$("#sendform input").val(html);
		$("#sendform").submit();
	});
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
	});

	$('.btn-file :file').on('fileselect', function(event, label) {
	    
	    var input = $(this).parents('.input-group').find(':text'),
	        log = label;
	    
	    if( input.length ) {
	        input.val(log);
	    }
    
	});
	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $(input).parents('.previewer').find('.img-upload').attr('src', e.target.result);
	        }
	        
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(".dg-edit").click(function(){
		editContent($(this));
	});
	$(".dg-trash").click(function(){
		var postData = new Object();
		var curDom = $(this).parents("li")[0];
		if($(curDom).parent().hasClass("workhis")){
			postData.cvid = $(curDom).find(".dg-wrap").attr("cv-id");
			postData['type'] = 'work';
		}
		if($(curDom).parent().hasClass("edu-wrap")){
			postData.cvid = $(curDom).find(".dg-wrap").attr("cv-id");
			postData['type'] = 'edu';
		}
		if($(curDom).hasClass("cv-acc")){
			postData['type'] = 'acc';
		}
		if($(curDom).hasClass("cv-aff")){
			postData['type'] = 'aff';
		}
		if($(curDom).hasClass("cv-cert")){
			postData['type'] = 'cert';
		}
		if($(curDom).hasClass("cv-add")){
			postData['type'] = 'add';
		}
		if($(curDom).hasClass("cv-other")){
			postData['type'] = 'other';
			postData['title'] = $(curDom).find(".dg-wrap").children(".heading").find("span").text();
		}
		if($(curDom).hasClass("summaryPart")){
			postData['type'] = 'summary';
		}
		if($(curDom).hasClass("skillPart")){
			postData['type'] = 'skill';
		}
		$.ajax({
			url: $("#base_url").val() + 'welcome/trashContent',
			type: "POST",
			data: postData,
			success: function(data) {

			}
		});
		$(this).parent().remove();
	});
	$(".imgInp").change(function(){
	    readURL(this);
	});
	$(".btn-change").click(function(){
		var postData = new Object();
		postData.flag = 'insert';
		var html = tinymce.get("texteditor").getContent();
		if($(targetObject).hasClass("cv-modified")){
			postData.flag = 'update';
			postData.cvid = $(targetObject).attr("cv-id");
		}
		$(targetObject).addClass("cv-modified");
		$(targetObject).removeClass("rawData");
		$(targetObject).parents(".dg-wrap").removeClass("rawData");
		$(targetObject).html(html);
		postData['html'] = html;
		if($(targetObject).hasClass("cv-work-detail")){
			postData['type'] = 'work';
			postData.s_date = $("#work_s_month").val() + "/" + $("#work_s_year").val();
			postData.e_date = $("#work_e_month").val() + "/" + $("#work_e_year").val();
			postData.jobtitle = $("#job_title").val();
			postData.employer = $("#employer").val();
			postData.workcity = $("#workcity").val();
			postData.workcountry = $("#workcountry").val();
			$(targetObject).parents("li").find(".cv-work-sdate").text(postData.s_date);
			$(targetObject).parents("li").find(".cv-work-edate").text(postData.e_date);
			$(targetObject).parents("li").find(".cv-job-title").text(postData.jobtitle);
			$(targetObject).parents("li").find(".cv-work-employer").text(postData.employer);
			$(targetObject).parents("li").find(".cv-work-city").text(postData.workcity);
			$(targetObject).parents("li").find(".cv-work-country").text(postData.workcountry);
		}
		if($(targetObject).hasClass("cv-edu-detail")){
			postData['type'] = 'edu';
			postData.grad_year = $("#grad_year").val();
			postData.schoolname = $("#schoolname").val();
			postData.schoolcity = $("#schoolcity").val();
			postData.degree = $("#degree").val();
			postData.study_field = $("#study_field").val();
			$(targetObject).parents("li").find(".cv-edu-year").text(postData.grad_year);
			$(targetObject).parents("li").find(".cv-edu-degree").text(postData.degree);
			$(targetObject).parents("li").find(".cv-edu-field").text(postData.study_field);
			$(targetObject).parents("li").find(".cv-edu-school").text(postData.schoolname);
			$(targetObject).parents("li").find(".cv-edu-city").text(postData.schoolcity);
		}
		if($(targetObject).parents("li").hasClass("cv-acc")){
			postData['type'] = 'acc';
		}
		if($(targetObject).parents("li").hasClass("cv-aff")){
			postData['type'] = 'aff';
		}
		if($(targetObject).parents("li").hasClass("cv-cert")){
			postData['type'] = 'cert';
		}
		if($(targetObject).parents("li").hasClass("cv-add")){
			postData['type'] = 'add';
		}
		if($(targetObject).parents("li").hasClass("cv-other")){
			postData['type'] = 'other';
			postData['title'] = $("#cv_other_name").val();
			$(targetObject).parents("li").find(".heading").find("span").text($("#cv_other_name").val());
		}
		if($(targetObject).parents("li").hasClass("summaryPart")){
			postData['type'] = 'summary';
		}
		if($(targetObject).parents("li").hasClass("skillPart")){
			postData['type'] = 'skill';
		}
		$.ajax({
			url: $("#base_url").val() + 'welcome/modifyContent',
			type: "POST",
			data: postData,
			success: function(data) {
				if($(targetObject).hasClass("cv-work-detail")
					|| $(targetObject).hasClass("cv-edu-detail")){
					$(targetObject).attr("cv-id", data);
				}
				$("#myModal").modal("hide");
			}
		});
		
	});
	$(".dg-work-plus").click(function(){
		addWorkList($(this));
	});
	$(".dg-edu-plus").click(function(){
		addEduList($(this));
	});
	$(".insertWork").click(function(){
		if($(".addablePart .workHisPart").length > 0) return false;
		if($("#splittype").length>0){
			addContent2SplitType("Work history", "workHisPart",'<ul class="workhis ui-sortable" id="work4"></ul>');
			addWorkList(null);
			return;
		}
		if($("#circletype").length>0){
			addContent2CircleType("Work history", "workHisPart",'<ul class="workhis ui-sortable" id="work4"></ul>');
			addWorkList(null);
			return;
		}
		var miscHTML = '';
		if($("#misc1").length>0){
			miscHTML = '<div class="dg-divided"></div>';
		}
		var html = '<li class="text-row ui-sortable-handle workHisPart"><div class="heading"><h5><span>Work history</span></h5></div>'+miscHTML+'<span class="button dg-work-plus" onclick="addWorkList(this)"><i class="fas fa-plus-circle"></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="li-under"><div class="dg-wrap"><ul class="workhis ui-sortable" id="work4"  data-status-id="4"><li class="text-row ui-sortable-handle"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit "></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="singlecolumn"><span class=" cv-italic cv-work-duration"><span class="cv-work-sdate">00/0000</span><span> - </span><span class="cv-work-edate">xx/xxxx</span></span><div class="cv-job-title">Job Title</div><div><span class="cv-work-employer">employer</span><span> - </span><span class="cv-work-city">city</span><span>, </span><span class="cv-work-country">country</span></div><div class="cv-work-detail dg-wrap"><ul><li>some content...</li></ul></div></div></li></ul></div></div></li>';
		$(".addablePart").append(html);
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});
	$(".insertSummary").click(function(){
		if($(".addablePart .summaryPart").length > 0) return false;
		if($("#splittype").length>0){
			addContent2SplitType("Professional summary", "summaryPart",'<p>Content here...</p>');
			return;
		}
		if($("#circletype").length>0){
			addContent2CircleType("Professional summary", "summaryPart",'<p>Content here...</p>');
			return;
		}
		var miscHTML = '';
		if($("#misc1").length>0){
			miscHTML = '<div class="dg-divided"></div>';
		}
		var html = '<li class="text-row ui-sortable-handle summaryPart"><div class="heading"><h5><span>Professional Summary</span></h5></div>'+miscHTML+'<span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit"></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="dg-wrap"><div class="li-under">content here...</div></div></li>';
		$(".addablePart").append(html);
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});
	$(".insertSkill").click(function(){
		if($(".addablePart .skillPart").length > 0) return false;
		if($("#splittype").length>0){
			addContent2SplitType("Skills", "skillPart", '<p>Content here...</p>');
			return;
		}
		if($("#circletype").length>0){
			addContent2CircleType("Skills", "skillPart",'<p>Content here...</p>');
			return;
		}
		var miscHTML = '';
		if($("#misc1").length>0){
			miscHTML = '<div class="dg-divided"></div>';
		}
		var html = '<li class="text-row ui-sortable-handle skillPart"><div class="heading"><h5><span>Skills</span></h5></div>'+miscHTML+'<span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit"></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="dg-wrap"><div class="li-under">content here...</div></div></li>';
		$(".addablePart").append(html);
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});
	$(".insertEdu").click(function(){
		if($(".addablePart .eduPart").length > 0) return false;
		if($("#splittype").length>0){
			addContent2SplitType("Education", "eduPart",'<ul class="edu-wrap ui-sortable" id="edu4"></ul>');
			addEduList(null);
			return;
		}
		if($("#circletype").length>0){
			addContent2CircleType("Education", "eduPart",'<ul class="edu-wrap ui-sortable" id="edu4"></ul>');
			addEduList(null);
			return;
		}
		var miscHTML = '';
		if($("#misc1").length>0){
			miscHTML = '<div class="dg-divided"></div>';
		}
		var html = '<li class="text-row ui-sortable-handle eduPart"><div class="heading"><h5><span>Education</span></h5></div>'+miscHTML+'<span class="button dg-edu-plus" onclick="addEduList(this)"><i class="fas fa-plus-circle"></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="li-under"><div class="dg-wrap"><ul class="edu-wrap ui-sortable" id="edu4"><li class="text-row ui-sortable-handle"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit "></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="singlecolumn"><span class=" cv-italic cv-edu-year">xxxx</span><div><span class="cv-edu-degree">Degree</span><span> : </span><span class="cv-edu-field">Study field</span></div><div><span class="cv-edu-school">Institution Name</span><span> - </span><span class="cv-edu-city">Institution Location</span></div><div class="cv-edu-detail dg-wrap"><ul><li>some content...</li></ul></div></div></li></ul></div></div></li>';
		$(".addablePart").append(html);
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});
	$(".addOtherPart").click(function(){
		if($("#splittype").length>0){
			insertHTML = '<li class="text-row ui-sortable-handle cv-other"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit "></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="section first-section"><div class="heading"><div class="sectiontitle"><span>Your Own Section</span></div></div><img id="pdf-circle" src="'+imgurl+'" width="12px"><div class="paragraph firstparagraph"><div class="field singlecolumn tpl29-single dg-wrap cv-modified"><p>Content here...</p></div></div></div></li>';
			$(".addablePart").append(insertHTML);
			$("html, body").animate({ scrollTop: $(document).height() }, 1000);
			return;
		}
		if($("#circletype").length>0){
			insertHTML = '<li class="text-row ui-sortable-handle cv-other"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit "></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="heading"><img id="pdf-circle" src="'+imgurl+'" width="12px" height="12px"><h5><span>Your Own Section</span></h5></div><div class="li-under dg-wrap cv-modified"><p>Content here...</p></div></li>';
			$(".addablePart").append(insertHTML);
			$("html, body").animate({ scrollTop: $(document).height() }, 1000);
			return;
		}
		var miscHTML = '';
		if($("#misc1").length>0){
			miscHTML = '<div class="dg-divided"></div>';
		}
		var html = '<li class="text-row ui-sortable-handle cv-other"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit"></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="heading"><h5><span>Setion Name</span></h5></div>'+miscHTML+'<div class="li-under dg-wrap cv-modified">Content here...</div></li>';
		$(".addablePart").append(html);
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});
});
function addOtherPartWithTitle(title, classname) {
	if($("#splittype").length>0){
		insertHTML = '<li class="text-row ui-sortable-handle '+classname+'"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit "></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="section"><div class="heading"><div class="sectiontitle"><span>'+title+'</span></div></div><img id="pdf-circle" src="'+imgurl+'" width="12px"><div class="paragraph"><div class="field singlecolumn tpl29-single dg-wrap cv-modified"><p>Content here...</p></div></div></div></li>';
		$(".addablePart").append(insertHTML);
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
		return;
	}
	if($("#circletype").length>0){
		insertHTML = '<li class="text-row ui-sortable-handle '+classname+'"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit "></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="heading"><img id="pdf-circle" src="'+imgurl+'" width="12px" height="12px"><h5><span>'+title+'</span></h5></div><div class="dg-wrap cv-modified li-under"><p>Content here...</p></div></li>';
		$(".addablePart").append(insertHTML);
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
		return;
	}
	var miscHTML = '';
	if($("#misc1").length>0){
		miscHTML = '<div class="dg-divided"></div>';
	}
	var html = '<li class="text-row ui-sortable-handle  '+classname+'"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit"></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="heading"><h5><span>'+title+'</span></h5></div>'+miscHTML+'<div class="dg-wrap cv-modified li-under"></div></li>';
	$(".addablePart").append(html);
	$("html, body").animate({ scrollTop: $(document).height() }, 1000);
}
function editContent(o) {
	$("#myModal .dg-mo-title").html($(o).parent().find("h5").text());
	targetObject = $(o).parent().find(".dg-wrap");
	
	if($(targetObject).hasClass("cv-modified"))
		tinymce.get("texteditor").setContent($(o).parent().find(".dg-wrap").html());
	else
		tinymce.get("texteditor").setContent("");
	$(".cv-work").addClass("hidden");
	$(".cv-edu").addClass("hidden");
	$(".cv-sample").addClass("hidden");
	$(".cv-other-name").addClass("hidden");
	if($(o).parents(".ui-sortable").hasClass("workhis")){
		$(".cv-work").removeClass("hidden");
		$("#fieldType").val("work");
		$(".cv-sample").removeClass("hidden");
		$("#job_title").val($(o).parent().find(".cv-job-title").text());
		$("#employer").val($(o).parent().find(".cv-work-employer").text());
		$("#workcity").val($(o).parent().find(".cv-work-city").text());
		$("#workcountry").val($(o).parent().find(".cv-work-country").text());
		var sdate = $(o).parent().find(".cv-work-sdate").text();
		var sdate_year_month = sdate.split(/[\D]+/);
		var edate = $(o).parent().find(".cv-work-edate").text();
		var edate_year_month = edate.split(/[\D]+/);
		$("#work_s_month").val(sdate_year_month[0].length > 2 ? sdate_year_month[1]:sdate_year_month[0]);
		$("#work_s_year").val(sdate_year_month[0].length > 2 ? sdate_year_month[0]:sdate_year_month[1]);
		$("#work_e_month").val(edate_year_month[0].length > 2 ? edate_year_month[1]:edate_year_month[0]);
		$("#work_e_year").val(edate_year_month[0].length > 2 ? edate_year_month[0]:edate_year_month[1]);
		getSampleContent(searchFieldVal);
	}
	if($(o).parents(".ui-sortable").hasClass("edu-wrap")){
		$(".cv-edu").removeClass("hidden");
		$("#fieldType").val("edu");
		$(".cv-sample").removeClass("hidden");

		$("#schoolname").val($(o).parent().find(".cv-edu-school").text());
		$("#schoolcity").val($(o).parent().find(".cv-edu-city").text());
		$("#degree").val($(o).parent().find(".cv-edu-degree").text());
		$("#study_field").val($(o).parent().find(".cv-edu-field").text());
		$("#grad_year").val($(o).parent().find(".cv-edu-year").text());
		getSampleContent(searchFieldVal);
	}
	if($(o).parent().hasClass("summaryPart")){
		$("#fieldType").val("summary");
		$(".cv-sample").removeClass("hidden");
		getSampleContent(searchFieldVal);
	}
	if($(o).parent().hasClass("skillPart")){
		$("#fieldType").val("skill");
		$(".cv-sample").removeClass("hidden");
		getSampleContent(searchFieldVal);
	}
	if($(o).parent().hasClass("cv-other")){
		$(".cv-other-name").removeClass("hidden");
		$("#cv_other_name").val($(o).parent().find(".heading").find("span").text());
		getSampleContent(searchFieldVal);
	}
	$("#cv-field").val(searchFieldVal);
	//getSampleContent(null);
	$("#myModal").modal("show");
}
function addWorkList(o) {
	var html = '<li class="text-row ui-sortable-handle"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit "></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="singlecolumn"><span class=" cv-italic cv-work-duration"><span class="cv-work-sdate">00/0000</span><span> - </span><span class="cv-work-edate">xx/xxxx</span></span><div class="cv-job-title">Job Title</div><div><span class="cv-work-employer">employer</span><span> - </span><span class="cv-work-city">city</span><span>, </span><span class="cv-work-country">country</span></div><div class="cv-work-detail dg-wrap"><ul><li>some content...</li></ul></div></div></li>';
		$(".workhis").append(html);
}
function addEduList(o) {
	var html = '<li class="text-row ui-sortable-handle"><span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit "></i></span><span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="singlecolumn"><span class=" cv-italic cv-edu-year">xxxx</span><div><span class="cv-edu-degree">Degree</span><span> : </span><span class="cv-edu-field">Study field</span></div><div><span class="cv-edu-school">Institution Name</span><span> - </span><span class="cv-edu-city">Institution Location</span></div><div class="cv-edu-detail dg-wrap"><ul><li>some content...</li></ul></div></div></li>';
		$(".edu-wrap").append(html);
}
function removeContent(o) {
	$(o).parent().remove();
}
function addContent2SplitType(hHtml, classHtml, samplecontent) {
	insertHTML = '<li class="text-row ui-sortable-handle '+classHtml+'">';
	if(classHtml == 'workHisPart'){
		editHtml = '<span class="button dg-work-plus" onclick="addWorkList(this)"><i class="fas fa-plus-circle"></i></span>';
	} else if(classHtml != 'workHisPart') {
		editHtml = '<span class="button dg-edu-plus" onclick="addEduList(this)"><i class="fas fa-plus-circle"></i></span>';
	} else {
		editHtml = '<span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit"></i></span>';
	}
	insertHTML += editHtml + '<span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="section"><div class="heading"><div class="sectiontitle">'+hHtml+'</div></div><img id="pdf-circle" src="'+imgurl+'" width="12px"><div class="paragraph"><div class="singlecolumn tpl29-single dg-wrap">'+samplecontent+'</div></div></div></li>';
	$(".addablePart").append(insertHTML);
	$("html, body").animate({ scrollTop: $(document).height() }, 1000);
}
function addContent2CircleType(hHtml, classHtml, samplecontent) {
	insertHTML = '<li class="text-row ui-sortable-handle '+classHtml+'">';
	if(classHtml == 'workHisPart'){
		editHtml = '<span class="button dg-work-plus" onclick="addWorkList(this)"><i class="fas fa-plus-circle"></i></span>';
	} else if(classHtml != 'workHisPart') {
		editHtml = '<span class="button dg-edu-plus" onclick="addEduList(this)"><i class="fas fa-plus-circle"></i></span>';
	} else {
		editHtml = '<span class="button dg-edit" onclick="editContent(this)"><i class="fas fa-edit"></i></span>';
	}
	insertHTML += editHtml + '<span class="button dg-trash" onclick="removeContent(this)"><i class="fas fa-trash "></i></span><div class="heading"><img id="pdf-circle" src="'+imgurl+'" width="12px" height="12px"><h5>'+hHtml+'</h5></div><div class="li-under dg-wrap">'+samplecontent+'</div></li>';
	$(".addablePart").append(insertHTML);
	$("html, body").animate({ scrollTop: $(document).height() }, 1000);
}
function getSampleContent(search) {
	/*$.ajax({
		url: $("#base_url").val() + 'cvedit/getSubCareer/'+$(this).val(),
		type: "POST",
		data: {},
		success: function(data) {
			$("#subCareerField").html(data);
		}
	});*/
	$.ajax({
		url: $("#base_url").val() + 'welcome/getSampleContent/'+$("#fieldType").val(),
		type: "POST",
		data: {search:search},
		success: function(data) {
			$(".sample-wrap").html(data);
		}
	});
}
function addSampleContent(o){
	var oldData;
	if($(o).hasClass("active")){
		$(o).removeClass("active");
		oldData = encodeURIComponent(tinymce.get("texteditor").getContent());
		var regex = new RegExp(encodeURIComponent("<li>" + $(o).text() + "</li>"),"g");
		var newData = oldData.replace(regex, "");
		tinymce.get("texteditor").setContent(decodeURIComponent(newData));
	} else {
		$(o).addClass("active");
		oldData = tinymce.get("texteditor").getContent();
		tinymce.get("texteditor").setContent(oldData + "<li>" + $(o).text() + "</li>");
	}
}