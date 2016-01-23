$(function(){
 $('.my-info-top a').tooltip({
	 trigger : 'hover'
 });
 //$('.panel-heading img').tooltip({
 //    trigger : 'hover'
 //});
 $('.panel-heading img').popover({
	 trigger : 'hover'
 });
 $('.my-happy img').popover({
	 trigger : 'hover'
 });

 $(".member-menu li a[name = "+actionName+"]").addClass("my-active");
 
 
 
});