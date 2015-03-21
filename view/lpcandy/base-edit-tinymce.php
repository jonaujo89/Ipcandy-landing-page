<? include partial('lpcandy/layout') ?>
<? startblock('content') ?>
    <script src="<?=url('lib/bingo/template/admin/cms/script/tiny_mce/jquery.tinymce.js')?>" type="text/javascript" charset="utf-8"></script>
    <h3><?= $title ?></h3>
    <section>
        <?= $form ?>
    </section>
    <script>
        var uploadDir = "<?="/upload/LPCandy/files/".$user->id?>";
        
        $(document).on("click",".browse_wrap a",function(){$.colorbox({href:$(this).attr("href")});return false;});
        $(".browse_file").each(function (){
            var input = $(this);
            var url = input.val();
            input.wrap("<table class='browse_wrap' style='border:none;border-collapse:collapse'><tr><td style='vertical-align:middle;padding:0;margin:0'>");
            var row = input.parent().parent();

            var classList = input.attr('class').split(/\s+/);
            var type = 'files';
            $.each(classList,function(c,cls){
                if (cls.indexOf('type-')==0) {
                    type = cls.replace("type-","");
                }
            });

            if (input.hasClass("image")) {
                var td;
                row.prepend(
                    td = $("<td>").css({
                        "vertical-align":"middle",
                        "text-align":"center",
                        width:100,
                        height:100,
                        border:"1px solid #ccc",
                        margin:0,padding:0
                    })
                )
                input.parent().css({padding:"0 0 0 5px"})
                if (url) {
                    td.append(
                        $("<a>")
                            .attr({href:base_url+url})
                            .append(
                                $("<img>")
                                    .css({display:"block",margin:"auto"})
                                    .attr({src:base_url+url.replace(uploadDir,uploadDir+"/.thumbs")})
                            )
                    )
                }
            }
            row.append(
                $("<td>").css({width:1,"vertical-align":"middle"}).append(
                    $("<button data-type='"+type+"' class='browse_file_button single' type='button'>"+browse_text+"</button>")
                )
            )
        });
        $(document).on("click",".browse_file_button",function(){
            var button = this;
            var type = $(this).attr("data-type");
            var input = $(button).parent().parent().find('input');            
            var path = input.val().replace(uploadDir+"/","");
            
            window.KCFinder = {
                callBack: function(url) {
                    url = decodeURIComponent(url);
                    window.KCFinder = null;
                    input.val(url);

                    if (input.hasClass("image")) {
                        input.parent().parent().find("td:first img").remove();
                        input.parent().parent().find("td:first").append(
                            $("<a>")
                                .attr({href:base_url+url})
                                .append(
                                    $("<img>")
                                        .css({display:"block",margin:"auto"})
                                        .attr({src:base_url+url.replace(uploadDir,uploadDir+"/.thumbs")})
                                )
                        )
                    }
                }
            };
            window.open(base_url+"/files/browse.php?type="+type+"&lang="+locale_lang+"&path="+encodeURIComponent(path), 'kcfinder_textbox',
                'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
                'resizable=1, scrollbars=0, width=800, height=600'
            );
        });        
    </script>
    <script>
        function openKCFinder(field_name, url, type, win) {
            tinyMCE.activeEditor.windowManager.open({
                file:base_url+"/files/browse.php?opener=tinymce&lang="+locale_lang+"&type=files",
                title: 'File Browser',
                width: 800,
                height: 600,
                resizable: "yes",
                inline: true,
                close_previous: "no",
                popup_css: false
            }, {
                window: win,
                input: field_name
            });
            return false;
        }
        $("textarea.tinymce").each(function(){
            var me = this;
            $(this).tinymce({
                mode:'exact',
                script_url : "<?=url('lib/bingo/template/admin/cms/script/tiny_mce/tiny_mce.js')?>",
                content_css: "<?=url('view/assets/tinymce.css')?>",

                // General options
                theme : "advanced",
                plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,bingo",

                // Theme options
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontsizeselect,|,hr,|,sub,sup,|,forecolor,backcolor,|,fullscreen",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,help,|,media,bingo_more",
                theme_advanced_buttons3 : "",
                theme_advanced_buttons4 : "",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : false,
                width: "100%",
    
                paste_remove_styles: true,

                file_browser_callback : "openKCFinder",
                language:"<?=_t("en")?>",

                entity_encoding : "raw",
                verify_html : false,
                relative_urls : false,
                accessibility_warnings : false
            });
        });
    </script>
<? endblock() ?>
