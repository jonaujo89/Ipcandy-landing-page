const $ = teacss.jQuery;

ui.alert = ui.alert || function(options) {
    if ($.type(options)=="string") {
        options = {
            text: options
        }
    };
    options.title = options.title ||  _t('Alert');
    
    if (!window.alertDialog) {
         window.alertDialog = ui.dialog({
            modal: true,
            width: 300,
            minHeight: 50,
            resizable: false,
            draggable: false,
            dialogClass: 'alert',
            position: { my: "center top", at: "center top+25%", of: window },
            buttons: {
                OK: function() {
                    $( this ).dialog("close");
                }
            }                        
        });
    
        $(document).on('click','.ui-widget-overlay',function(){
            window.alertDialog.close();
        });
    }
    
    window.alertDialog.element.dialog("option","title",options.title);
    window.alertDialog.element.empty().append(
        $("<p>").html(options.text)
    );
    window.alertDialog.open();
}

ui.confirm = ui.confirm || function(options,cb) {
    if ($.type(options)=="string") {
        options = {
            text: options
        }
    };
    
    options.title = options.title || _t('Confirm');
    options.yes = options.yes || _t('Yes');
    options.no = options.no || _t('Cancel');
    
    
    if (!window.confirmDialog) {
        window.confirmDialog = ui.dialog({
            modal: true,
            width: 300,
            minHeight: 50,
            resizable: false,
            draggable: false,
            dialogClass: 'confirm',
            position: { my: "center top", at: "center top+25%", of: window } 
        });
        $(document).on('click','.ui-widget-overlay',function(){
            window.confirmDialog.close();
            if (cb) cb(false);
        });
    }
    
    window.confirmDialog.element.dialog("option","title",options.title);
    window.confirmDialog.element.dialog("option","buttons", [
        {
            text: options.yes,
            click: function () {
                $(this).dialog("close");
                if (cb) cb(true);
            }
        },
        {
            text: options.no,
            click: function () {
                $(this).dialog("close");
                if (cb) cb(true);
            }
        }
    ]);
    
    window.confirmDialog.element.empty().append(
        $("<i>").addClass('ui-icon ui-icon-help'),
        $("<p>").html(options.text)
    );
    window.confirmDialog.open();
}