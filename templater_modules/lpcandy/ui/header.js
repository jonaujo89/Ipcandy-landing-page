lp.header = lp.block.extendOptions({
    configForm: {
        items: [
            { type: "label", value: "Background color:", margin: "5px 0"},
            { 
                type: lp.color, name: "background",  
                items: [{ value: "#ffffff" },{ value: "#dddddd" }]
            }
        ]
    }
});

