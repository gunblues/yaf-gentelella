window.MyUtil=function(){"use strict";var a=this;return a.is_touch_device=function(){return"ontouchstart"in window||"onmsgesturechange"in window},a.fbShare=function(a,b,c,d,e,f){var g=screen.height/2-f/2,h=screen.width/2-e/2;window.open("http://www.facebook.com/sharer.php?s=100&p[title]="+b+"&p[summary]="+c+"&p[url]="+a+"&p[images][0]="+d,"sharer","top="+g+",left="+h+",toolbar=0,status=0,width="+e+",height="+f)},a.getQueryStringValue=function(a){return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]"+encodeURIComponent(a).replace(/[\.\+\*]/g,"\\$&")+"(?:\\=([^&]*))?)?.*$","i"),"$1"))},a}.call(this),window.LibCtrl=function(){"use strict";var a=this;return a.initPjax=function(){$.support.pjax&&($.pjax.defaults.timeout=!1,$(document).pjax("a.pjax","#page-content"),$(document).on("pjax:beforeSend",function(a,b,c){$("#loading").show()}),$(document).on("pjax:send",function(){}),$(document).on("pjax:complete",function(){$("#loading").hide(),init_sparklines(),init_flot_chart(),init_wysiwyg(),init_InputMask(),init_JQVmap(),init_cropper(),init_knob(),init_IonRangeSlider(),init_ColorPicker(),init_TagsInput(),init_parsley(),init_daterangepicker(),init_daterangepicker_right(),init_daterangepicker_single_call(),init_daterangepicker_reservation(),init_SmartWizard(),init_EasyPieChart(),init_charts(),init_echarts(),init_morris_charts(),init_skycons(),init_select2(),init_validator(),init_DataTables(),init_chart_doughnut(),init_gauge(),init_PNotify(),init_starrr(),init_calendar(),init_compose(),init_CustomNotification(),init_autosize(),init_autocomplete()}),$(document).on("pjax:error",function(a){}),$(document).on("pjax:timeout",function(){}))},a}.call(this),$(function(){"use strict";$("#loading").hide(),LibCtrl.initPjax()});