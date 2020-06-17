window.lpcandyRun(()=>{
    window._t.load(require("ru.js"));

    require('./components/Projects/Projects');
    
    const {ProjectList} = require('./components/ProjectList/ProjectList');
    const {ProjectForm} = require('./components/ProjectForm/ProjectForm');
    const {Entity} = require("../../site/Entity");
    
    Entity.register('project',class extends Entity {
        static get menuLabel() { return _t('Projects') }
        static get label() { return  _t('My Projects') }
        static get labelMultiple() { return _t('My Projects') }
        static get listComponent() { return ProjectList }
        static get formComponent() { return ProjectForm }
    });
});