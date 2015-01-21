require('../../lib/datetimePicker/jquery.datetimepicker.css');
require('../../lib/datetimePicker/jquery.datetimepicker.js');

lp.dateText = ui.text.extend({
    init: function (o) {
        this._super(o);
		var dateTime = $(this).attr('data-datetime');
        this.input.css({lineHeight: 1.8, textAlign: "center"});
        this.input.datetimepicker({
			animation: false, 
			days: true,
			timepicker: false,
			format:'Y/m/d',
			closeOnDateSelect: true,
			mask:true,
			minDate: new Date(),
		});
    }
});
lp.timeText = ui.text.extend({
    init: function (o) {
        this._super(o);
        this.input.css({lineHeight: 1.8, textAlign: "center"});
        this.input.datetimepicker({
			animation: false, 
			days: true,
			datepicker: false,
			format:'H:i',
			step: 30,
			mask:true,
		});
    }
});

function Items_day(){
	var items = [];
	for (i=1; i<=31; i++){
		items.push({
			label: i,
			value: i
		});
	};	
	return items;
};

function DayOfWeek(){
	var items = [];
	var days = [_t('Monday'),_t('Tuesday'),_t('Wednesday'),_t('Thursday'),_t('Friday'),_t('Saturday'),_t('Sunday')];
	for (i=0; i<7; ++i){
		items.push({
			label: days[i],
			value: i
		});
	};	
	return items;
};

lp.countdown = lp.cover.extendOptions({
	change: function(){ 		
		var countdown = this.element.find(".countdown");
		countdown.removeAttr("data-datetime"); 	
		countdown.attr("data-datetime" , '{"type":"'+this.value.type+'","date":"'+this.value.date+'","day":"'+this.value.day+'","dayOfWeek":"'+this.value.dayOfWeek+'","time":"'+this.value.time+'"}');
        Component.previewFrame.window.$(countdown).lpCounty();
    },
    configForm: {
		title: _t("Countdown settings"),
        width: "200px",
        items: [            
			{
                name: 'type', type: 'radio', margin: "5px 0 5px", items: [
                    { label: _t("Exact date<br>"), value: 'datetime' },
					{ label: _t("Every month<br>"), value: 'monthly' },
					{ label: _t("Every week<br>"), value: 'weekly' },
					{ label: _t("Every day<br>"), value: 'daily' },
                ]
            },
              
            "<hr>",       
                    
            {   type: "label", value: _t("Date:"), width: "65%", margin: "5px 5% 5px 0", 
				showWhen: { type: 'datetime' }
            },
            {   type: "label", value: _t("Day:"), width: "65%", margin: "5px 5% 5px 0" ,
				showWhen: { type: 'monthly' }
            },
            {   type: "label", value: _t("Day of week:"), width: "65%", margin: "5px 5% 5px 0" ,
				showWhen: { type: 'weekly' }
            },        
            {   type: "label", value: _t("Time:"), width: "25%", margin: "5px 5% 5px 0", showWhen: { type: ['datetime','monthly','weekly'] } }, 
            {   type: "label", value: _t("Time:"), width: "100%", margin: "11px 70% 5px 0", showWhen: { type: 'daily' }},
           
                    
                    
			{
                name: "date", type: lp.dateText, width: "65%", margin: "5px 5% 5px 0",
				showWhen: { type: 'datetime' }	
            },
			{
                name: "day", type: teacss.ui.select,
				items: Items_day(),
				width: "65%", margin: "5px 5% 5px 0",
				showWhen: { type: 'monthly' }	
            },            
			{
                name: "dayOfWeek", 
				type: teacss.ui.select,
				items: DayOfWeek(),
				width: "65%", margin: "5px 5% 5px 0", 
				showWhen: { type: 'weekly' }	
            },
			{
                name: "time", type: lp.timeText, width: "25%", margin: "5px 5% 5px 0"
            },
        ]
    }
});