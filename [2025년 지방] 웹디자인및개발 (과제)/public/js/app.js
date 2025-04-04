window.onload = function(){
    setTimeout(()=> {
        let fade = document.querySelector(".out");
        if(fade != null){
            fade.classList.add("fade-out");
            setTimeout(()=> {fade.remove();}, 500);
        }
    }, 3000);
}