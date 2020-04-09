module.exports = {
    editor: {
        entry_point: "editor/index.js",
        bundle_path: "../public/assets/editor.min.js",
        js_transform: (js) => js.replace(/([>`}])(\s*\n\s*)([<`\$])/mg,"$1$3").replace(/\s*\n\s*/mg,' ')
    },
    lpcandy: {
        entry_point: "lpcandy/index.js",
        bundle_path: "../public/assets/lpcandy.min.js"
    }
}