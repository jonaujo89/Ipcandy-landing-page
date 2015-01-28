lp.background = teacss.ui.select.extendOptions({
    inline: true,
    panelClass: 'only-icons',
    items: function () {
        var items = [];
        items.push(
            { value: {color:"#313138"} },
            { value: {color:"#24242A"} }
        );
        for (var i=1;i<=3;i++) {
            items.push({
                value: {url:"view/editor/assets/texture_black/"+i+".jpg"},
            });
        }                        
        return items;
    },
    itemTpl: function (item) {
        return $("<div class='combo-item'>").append(
            $("<div>").css({
                width: 50,
                height: 50,
                background: item.value.url ? "url("+base_url+"/"+item.value.url+")" : item.value.color,
                backgroundSize: "cover",
                backgroundPosition: "auto 100%",
           })
        );
    }
});