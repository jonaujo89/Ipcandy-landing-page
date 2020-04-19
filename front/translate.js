const fs = require('fs');
const path = require('path');

function findInDir (dir, filter, fileList = []) {
  const files = fs.readdirSync(dir);

  files.forEach((file) => {
    const filePath = path.join(dir, file);
    const fileStat = fs.lstatSync(filePath);

    if (fileStat.isDirectory()) {
      findInDir(filePath, filter, fileList);
    } else if (filter.test(filePath)) {
      fileList.push(filePath);
    }
  });
  return fileList;
}

global.window = {};
window._t = function(s) { return window._t.hash[s] || s; };
window._t.hash = {};
window._t.load = function(h) { window._t.hash = {...window._t.hash,...h} }

require("./ru.js");
let newStrings = {};
let oldStrings = window._t.hash;

findInDir(__dirname,/\.js$/).forEach((file)=>{
    let text = fs.readFileSync(file,'utf8');
    let pattern = /_t\(\s*('|")(.*?)('|")\s*\)/g;

    while (matches = pattern.exec(text)) {
        let eng = matches[2];
        if (!(eng in oldStrings)) {
            newStrings[eng] = "";
        }
    }
});

let res = "window._t.load("+JSON.stringify({
    ...newStrings,
    ...oldStrings
},null,"    ")+");";

fs.writeFileSync(__dirname+"/ru.js",res);