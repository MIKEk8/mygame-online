class BaseObject {
    _objectId
    _className

    constructor() {
        this._className = this.constructor.name
        this._objectId = Math.random()
        EventManager.addEvent(this, 'constructor')
        EventManager.callEvent(this.constructor.name, 'new')
    }
}