require('./../lib/datetimePicker/jquery.datetimepicker.css');
require('./../lib/datetimePicker/jquery.datetimepicker.js');

lp.dateText = ui.text.extend({
    init: function (o) {
        this._super(o);
		var dateTime = $(this).attr('data-datetime');
        this.input.datetimepicker({
			animation: false, 
			days: true,
			timepicker: false,
			format:'Y/m/d',
			closeOnDateSelect: true
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
			step: 30
		});
    }
});

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
				items: [
					{ label: "1", value: "1" },
					{ label: "2", value: "2" },
					{ label: "3", value: "3" },
					{ label: "4", value: "4" },
					{ label: "5", value: "5" },
					{ label: "6", value: "6" },
					{ label: "7", value: "7" },
					{ label: "8", value: "8" },
					{ label: "9", value: "9" },
					{ label: "10", value: "10" },
					{ label: "11", value: "11" },
					{ label: "12", value: "12" },
					{ label: "13", value: "13" },
					{ label: "14", value: "14" },
					{ label: "15", value: "15" },
					{ label: "16", value: "16" },
					{ label: "17", value: "17" },
					{ label: "18", value: "18" },
					{ label: "19", value: "19" },
					{ label: "20", value: "20" },
					{ label: "21", value: "21" },
					{ label: "22", value: "22" },
					{ label: "23", value: "23" },
					{ label: "24", value: "24" },
					{ label: "25", value: "25" },
					{ label: "26", value: "26" },
					{ label: "27", value: "27" },
					{ label: "28", value: "28" },
					{ label: "29", value: "29" },
					{ label: "30", value: "30" },
					{ label: "31", value: "31" },
				],
				width: "15%", margin: "0",
				showWhen: { type: 'monthly' }	
            },
			{
                name: "dayOfWeek", 
				type: teacss.ui.select,
				items: [
                    { label: "Sunday", value: '0' },
					{ label: "Monday", value: '1' },
					{ label: "Tuesday", value: '2' },
					{ label: "Wednesday", value: '3' },
					{ label: "Thursday", value: '4' },
					{ label: "Friday", value: '5' },
					{ label: "Saturday", value: '6' },
				],
				width: "30%", margin: "0", 
				showWhen: { type: 'weekly' }	
            },				
			{
                name: "time", type: lp.timeText, width: "30%", margin: "5px", 
            },
        ]
    }
});