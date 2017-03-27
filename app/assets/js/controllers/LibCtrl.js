/*jshint -W117 */

window.LibCtrl = (function(){
    "use strict"; 

    var _self = this;

    _self.initPjax = function() {
        if ($.support.pjax){
            console.log('support pjax');

            $.pjax.defaults.timeout = false; 
            $(document).pjax('a.pjax', '#page-content');
            $(document).on('pjax:beforeSend', function(event, xhr, settings) {
                $("#loading").show();
            });
            $(document).on('pjax:send', function(){
                console.log('pjax send');
            });
            $(document).on('pjax:complete', function(){
                console.log('pjax complete');
                $("#loading").hide();

		        init_sparklines();
		        init_flot_chart();
		        init_wysiwyg();
		        init_InputMask();
		        init_JQVmap();
		        init_cropper();
		        init_knob();
		        init_IonRangeSlider();
		        init_ColorPicker();
		        init_TagsInput();
		        init_parsley();
		        init_daterangepicker();
		        init_daterangepicker_right();
		        init_daterangepicker_single_call();
		        init_daterangepicker_reservation();
		        init_SmartWizard();
		        init_EasyPieChart();
		        init_charts();
		        init_echarts();
		        init_morris_charts();
		        init_skycons();
		        init_select2();
		        init_validator();
		        init_DataTables();
		        init_chart_doughnut();
		        init_gauge();
		        init_PNotify();
		        init_starrr();
		        init_calendar();
		        init_compose();
		        init_CustomNotification();
		        init_autosize();
		        init_autocomplete();

            });
            $(document).on('pjax:error', function(err) {
                console.log('pjax:error');
                console.log(err);
            });
            $(document).on('pjax:timeout', function() {
                console.log('pjax:timeout');
            });
        }
 
    };
    
    return _self;

}).call(this);
