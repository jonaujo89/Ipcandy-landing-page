require('../../lib/datetimePicker/jquery.datetimepicker.css');
require('../../lib/datetimePicker/jquery.datetimepicker.js');

lp.dateText = ui.text.extend({
    init: function (o) {
        this._super(o);
        this.input.css({lineHeight: 1.8, textAlign: "center"});
        this.input.datetimepicker($.extend({
			animation: false, days: true,mask:true,
			timepicker: false, format:'Y/m/d', closeOnDateSelect: true,
			minDate: new Date(),
        },o.pickerOptions || {}));
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
		title: _t("Countdown settings"),
        width: "250px",
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
            {
                type: "label", value: _t("Date:"), width: "65%", margin: "5px 5% 5px 0", 
				showWhen: { type: 'datetime' }
            },
            {   
                type: "label", value: _t("Day:"), width: "65%", margin: "5px 5% 5px 0" ,
				showWhen: { type: 'monthly' }
            },
            {   
                type: "label", value: _t("Day of week:"), width: "65%", margin: "5px 5% 5px 0" ,
				showWhen: { type: 'weekly' }
            },        
            {   
                type: "label", value: _t("Time:"), width: "25%", margin: "5px 5% 5px 0", showWhen: { type: ['datetime','monthly','weekly'] } 
            }, 
            {   
                type: "label", value: _t("Time:"), width: "100%", margin: "11px 70% 5px 0", showWhen: { type: 'daily' }
            },
			{
                name: "date", type: lp.dateText, width: "65%", margin: "5px 5% 5px 0",
				showWhen: { type: 'datetime' }	
            },
			{
                name: "day", type: teacss.ui.select,
                items: function () {
                    var items = [];
                    for (i=1;i<=31;i++) items.push({label:i,value:i});
                    return items;
                },
				width: "65%", margin: "5px 5% 5px 0",
				showWhen: { type: 'monthly' }	
            },            
			{
                name: "dayOfWeek", 
				type: teacss.ui.select,
                items: [
                    { value:1, label:_t('Monday') },
                    { value:2, label:_t('Tuesday') },
                    { value:3, label:_t('Wednesday') },
                    { value:4, label:_t('Thursday') },
                    { value:5, label:_t('Friday') },
                    { value:6, label:_t('Saturday') },
                    { value:7, label:_t('Sunday') }
                ],
				width: "65%", margin: "5px 5% 5px 0", 
				showWhen: { type: 'weekly' }	
            },
			{
                name: "time", type: lp.dateText, width: "25%", margin: "5px 5% 5px 0",
                pickerOptions: {
                    format: "H:i", step: 30, timepicker: true, datepicker: false
                }
            },
        ]
    }
});