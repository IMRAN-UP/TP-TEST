document.addEventListener("DOMContentLoaded", function () {
  var Btns = document.querySelectorAll(".btns");
  var departementContainer = document.getElementById("departement_container");
  var nodepartement = document.getElementById("no_departement_container");
  var formsContainer = document.getElementById("forms_container");

  let menubtn = document.getElementById("menu_btn");
  let cancelmenu = document.getElementById("cancel_menu");
  let hidden_nav = document.getElementById("hidden_nav");
  menubtn.addEventListener("click", function () {
    hidden_nav.style.right = 0;
    if (numberDepartements == 0){
        nodepartement.style.width = "95%";
    }else{
        departementContainer.style.width = "95%";
    }
    
  });
  cancelmenu.addEventListener("click", function () {
    hidden_nav.style.right = "-10%";
    if (numberDepartements == 0){
        nodepartement.style.width = "100%";
    }else{
        departementContainer.style.width = "100%";
    }
  });

  Btns.forEach((btn) => {
    btn.addEventListener("click", function () {
      var departementId = this.getAttribute("data-departement-id");

      if (this.getAttribute("data-action") == "remove") {
        var removeContainer = document.getElementById("remove_container");
        var removed_departement = document.getElementById(
          "removed_departement"
        );
        var confirmRemoveBtn = document.getElementById("confirm_remove_btn");
        var cancelRemoveBtn = document.getElementById("cancel_remove_btn");

        removed_departement.textContent = this.getAttribute(
          "data-departement-name"
        );
        removeContainer.classList.add("show");
        formsContainer.classList.add("show");
        departementContainer.classList.add("blur");

        confirmRemoveBtn.addEventListener("click", function () {
          window.location.href =
            "departement_action.php?removed_departement_id=" + departementId;
        });

        cancelRemoveBtn.addEventListener("click", function () {
          removeContainer.classList.remove("show");
          formsContainer.classList.remove("show");
          departementContainer.classList.remove("blur");
        });
      }

      if (this.getAttribute("data-action") == "edit") {
        var editContainer = document.getElementById("edit_container");
        var edited_departement = document.getElementById("edited_departement");
        var cancelEditBtn = document.getElementById("cancel_edit_btn");
        var confirmEditBtn = document.getElementById("confirm_edit_btn");

        edited_departement.textContent = this.getAttribute(
          "data-departement-name"
        );
        editContainer.classList.add("show");
        formsContainer.classList.add("show");
        departementContainer.classList.add("blur");

        cancelEditBtn.addEventListener("click", function () {
          editContainer.classList.remove("show");
          formsContainer.classList.remove("show");
          departementContainer.classList.remove("blur");
        });

        function verifyEditForm() {
          var newName = document
            .getElementsByName("new_departement_name")[0]
            .value.trim();
          var confirmNewName = document
            .getElementsByName("confirm_new_departement_name")[0]
            .value.trim();
          var error = document.getElementById("edit_error");
          var url = "departement_action.php";
          url += "?new_departement_name=" + encodeURIComponent(newName);
          url += "&edited_departement_id=" + encodeURIComponent(departementId);

          if (newName === "" || confirmNewName === "") {
            error.textContent = "Please fill in all fields";
            return false;
          }
          if (newName !== confirmNewName) {
            error.textContent = "Names not matched";
            return false;
          }
          error.textContent = "";
          return url;
        }

        confirmEditBtn.addEventListener("click", function () {
          if (verifyEditForm() !== false) {
            window.location.href = verifyEditForm();
          }
        });
      }
    });
  });

  var addbtn = document.getElementById("addbtn");
  var addcontainer = document.getElementById("add_container");
  var cancelAddBtn = document.getElementById("cancel_add_btn");
  var confirmAddBtn = document.getElementById("confirm_add_btn");

  addbtn.addEventListener("click", function () {
    addcontainer.classList.add("show");
    formsContainer.classList.add("show");

    if (numberDepartements == 0) {
      nodepartement.classList.add("blur");
    } else {
      departementContainer.classList.add("blur");
    }
  });

  cancelAddBtn.addEventListener("click", function () {
    addcontainer.classList.remove("show");
    formsContainer.classList.remove("show");

    if (numberDepartements == 0) {
      nodepartement.classList.remove("blur");
    } else {
      departementContainer.classList.remove("blur");
    }
  });

  function verifyAddForm() {
    var Name = document.getElementsByName("departement_name")[0].value.trim();
    var confirmName = document
      .getElementsByName("confirm_departement_name")[0]
      .value.trim();
    var error = document.getElementById("add_error");
    var url = "departement_action.php";
    url += "?name=" + encodeURIComponent(Name);

    if (Name === "" || confirmName === "") {
      error.textContent = "Please fill in all fields";
      return false;
    }
    if (Name !== confirmName) {
      error.textContent = "Names not matched";
      return false;
    }
    error.textContent = "";
    return url;
  }

  confirmAddBtn.addEventListener("click", function () {
    if (verifyAddForm() !== false) {
      window.location.href = verifyAddForm();
    }
  });
});
