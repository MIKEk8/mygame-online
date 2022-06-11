class ObjectManager {
    static objects
    static last_object_id
    static _inited = false

    static init() {
        if (!this._inited) {
            this.last_object_id = 0
            EventManager.addEvent(this.constructor.name, 'create')
            this._inited = true
        }
    }

    static create(name, params) {
        init()
        EventManager.callEvent(this.constructor.name, 'create', {'name': name, "params":params})
        let o = new name(...params)
        let id
        if (o instanceof BaseObject) {
            id = o._objectId
        } else {
            id = this.nextId()
        }
        this.objects[id] = o
        return id
    }

    static getObject(id) {
        let o = this.objects[id]
        if (o === undefined) throw 'ObjectManager error, object not found {id=' + id + '}'
        return o
    }

    static getLastId() {
        return "_" + this.last_object_id
    }

    static nextId() {
        init()
        this.last_object_id++
        return this.getLastId()
    }
}