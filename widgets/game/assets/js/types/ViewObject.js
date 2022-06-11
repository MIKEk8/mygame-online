EventManager.addEvent('ViewObject', 'new')
class ViewObject extends BaseObject{

    _viewport
    _sprite
    position

    constructor(viewport, position, texture) {
        super()
        this._viewport = viewport
        if (texture) {
            this.setSprite(texture);
        }
    }

    setSprite(texture) {
        this._sprite = PIXI.Sprite.from(texture);
    }


    tick() {

    }
}