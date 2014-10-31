lp.bgColor = teacss.ui.select.extendOptions({
    inline: true,
    panelClass: 'only-icons',
    items: [
        { value: "#ffffff" },
        { value: "#cccccc" }
    ],
    itemTpl: function (item) {
        return $("<div class='font-set-item combo-item'>").append(
            $("<div>").css({
                background: item.value,
                width: 30, height: 30,
                border: "1px solid #ccc"
            })
        );
    }
});

lp.header = lp.block.extendOptions({
    configForm: {
        items: [
            { type: "label", value: "Background color:", margin: "5px 0"},
            { type: lp.bgColor, name: "background" }
        ]
    }
});