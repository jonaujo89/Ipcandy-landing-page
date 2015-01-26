lp.color = teacss.ui.select.extendOptions({
    inline: true,
    panelClass: 'only-icons',
    iconSize: 30,
    itemTpl: function (item) {
        return $("<div class='font-set-item combo-item'>").append(
            $("<div>").css({
                background: item.color || item.value,
                width: this.options.iconSize, height: this.options.iconSize,
                border: "1px solid #ccc"
            })
        );
    }
});

lp.buttonColor = lp.color.extendOptions({
    iconSize: 15, 
    items: [
        { value: 'blue', color: '#0187BC' },
        { value: 'green', color: '#3E9802' },
        { value: 'orange', color: '#FD6F00' },
        { value: 'purple', color: '#8C33D2' },
        { value: 'purple_light', color: '#9581BF' },
        { value: 'rose', color: '#F372A4' },
        { value: 'red', color: '#CE0707' },
        { value: 'yellow', color: '#FFC415' }
    ]    
});

lp.blockColor = lp.color.extendOptions({
    items: [
        { value: "#FFFFFF" },
        { value: "#F7F7F7" }
    ]    
});