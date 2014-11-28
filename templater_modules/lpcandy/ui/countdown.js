lp.countdown = lp.cover.extendOptions({
	change: function(){ 
		var countdown = this.element.find(".countdown");
		countdown.attr( "data-time" , this.value.time_end );
        lp.initCountdown();
    },
    configForm: {
        items: [   
            {
                type: 'label',
				value: "Date end:",
                margin: "10px 0 5px",
            },
            {
                name: "time_end", type: "text",
            },           
        ]
    }
});