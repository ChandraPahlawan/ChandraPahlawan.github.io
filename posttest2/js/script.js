// toggle cls active
const navbarNav = document.querySelector('.navbar-nav');
// klik menu 
document.querySelector('#hamburger-menu').onclick = ()=>{
    navbarNav.classList.toggle('active');
};

// toggle active untuk search form
const searchForm = document.querySelector('.search-form');
const searchBox = document.querySelector('#search-box');

document.querySelector('#search-button').onclick =(e)=>{
    searchForm.classList.toggle('active');
    searchBox.focus();
    e.preventDefault();
};

// cls active sc
const shoppingCart = document.querySelector('.shopping-cart');
document.querySelector('#shopping-cart-button').onclick = ()=>{
    shoppingCart.classList.toggle('active');
    e.preventDefault()
};

// pencet luar buat ilangin
const hm = document.querySelector('#hamburger-menu');
const sb = document.querySelector('#search-button');
const sc = document.querySelector('#shopping-cart-button');



document.addEventListener('click', function(e){
    if(!hm.contains(e.target) && !navbarNav(e.target )){
        navbarNav.classList.remove('active');
    }

    if(!sb.contains(e.target) && !searchForm(e.target )){
        searchForm.classList.remove('active');
    }
    if(!sc.contains(e.target) && !shoppingCart(e.target )){
        shoppingCart.classList.remove('active');
    }
});

