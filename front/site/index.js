window.lpcandyRun = (what,options) => {
    if (what.call) {
        let currentScript = document.currentScript.src.replace(window.location.origin, '');
        window.lpcandyRun.afterRunList.push({f:what,currentScript: currentScript});
        if (lpcandyRun.ready) {
            lpcandyRun.currentScript = currentScript;
            what();
        }
        return;
    }

    require("./lib");
    if (options.language=="ru") require("../ru.js");
    require("./components/App");
    
    window.lpcandyRun.afterRunList.forEach(({f,currentScript})=>{
        lpcandyRun.currentScript = currentScript;
        f();
    });

    document.addEventListener("DOMContentLoaded",()=>{
        preact.render(preact.h(window[what],options),document.body);
    });

    lpcandyRun.ready = true;
}
window.lpcandyRun.afterRunList = [];
window.lpcandyRun.ready = false;