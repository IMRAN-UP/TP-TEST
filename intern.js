document.addEventListener("DOMContentLoaded", function () {
  var Btns = document.querySelectorAll(".btns");
  var internsContainer = document.getElementById("intern_container");
  var nodepartement = document.getElementById("no_interns_container");
  var formsContainer = document.getElementById("forms_container");

  let menubtn = document.getElementById("menu_btn");
  let cancelmenu = document.getElementById("cancel_menu");
  let hidden_nav = document.getElementById("hidden_nav");
  menubtn.addEventListener("click", function () {
    hidden_nav.style.right = 0;
    if (numberInterns == 0) {
      nodepartement.style.width = "95%";
    } else {
        internsContainer.style.width = "95%";
    }
  });
  cancelmenu.addEventListener("click", function () {
    hidden_nav.style.right = "-10%";
    if (numberInterns == 0) {
      nodepartement.style.width = "100%";
    } else {
        internsContainer.style.width = "100%";
    }
  });

  Btns.forEach((btn) => {
    btn.addEventListener("click", function () {
      var internId = this.getAttribute("data-intern-id");

      if (this.getAttribute("data-action") == "remove") {
        var removeContainer = document.getElementById("remove_container");
        var removed_intern = document.getElementById("removed_intern");
        var confirmRemoveBtn = document.getElementById("confirm_remove_btn");
        var cancelRemoveBtn = document.getElementById("cancel_remove_btn");

        removed_intern.textContent = this.getAttribute("data-intern-name");
        removeContainer.classList.add("show");
        formsContainer.classList.add("show");
        internsContainer.classList.add("blur1");

        confirmRemoveBtn.addEventListener("click", function () {
          window.location.href =
            "intern_action.php?removed_intern_id=" + internId;
        });

        cancelRemoveBtn.addEventListener("click", function () {
          removeContainer.classList.remove("show");
          formsContainer.classList.remove("show");
          internsContainer.classList.remove("blur1");
        });
      }

      if (this.getAttribute("data-action") == "edit") {
        var editContainer = document.getElementById("edit_container");
        var edited_intern = document.getElementById("edited_intern");
        var cancelEditBtn = document.getElementById("cancel_edit_btn");
        var confirmEditBtn = document.getElementById("confirm_edit_btn");

        edited_intern.textContent = this.getAttribute("data-intern-name");
        editContainer.classList.add("show");
        formsContainer.classList.add("show");
        internsContainer.classList.add("blur1");

        cancelEditBtn.addEventListener("click", function () {
          editContainer.classList.remove("show");
          formsContainer.classList.remove("show");
          internsContainer.classList.remove("blur1");
        });

        function verifyEditForm() {
          var newFirstName = document
            .getElementsByName("new_first_name")[0]
            .value.trim();
          var newLastName = document
            .getElementsByName("new_last_name")[0]
            .value.trim();
          var newBirthday = document
            .getElementsByName("new_birthday")[0]
            .value.trim();
          var error = document.getElementById("edit_error");
          var url = "intern_action.php";
          url += "?new_first_name=" + encodeURIComponent(newFirstName);
          url += "&new_last_name=" + encodeURIComponent(newLastName);
          url += "&new_birthday=" + encodeURIComponent(newBirthday);
          url += "&edited_intern_id=" + encodeURIComponent(internId);

          if (newFirstName === "" || newLastName === "" || newBirthday === "") {
            error.textContent = "Please fill in all fields";
            return false;
          } else {
            error.textContent = "";
            return url;
          }
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

    if (numberInterns == 0) {
      nodepartement.classList.add("blur2");
    } else {
      internsContainer.classList.add("blur1");
    }
  });

  cancelAddBtn.addEventListener("click", function () {
    addcontainer.classList.remove("show");
    formsContainer.classList.remove("show");

    if (numberInterns == 0) {
      nodepartement.classList.remove("blur2");
    } else {
      internsContainer.classList.remove("blur1");
    }
  });

  function verifyAddForm() {
    var firstName = document.getElementsByName("first_name")[0].value.trim();
    var lastName = document.getElementsByName("last_name")[0].value.trim();
    var birthday = document.getElementsByName("birthday")[0].value.trim();
    var error = document.getElementById("add_error");
    var url = "intern_action.php";
    url += "?first_name=" + encodeURIComponent(firstName);
    url += "&last_name=" + encodeURIComponent(lastName);
    url += "&birthday=" + encodeURIComponent(birthday);

    if (firstName === "" || lastName === "" || birthday === "") {
      error.textContent = "Please fill in all fields";
      return false;
    } else {
      error.textContent = "";
      return url;
    }
  }

  confirmAddBtn.addEventListener("click", function () {
    if (verifyAddForm() !== false) {
      window.location.href = verifyAddForm();
    }
  });
});
