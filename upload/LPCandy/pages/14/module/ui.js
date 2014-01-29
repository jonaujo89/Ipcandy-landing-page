ui.borderCombo = ui.combo.extend({
    init: function (o) {
        var name = o.name;
        var left,right;
        o = $.extend({
            label: "Border",
            comboDirection: "bottom",
            comboHeight: 1000,
            items: [
                ui.check({
                    name: name + ".top", margin: 0,
                    width: "100%", label: "top"
                }),
                left = ui.check({
                    name: name + ".left", margin: 0,
                    width: "50%", label: "left"
                }),
                right = ui.check({
                    name: name + ".right", margin: 0,
                    width: "50%", label: "right"
                }),
                ui.check({
                    name: name + ".bottom", margin: 0,
                    width: "100%", label: "bottom"
                }),
                
                ui.fillCombo({
                    label:"Color",width:"100%",margin:0,
                    name: name + ".color"
                }),
                ui.lengthCombo({
                    label:"Width",width:"100%",margin:0,min:0,max:20,
                    options:[{value:false,label:'No border'},1,2,3,5,10],
                    name: name + ".width",
                    inline: true, height: 200
                })
            ]
        },o);
        
        left.element.add(right.element).css({
            'box-sizing': 'border-box',
            '-moz-box-sizing': 'border-box',
            '-webkit-box-sizing': 'border-box'
        });
        this._super(o);
    },
    getLabel: function () {
        return teaSwitcherLabel(
            $("<div>").text(this.options.label).css({
                height: 40,
                lineHeight: "40px"
            }),
            teacss.functions.layout_border,
            this.value
        );
    }
});


Component.app.bind("component-controls",function(d,e){
    var cmp = e.cmp;
    var id = cmp.value.id;
    
    if (cmp.hasMyControls) return;
    cmp.hasMyControls = true;
    
    if (cmp.value.type=="container" || cmp.value.type=="form") {
        cmp.controls.push(
            ui.borderCombo({ 
                width:"100.0%", margin: "10px 0px 0 0px", name:"container."+id+".border"
            })
        );
    }  
});