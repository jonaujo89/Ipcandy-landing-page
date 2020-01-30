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

lp.darkBlockColor = lp.color.extendOptions({
    items: [
        { value: "#313138"},
        { value: "#143A4F"},
        { value: "#19678B"},
        { value: "#4E6D8D"},
        { value: "#607FA4"},
        { value: "#0E93B3"},
        { value: "#1E4147"},
        { value: "#198B82"},
        { value: "#0C884A"},
        { value: "#393458"},
        { value: "#583458"},
        { value: "#614C8A"},
        { value: "#8C0C24"},
        { value: "#593D36"}        
    ]
});