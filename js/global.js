var ajaxMsg = {
		'delete': {
			success: "Položka bola úspešne zmazaná",
			error: "Položku sa nepodarilo zmazať"
		},
		'stateChange': {
			success: "Položka bola úspešne upravená",
			error: "Položku sa nepodarilo upraviť"
		},
};

$(document).ready(function() {
	
	$(".datepicker" ).datepicker({ minDate: 1, dateFormat: "yy-mm-dd" });
	
	$('.ajax').click(function(e){
		var id = $(this).attr('ajax-id');
		var postUrl = $(this).attr('href');
		var action = $(this).attr('ajax-action');
		
		msgs = ajaxMsg[action]; 
		
		e.preventDefault();
		
		$.post(postUrl, "id="+id, function(data,status){
			var result = JSON.parse(data);
			if(result === true) {
				$('#'+id).addClass('hideAnim');
				setTimeout(function(){
					$('#'+id).remove();
					noty({type: 'success', text: msgs.success, timeout: 3000, force: false, modal: false, maxVisible: 5, killer: false, closeWith: ['click'], layout: 'top'});
				}, 200);
			} else {
				noty({type: 'error', text: msgs.error, timeout: 3000, force: false, modal: false, maxVisible: 5, killer: false, closeWith: ['click'], layout: 'top'});
			}
		});
		
		return false;
	});	
	
	//This function is for the form submit
	$(document).on("click", "a.form_submit", function(){
		$(this).closest('form').submit();
		return false;
	});	
	//This function is for the form submit

	//This function is for the dropdown module
	$(document).on("click", "a.dropdown_button", function(){
		$('.dropdown').stop().slideUp();
		$(this).next().stop().slideToggle();
		return false;
	});	
	//This function is for the dropdown module

	//This function is for the dropdown module, this is the close button
	$(document).on("click", ".dropdown .close", function(){
		$(this).closest('.dropdown').stop().slideUp();
		return false;
	});
	//This function is for the dropdown module, this is the close button

	//This is the custom checkbox call, works with every checkbox input, that has checkbox class	
	$('input.checkbox').customcheckbox();
	//This is the custom checkbox call, works with every checkbox input, that has checkbox class	

	//Empty the input, when clicked(Search input)		
	$('.module.search input').emptyonclick();
	//Empty the input, when clicked(Search input)		
});

/*
* jQuery message plugin
*
* Created by Peter Viszt (gtpassatgt@gmail.com) on 2010-10-01.
*
*/
(function(a){a.fn.Message=function(b){var c={type:"error",time:2000,text:"Error!",target:"#messages",click:true};var b=a.extend(c,b);var d=Math.ceil(Math.random()*10000);return this.each(function(){var e='<div class="'+b.type+'" id="'+d+'" style="display:none"><div class="tl"></div><div class="tr"></div><div class="desc"><p>'+b.text+'</p></div><div class="bl"></div class="br"><div></div></div>';a(b.target).append(e);if(b.click){a("#"+d).addClass("click_close")}a("#"+d).slideDown(function(){setTimeout(function(){a("#"+d).slideUp(function(){a("#"+d).remove()})},b.time)});a(document).on("click",".click_close",function(){a(this).slideUp(function(){a(this).remove()})})})}})(jQuery);

/*
* jQuery custom checkbox plugin
*
* Created by Peter Viszt (gtpassatgt@gmail.com) on 2010-10-01.
*
*/
(function(a){a.fn.customcheckbox=function(){return this.each(function(){obj=a(this);var b=obj.html();var c=obj.attr("name");var e="customcheckbox_"+c;var f="checkbox_"+c;var d='<a href="" class="checkbox" id="'+e+'"><small></small></a>';obj.after(d);obj.attr("id",f);if(obj.attr("checked")){a("a#"+e).addClass("on")}else{a("a#"+e).addClass("off")}a("a#"+e).click(function(){var g=a(this);if(g.hasClass("on")){g.find("small").stop().animate({left:23});g.removeClass("on").addClass("off");a("input#"+f).removeAttr("checked")}else{g.find("small").stop().animate({left:0});g.removeClass("off").addClass("on");a("input#"+f).attr("checked","checked")}return false})})}})(jQuery);

/*
* jQuery emptyonclick plugin
*
* Created by Andreas Creten (andreas@madewithlove.be) on 2008-06-06.
* Copyright (c) 2008 madewithlove. All rights reserved.
*
*/
jQuery.fn.extend({emptyonclick:function(a){return this.each(function(){new jQuery.EmptyOnClick(this,a)})}});jQuery.EmptyOnClick=function(c,b){var a=$(c).val();$(c).bind("focus",function(d){if(a==$(this).val()){$(this).val("")}}).bind("blur",function(d){if(!$(this).val()){$(this).val(a)}});$("form:has(#"+c.id+")").bind("reset",function(d){$(c).val(a);$(c).removeClass(b.changeClass)}).bind("submit",function(d){if($(c).val()==a){$(c).val("")}})};