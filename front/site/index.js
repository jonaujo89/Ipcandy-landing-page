window.lpcandyRun = (what,options) => {
    require("./lib");
    if (options.language=="ru") require("../ru.js");
    require("./components/App");

    document.addEventListener("DOMContentLoaded",()=>{
        preact.render(preact.h(window[what],options),document.body);
    });
}

