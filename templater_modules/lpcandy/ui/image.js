lp.image = lp.cover.extendOptions({

    configForm: {
        title: "Image or video",
        items: [
            {
                name: 'type', type: 'radio', margin: "15px 0 20px", items: [
                    { label: "Image ", value: 'image' },
                    { label: "Video", value: 'video' }
                ]
            },
            {
                name: 'url', type: 'uploadButton', label: 'Upload image file',
                showWhen: { type: 'image' }
            },
            {
                type: 'label',
                value: "Video url:",
                showWhen: { type: 'video' }
            },
            {
                name: "url", type: "text",
                showWhen: { type: 'video' }
            }
        ]
    }
})