document.addEventListener("DOMContentLoaded",function(){
    let menubtn = document.getElementById("menu_btn") ;
    let cancelmenu = document.getElementById("cancel_menu") ;
    let hidden_nav = document.getElementById("hidden_nav") ;
    let dashboard = document.getElementById("dashboard") ;
    menubtn.addEventListener("click",function(){
        hidden_nav.style.right = 0;
        dashboard.style.width = "95%" ;
    });
    cancelmenu.addEventListener("click",function(){
        hidden_nav.style.right = "-10%";
        dashboard.style.width = "100%" ;
    });
});