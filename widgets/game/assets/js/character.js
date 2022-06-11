class Character {

    constructor(texture, viewport) {
        this.sprite = PIXI.Sprite.from(texture);

        this.sprite.x = 600;
        this.sprite.y = 1000 + Math.random()*30;
        this.sprite.scale.set(0.1);
        this.sprite.scale.x = -this.sprite.scale.x
        this.speed = 0 - Math.random() //* (dude.scale.x / dude.scale.x.abs);
        this.sprite.width = this.sprite.texture.baseTexture.width * Math.abs(this.sprite.scale.x)
    }
    tick(){
        this.sprite.x += this.speed;

        if (this.sprite.x + this.sprite.width < 0) {
            this.sprite.x = this.sprite.screen.width + this.sprite.width;
        }
    }
}