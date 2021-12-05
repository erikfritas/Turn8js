/**
 * Navigator menu
 * 
 * By @erikfritas
 */

document.getElementById('navmenu-mobile').addEventListener('click', ()=>{

    let navlist = document.getElementById('navlist')
    navlist.classList.add('active')
    navlist.style.display = 'flex'
    navlist.style.flexDirection = 'column'
    navlist.style.gap = '20px'

})

document.getElementById('navback-mobile').addEventListener('click', ()=>{

    let navlist = document.getElementById('navlist')
    navlist.classList.remove('active')
    navlist.style.display = 'none'
    navlist.style.flexDirection = 'row'

})

