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
