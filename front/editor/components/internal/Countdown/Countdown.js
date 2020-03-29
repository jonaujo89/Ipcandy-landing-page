const {Cover} = require("../Cover/Cover");
const {Editable} = require("../Editable/Editable");
const {Dialog} = require("../Dialog/Dialog"); 
const {Radio} = require("../Radio/Radio");
const {Input} = require("../Input/Input");
const {Select} = require("../Select/Select");

const Countdown = Editable(class extends preact.Component{
    configForm(val) {
        return html`
            <${Dialog} title="${_t('Countdown settings')}" width=${250}>
                <${Radio} name="type" inline=${false} items=${[
                    {label: _t("Exact date"), value: 'datetime'},
                    {label: _t("Every month"), value: 'monthly'},
                    {label: _t("Every week"), value: 'weekly'},
                    {label: _t("Every day"), value: 'daily'},
                ]} />
                <hr/>
                <div class="lp-row">
                    ${val.type=="datetime" && html`
                        <div>
                            <label>${_t('Date:')}</label>
                            <${Input} name="date" type="date" />
                        </div>
                    `}
                    ${val.type=="monthly" && html`
                        <div>
                            <label>${_t('Day:')}</label>
                            <${Select} name="day">
                                ${(()=>{
                                    var res = [];
                                    for (var i=1;i<=31;i++) res.push(html`<option value=${i}>${i}</option>`)
                                    return res;
                                })()}
                            <//>
                        </div>
                    `}
                    ${val.type=="weekly" && html`
                        <div>
                            <label>${_t('Day of week:')}</label>
                            <${Select} name="dayOfWeek">
                                <option value="1">${_t("Monday")}</option>
                                <option value="2">${_t("Tuesday")}</option>
                                <option value="3">${_t("Wednesday")}</option>
                                <option value="4">${_t("Thursday")}</option>
                                <option value="5">${_t("Friday")}</option>
                                <option value="6">${_t("Saturday")}</option>
                                <option value="7">${_t("Sunday")}</option>
                            <//>
                        </div>
                    `}
                    <div>
                        <label>${_t('Time:')}</label>
                        <${Input} name="time" type="time" />
                    </div>
                </div>
            <//>                
        `
    }

    getEndDate() {
        if (this.cached) {
            var takeFromCache = true;
            for (var key in this.props.value) {
                if (this.props.value[key]!=this.cached.value[key]) takeFromCache = false;
                if (takeFromCache) {
                    return this.cached.set_date;
                }
            }
        }

        var get_date = this.props.value;
        var set_date;

		var current_date = new Date();
		var current_year = current_date.getFullYear();
		var current_month = current_date.getMonth();
		var current_day_of_week = current_date.getDay();
		var current_day = current_date.getDate();
		var tomorrow = current_date.getDate()+1;
        var add_days;
        
        var time = get_date.time.split(':');
        var hours = time[0];
        var minutes = time[1];
		
		switch (get_date.type) {
            case 'datetime':
                set_date = new Date(get_date.date + ' ' + get_date.time);
                if (isNaN(set_date)) set_date = 0;
                break;

            case 'monthly':                
                var lengthMonth;
                var real_current_month = current_month+1;
                add_days = get_date.day - current_day;
                    
                if (real_current_month == 2) { // если февраль то 29-30 не считать
                    if (current_year % 4 === 0) { // если высокосный год, то в феврале 29 дней
                        if (get_date.day == 30 || get_date.day == 31) {
                            add_days = 29 - current_day;
                        }
                        lengthMonth = 29;
                    } else {
                        if (get_date.day == 29 || get_date.day == 30 || get_date.day == 31) {
                            add_days = 28 - current_day;
                        }
                        lengthMonth = 28;
                    }
                } else {
                    if (real_current_month == 4 || real_current_month == 6 || real_current_month == 9 || real_current_month == 11) { // если в месяце 30 дней то 31 не считать
                        if (get_date.day == 31) {
                            add_days = 30 - current_day;
                        }
                        lengthMonth = 30;
                    } else {
                        lengthMonth = 31;
                    }
                }

                if (add_days < 0) {
                    add_days = lengthMonth + add_days;
                } else if (add_days == 0) {
                    var timeX = new Date(current_year, current_month, current_day, hours, minutes);
                    if (timeX < current_date) {
                        add_days = lengthMonth;
                    }
                } 

                if(current_day > get_date.day){
                    if(get_date.day == 1){
                        current_day = 1;
                    } else {
                        current_day = get_date.day;
                    }
                    set_date = new Date(current_year, current_month+1, current_day, hours, minutes);
                } else {
                    set_date = new Date(current_year, current_month, current_day + add_days, hours, minutes);
                }

                if (isNaN(set_date)) set_date = 0;                    
                   
                break;

            case 'weekly':
                add_days = get_date.dayOfWeek - current_day_of_week;                
                if (add_days == 0) {
                    var timeX = new Date(current_year, current_month, current_day, hours, minutes);
                    if (timeX < current_date) {
                        add_days = 7;
                    }
                } 
                if (add_days < 0) {
                    add_days = 7 + add_days;
                }
                
                set_date = new Date(current_year, current_month, current_day + add_days, hours, minutes); 
                if (isNaN(set_date)) set_date = 0;

                break;

            case 'daily':
                set_date = new Date(current_year, current_month, current_day, hours, minutes);                
                if (set_date < current_date) {
                    set_date = new Date(current_year, current_month, tomorrow, hours, minutes); 
                }
                if (isNaN(set_date)) set_date = 0;

                break;
        }

        this.cached = {
            value: {...this.props.value},
            set_date: set_date
        };
        return set_date;
    }

    componentDidMount() {
        this.interval = setInterval(() => this.setState({}), 1000);
    }

    componentWillUnmount() {
        clearInterval(this.interval);
    }    

    render(props,state) {
        const total_sec = (this.getEndDate() - new Date())/1000;

        var days = 0, hours = 0, minutes = 0, seconds = 0;
        if (total_sec > 0) {
            days = Math.floor(total_sec /60/60/24);
            hours = Math.floor(total_sec /60/60) % 24;
            minutes = Math.floor(total_sec /60) % 60;
            seconds = Math.floor(total_sec) % 60;
        }
        function format(x) {
            return (x<10) ? '0'+x : x;
        }

        return html`
            <${Cover} 
                configForm=${this.configForm(props.value)}
            >
                <div class="countdown">
                    <div class="countdown-days">
                        <div>${format(days)}</div>
                        <span>дни</span>
                    </div>
                    <div class="countdown-hours countdown-separator">
                        <div>${format(hours)}</div>
                        <span>часы</span>
                    </div>
                    <div class="countdown-minutes countdown-separator">
                        <div>${format(minutes)}</div>
                        <span>минуты</span>
                    </div>
                    <div class="countdown-seconds countdown-separator">
                        <div>${format(seconds)}</div>
                        <span>секунды</span>
                    </div>                                                            
                </div>
            <//>
        `
    }
})

Countdown.tpl_default = () => {
    const now = new Date();
    const nextMonth = new Date(now.setMonth(now.getMonth()+1));

    return {
        type: 'daily',
        date: nextMonth.toISOString().substring(0, 10),
        dayOfWeek: 1,
        day: 5,
        time: '23:55'
    };
}

exports.Countdown = Countdown;