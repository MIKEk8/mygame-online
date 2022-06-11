let bg
let bg_texture
const cars = [];
const ordersZ = [];
let c = new PIXI.Container();

class Game {

    constructor(app) {
        this.app = app;
        this.loader = new PIXI.Loader();
        this.loader.add('bg', '/game/sprites/background.jpg')
        this.loader.add('car', '/game/sprites/car.png')
        this.loader.load((loader, resource) => {
            this.resource = resource
            this.init()
        })
    }

    init() {
        let app = this.app
        const totalDudes = 4;
        bg_texture = this.resource.bg.texture;
        bg = new PIXI.Sprite(bg_texture);
        //bg = PIXI.Sprite.from('/game/sprites/background.jpg');
        bg.x = 0
        bg.y = 0
        app.stage.addChild(bg);


        c.sortableChildren = true;
        app.stage.addChild(c);

        for (let i = 0; i < totalDudes; i++) {
            var car = new Car(this.resource.car.texture);
            c.addChild(car.sprite);
        }
        /*aliens.sort((f, s) => {
            return s.zIndex - f.zIndex
        })*/
        //c.sortChildren()
        /*for(let a in aliens){
            ordersZ.push(a)
            a. = ordersZ.length;
        }*/
        app.ticker.add(() => {
            console.log(cars)
            Car.cars.forEach((car) => {
                console.log(car)
                car.tick()
            });
            bg.scale.y = app.screen.height / bg_texture.baseTexture.height;
            bg.scale.x = app.screen.width / bg_texture.baseTexture.width;
        });
    }
}