/**
 * 
 */


/* Images */
let game_imgs = document.getElementsByClassName('game-img')

for (let i = 0; i < game_imgs.length; i++){
    game_imgs[i].style.backgroundImage = `url('${game_imgs[i].getAttribute('src')}')`
    game_imgs[i].removeAttribute('src')
}


/* Redirects */
const redirect_to_game_url = (url)=>{
    window.open(url, '_blank')
}

let link_game = document.getElementsByClassName('link-game')

for (let i=0; i<link_game.length; i++)
    link_game[i].addEventListener('click', () => redirect_to_game_url(link_game[i].getAttribute('href')))


/* Slider */
let slider = document.getElementsByClassName('slider')

const obj_slider_hover = '.slider:hover > .content-slider > :first-child'
const obj_slider_hover_stop = (nth_child) => `.game-category:nth-child(${nth_child+1}) .slider > .content-slider > :first-child`

const mousemove_slider = (ms) => {
    try{
        let ml = Number(document.querySelector(obj_slider_hover).style.marginLeft.replace('px', ''))
        let mx = ms.movementX
        let slider_el = document.querySelector('.content-slider:hover').offsetWidth

        document.querySelector(obj_slider_hover).style.marginLeft = ml + mx + 'px'
    } catch {}
}

const mousestop_slider = (i) => {
    slider[i].onmousemove = ()=>{}
    slider[i].classList.remove('untouch')

    try{
        let ml = Number(document.querySelector(obj_slider_hover_stop(i)).style.marginLeft.replace('px', ''))
        let slider_el = document.querySelector('.content-slider').offsetWidth

        if (ml > slider_el/2)
            document.querySelector(obj_slider_hover_stop(i)).style.marginLeft = (slider_el/2) + 'px'
        else if (ml < -slider_el/2)
            document.querySelector(obj_slider_hover_stop(i)).style.marginLeft = -(slider_el/2) + 'px'
    } catch {}
}

let timer_back = 0

for (let i=0; i<slider.length; i++){
    slider[i].onmousedown = ()=>{
        slider[i].onmousemove = mousemove_slider
        slider[i].classList.add('untouch')
    }
    slider[i].onmouseleave = () => mousestop_slider(i)
    slider[i].onmouseup = () => mousestop_slider(i)
    document.querySelector('*').onmouseup = () => mousestop_slider(i)
}
