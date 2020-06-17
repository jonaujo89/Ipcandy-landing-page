window.lpcandyRun = (what,options) => {
    if (what.call) return window.lpcandyRun.afterRunList.push(what);

    require("./lib");
    if (options.language=="ru") require("../ru.js");
    require("./components/App");
    window.lpcandyRun.afterRunList.forEach((f)=>f());

    document.addEventListener("DOMContentLoaded",()=>{
        preact.render(preact.h(window[what],options),document.body);
    });
}
window.lpcandyRun.afterRunList = [];

