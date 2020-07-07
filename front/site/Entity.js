class Entity {
    static register(clsName,cls) {
        Entity.list = Entity.list || {};
        Entity.list[clsName] = cls;
        cls.id = clsName;
        cls.currentScript = lpcandyRun.currentScript;
    }
}

exports.Entity = Entity;