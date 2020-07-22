let js_transform = (js) => js.replace(/([>`}])(\s*\n\s*)([<`\$])/mg,"$1$3").replace(/\s*\n\s*/mg,' ')

module.exports = {
    lpcandy: {
        entry_point: "front/site/index.js",
        bundle_path: "public/assets/lpcandy.min.js",
        js_transform
    },
    projects: {
        entry_point: "front/extra/projects/index.js",
        bundle_path: "public/upload/CMS/shop_products/projects.min.js",
        js_transform
    }
}