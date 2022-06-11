var game

let init = function () {
    let footer = document.getElementsByClassName('footer')[0]
    let htmlView = document.getElementById('view')
    let height = document.body.clientHeight - (htmlView.offsetTop + footer.clientHeight)
    let width = htmlView.clientWidth

    const app = new PIXI.Application({
        width: width,
        height: height
    });
    htmlView.appendChild(app.view);

    game = new Game(app)
}
window.addEventListener('load', init)