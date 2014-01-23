<!doctype html>
<html>
    <head>
        <title><?=$title?></title>
        <meta charset="utf-8" />
        
        <link href="/~boomyjee/teacss-ui/lib/teacss-ui.css" rel="stylesheet" type="text/css">
        <link href="/~boomyjee/dayside/client/dayside.css" rel="stylesheet" type="text/css">
        
        <script src="/~boomyjee/teacss/lib/teacss.js"></script>
        <script src="/~boomyjee/teacss-ui/lib/teacss-ui.js"></script>
        <script src="/~boomyjee/dayside/client/dayside.js"></script>
        <script>
            dayside({
                root: "http://template-editor",
                ajax_url: "<?=url('tpl-editor-ajax')?>",
                jupload_url: false
            });
        </script>
    </head>
    <body>
    </body>
</html>