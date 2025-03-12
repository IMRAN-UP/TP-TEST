document.addEventListener("DOMContentLoaded",function(){
    let menubtn = document.getElementById("menu_btn") ;
    let cancelmenu = document.getElementById("cancel_menu") ;
    let hidden_nav = document.getElementById("hidden_nav") ;
    let dashboard = document.getElementById("admin_container") ;
    let animation = document.getElementById("animation-container");

    console.log(is_old_password);

    let userBtn = document.getElementById("username_btn");
    let canceluserbtn = document.getElementById("cancel_edit_username");
    let passBtn = document.getElementById("password");
    let cancelpassBtn = document.getElementById("cancel_edit_password");
    let form_container = document.getElementById("forms_conatainer");
    let user_container = document.getElementById("username_edit");
    let pass_container = document.getElementById("password_edit");


    menubtn.addEventListener("click",function(){
        hidden_nav.style.right = 0;
        dashboard.style.width = "95%" ;
    });
    cancelmenu.addEventListener("click",function(){
        hidden_nav.style.right = "-10%";
        dashboard.style.width = "100%" ;
    });

    userBtn.addEventListener("click" , function(){
        dashboard.classList.add("blur");
        animation.classList.add("blur");
        form_container.classList.add("show");
        user_container.classList.add("show");
    });

    canceluserbtn.addEventListener("click" , function(){
        dashboard.classList.remove("blur");
        animation.classList.remove("blur");
        form_container.classList.remove("show");
        user_container.classList.remove("show");
    });

    passBtn.addEventListener("click" , function(){
        dashboard.classList.add("blur");
        animation.classList.add("blur");
        form_container.classList.add("show");
        pass_container.classList.add("show");
    });


    cancelpassBtn.addEventListener("click" , function(){
        dashboard.classList.remove("blur");
        animation.classList.remove("blur");
        form_container.classList.remove("show");
        pass_container.classList.remove("show");
    });

    let confirmUser = document.getElementById("edit_username");

    confirmUser.addEventListener("click" , function(){
        let newname = document.getElementsByName("new_name")[0].value.trim();
        let confirmnewname = document.getElementsByName("Confirm_new_name")[0].value.trim();
        let error = document.getElementById("error_user");

        if (newname === '' || confirmnewname === '') {
            error.textContent = "Please fill in both fields";
        }else if (newname!== confirmnewname) {
            error.textContent = "Username does not match";
        }else{
            let url = "admin_action.php";
            url += "?new_name=" + encodeURIComponent(newname);
            window.location.href = url;
        }
    }); 

    let confirmPass = document.getElementById("edit_password");

    confirmPass.addEventListener("click" , function(){
        let oldpass = document.getElementsByName("old_pass")[0].value.trim();
        let newpass = document.getElementsByName("new_pass")[0].value.trim();
        let confirmnewpass = document.getElementsByName("confirm_new_pass")[0].value.trim();
        let error = document.getElementById("error_pass");

        if (oldpass === '' || newpass === '' || confirmnewpass === '') {
            error.textContent = "Please fill in all fields";
        }else if (newpass!== confirmnewpass) {
            error.textContent = "Password does not match";
        }else if( oldpass != is_old_password  ) {
            error.textContent = "Old password is incorrect";
        }else{
            let url = "admin_action.php";
            url += "?new_pass=" + encodeURIComponent(newpass);
            window.location.href = url;
        }
    });
});