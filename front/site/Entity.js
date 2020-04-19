class Entity {
    static register(clsName,cls) {
        Entity.list = Entity.list || {};
        Entity.list[clsName] = cls;
        cls.id = clsName;
    }
}

exports.Entity = Entity;