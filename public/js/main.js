const nav = document.querySelector("nav");

window.addEventListener("scroll", () => {
    if(window.scrollY > 30){
        nav.classList.add("nav-scroll")
        nav.classList.remove("fade-up")
    }else{
        nav.classList.remove("nav-scroll")
        nav.classList.add("fade-up")
    }
});

