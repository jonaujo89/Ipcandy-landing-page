require('../../lib/datetimePicker/jquery.datetimepicker.css');
require('../../lib/datetimePicker/jquery.datetimepicker.js');

lp.dateText = ui.text.extend({
    init: function (o) {
        this._super(o);
		var dateTime = $(this).attr('data-datetime');
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
	var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
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
		title: "Countdown settings",
        items: [   
			{
                name: 'type', type: 'radio', margin: "15px 0", items: [
                    { label: "Exact date", value: 'datetime' },
					{ label: "Every month", value: 'monthly' },
					{ label: "Every week", value: 'weekly' },
					{ label: "Every day", value: 'daily' },
                ]
            },
			{
                name: "date", type: lp.dateText, width: "30%", margin: "5px",
				showWhen: { type: 'datetime' }	
            },
			{
                name: "day", type: teacss.ui.select,
				items: Items_day(),
				width: "15%", margin: "0",
				showWhen: { type: 'monthly' }	
            },
			{
                name: "dayOfWeek", 
				type: teacss.ui.select,
				items: DayOfWeek(),
				width: "30%", margin: "0", 
				showWhen: { type: 'weekly' }	
            },				
			{
                name: "time", type: lp.timeText, width: "30%", margin: "5px", 
            },
        ]
    }
});