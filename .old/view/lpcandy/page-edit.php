<? include partial('layout') ?>
<? startblock('content') ?>

    <link href="/~boomyjee/teacss-ui/lib/teacss-ui.css" rel="stylesheet" type="text/css">
    <script src="/~boomyjee/teacss-ui/lib/teacss-ui.js"></script>

    <script>
        var require = function () {};
    </script>
    <script src="/~boomyjee/templater/lib/modules/core/components/wysiwyg/tinymce/tinymce.min.js"></script>
    <script src="/~boomyjee/templater/lib/modules/core/components/wysiwyg/tinymce/jquery.tinymce.min.js"></script>
    <script src="/~boomyjee/templater/lib/modules/core/components/wysiwyg/wysiwyg.js"></script>

    <script>
        var fieldsConfig = <?=json_encode($fieldsConfig)?>;
        var fieldsControls = {};
        $(function(){
            var select = $("select[name='template']");
            function changeSelect() {
                var val = select.val();
                var ctl = fieldsControls[val];
                if (!ctl) {
                    var cfg = fieldsConfig[val];
                    ctl = teacss.ui.composite({items:cfg});
                    fieldsControls[val] = ctl;
                };
                teacss.ui.formControl("input[name='custom_fields']",ctl);
            };
            changeSelect();
            select.change(changeSelect);
        });
    </script>

    <h3 class='page-title'><?= _t("Edit page") ?></h3>
    <section>
        <?= $form ?>
    </section>

<? endblock() ?>