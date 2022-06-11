class EventManager {
    static events = {}
    static log = []

    static bind(object, event, fn) {
        return this.addListener(object, event, fn)
    }

    static trigger(object, event, data) {
        return event(object, event, data)
    }

    static addListener(object, event, fn) {
        let listeners = this.getListeners(object, event)
        listeners.push(fn)
        return listeners.length - 1
    }

    static deleteListener(object, event, id) {
        let listeners = this.getListeners(object, event)
        listeners[id] = undefined
    }

    static addEvent(object, event) {
        this.getListeners(object, event, true)
        this.log.push({'action': 'addEvent', 'timestamp':Date.now()})
        return (data) => EventManager.callEvent(object, event, data)
    }

    static callEvent(object, event, data) {
        let listeners = this.getListeners(object, event, true)
        if (listeners === []) {
            throw "EventManager error, before calling the event, it must be added {" + event + "}"
        }
        listeners.forEach((fn) => fn(data))
    }

    static event(object, event, data) {
        let e = this.addEvent(object, event)
        e(data)
        return e
    }

    static getListeners(object, event, safe = false) {
        let objectId = undefined
        if (object instanceof BaseObject) {
            objectId = object._objectId;
        } else if (object.isString()) {
            objectId = object
        }
        if (objectId === undefined) throw "EventManager error, incorrect object"

        if (this.events[objectId] === undefined)
            this.events[objectId] = []

        let listeners = this.events[objectId][event]
        if (listeners === undefined) {
            if (safe) {
                this.events[objectId][event] = [];
                return this.getListeners(object, event)
            } else {
                if (this.events[objectId] === undefined) {
                    throw "EventManager error, object not found {" + objectId + "}"
                } else {
                    throw "EventManager error, event not found {" + event + "}"
                }
            }
        }
        return listeners
    }
}