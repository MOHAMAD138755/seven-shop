// PRELOADER
window.addEventListener("load", () => {
    document.getElementById("preloader").style.display = "none";
});

// MENU
const menuBtn = document.getElementById("menuBtn");
const nav = document.getElementById("nav");

menuBtn.addEventListener("click", () => {
    nav.classList.toggle("show");
});

// CART
let count = 0;
const cart = document.getElementById("cart");
const cartCount = document.getElementById("cartCount");
const cartText = document.getElementById("cartText");

function addToCart(btn){
    count++;
    cartCount.innerText = count;
    cartText.innerText = `تعداد آیتم: ${count}`;

    btn.style.transform = "scale(0.9)";
    setTimeout(() => btn.style.transform = "scale(1)", 150);
}

document.getElementById("cartBtn").addEventListener("click", () => {
    cart.classList.toggle("open");
});

// BACK TO TOP
const back = document.getElementById("backToTop");

window.addEventListener("scroll", () => {
    back.style.display = window.scrollY > 300 ? "block" : "none";

    document.querySelectorAll(".reveal").forEach(el => {
        const top = el.getBoundingClientRect().top;
        if(top < window.innerHeight - 100){
            el.classList.add("active");
        }
    });
});

back.addEventListener("click", () => {
    window.scrollTo({top:0, behavior:"smooth"});
});
