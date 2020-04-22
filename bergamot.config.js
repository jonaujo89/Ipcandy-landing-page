module.exports = {
    lpcandy: {
        entry_point: "front/site/index.js",
        bundle_path: "public/assets/lpcandy.min.js",
        js_transform: (js) => js.replace(/([>`}])(\s*\n\s*)([<`\$])/mg,"$1$3").replace(/\s*\n\s*/mg,' ')
    }
}