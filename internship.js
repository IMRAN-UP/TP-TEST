document.addEventListener("DOMContentLoaded", function () {
  var removeBtns = document.querySelectorAll(".removebtns");
  var editBtns = document.querySelectorAll(".editbtns");
  var internshipContainer = document.getElementById("internship_container");
  var nodepartement = document.getElementById("no_internship_container");
  var formsContainer = document.getElementById("forms_container");

  let menubtn = document.getElementById("menu_btn");
  let cancelmenu = document.getElementById("cancel_menu");
  let hidden_nav = document.getElementById("hidden_nav");
  menubtn.addEventListener("click", function () {
    hidden_nav.style.right = 0;
    if (numberinternships == 0) {
      nodepartement.style.width = "95%";
    } else {
        internshipContainer.style.width = "95%";
    }
  });
  cancelmenu.addEventListener("click", function () {
    hidden_nav.style.right = "-10%";
    if (numberinternships == 0) {
      nodepartement.style.width = "100%";
    } else {
        internshipContainer.style.width = "100%";
    }
  });

  window.onload = function () {
    setTimeout(function () {
      var errorMessage = document.getElementById("msg_error");
      if (errorMessage) {
        errorMessage.style.display = "none";
      }
    }, 5000);
  };

  removeBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      var internshipId = this.getAttribute("data-internship-id");
      var removeContainer = document.getElementById("remove_container");
      var removed_departement = document.getElementById("removed_departement");
      var confirmRemoveBtn = document.getElementById("confirm_remove_btn");
      var cancelRemoveBtn = document.getElementById("cancel_remove_btn");

      removeContainer.classList.add("show");
      formsContainer.classList.add("show");
      internshipContainer.classList.add("blur");

      cancelRemoveBtn.addEventListener("click", function () {
        removeContainer.classList.remove("show");
        formsContainer.classList.remove("show");
        internshipContainer.classList.remove("blur");
      });

      confirmRemoveBtn.addEventListener("click", function () {
        window.location.href =
          "internship_action.php?removed_internship_id=" + internshipId;
      });
    });
  });

  var departementId;
  var internId;
  var stardate;
  var enddate;

  editBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      var internshipId = this.getAttribute("data-internship-id");
      console.log(internshipId);
      var editContainer = document.getElementById("edit_container");
      var cancel_edit_btn = document.getElementById("cancel_edit_btn");

      editContainer.classList.add("show");
      formsContainer.classList.add("show");
      internshipContainer.classList.add("blur");

      cancel_edit_btn.addEventListener("click", function () {
        editContainer.classList.remove("show");
        formsContainer.classList.remove("show");
        internshipContainer.classList.remove("blur");
      });

      var step1 = document.getElementById("edit_step1");
      var step2 = document.getElementById("edit_step2");
      var step3 = document.getElementById("edit_step3");
      var next1 = document.getElementById("edit_next1");
      var next2 = document.getElementById("edit_next2");
      var prev1 = document.getElementById("edit_prev1");
      var prev2 = document.getElementById("edit_prev2");

      next1.addEventListener("click", function () {
        step2.style.right = "10%";
        step1.style.right = "100%";
      });

      prev1.addEventListener("click", function () {
        step2.style.right = "-100%";
        step1.style.right = "10%";
      });

      next2.addEventListener("click", function () {
        step3.style.right = "10%";
        step2.style.right = "100%";
      });

      prev2.addEventListener("click", function () {
        step3.style.right = "-100%";
        step2.style.right = "10%";
      });

      var checkDepartementBtns = document.querySelectorAll(
        ".check_departement_edit_Btns"
      );

      checkDepartementBtns.forEach(function (radioButton) {
        radioButton.addEventListener("change", function () {
          departementId = this.getAttribute("data-departement-id");
          checkDepartementBtns.forEach(function (btn) {
            if (btn !== radioButton && btn.name === radioButton.name) {
              btn.checked = false;
            }
          });
        });
      });

      var checkInternBtns = document.querySelectorAll(
        ".check_intern_edit_Btns"
      );
      checkInternBtns.forEach(function (radioButton) {
        radioButton.addEventListener("change", function () {
          internId = this.getAttribute("data-intern-id");
          checkInternBtns.forEach(function (btn) {
            if (btn !== radioButton && btn.name === radioButton.name) {
              btn.checked = false;
            }
          });
        });
      });

      var confirmeditBtn = document.getElementById("confirm_edit_btn");

      confirmeditBtn.addEventListener("click", function () {
        stardate = document.getElementsByName("start_date")[0].value.trim();
        enddate = document.getElementsByName("end_date")[0].value.trim();

        var url = "Internship_action.php?";
        url += "internship_edited_id=" + internshipId;
        url += "&departement_id=" + departementId;
        url += "&intern_id=" + internId;
        url += "&start_date=" + encodeURIComponent(stardate);
        url += "&end_date=" + encodeURIComponent(enddate);

        window.location.href = url;
      });
    });
  });

  var addBtn = document.getElementById("addbtn");
  var addContainer = document.getElementById("add_container");

  addBtn.addEventListener("click", function () {
    addContainer.classList.add("show");
    formsContainer.classList.add("show");
    if (numberinternships != 0) {
      internshipContainer.classList.add("blur");
    } else {
      nodepartement.classList.add("blur");
    }

    var cancel_add_btn = document.getElementById("cancel_add_btn");

    cancel_add_btn.addEventListener("click", function () {
      addContainer.classList.remove("show");
      formsContainer.classList.remove("show");

      if (numberinternships != 0) {
        internshipContainer.classList.remove("blur");
      } else {
        nodepartement.classList.remove("blur");
      }
    });

    var step1 = document.getElementById("add_step1");
    var step2 = document.getElementById("add_step2");
    var step3 = document.getElementById("add_step3");
    var next1 = document.getElementById("add_next1");
    var next2 = document.getElementById("add_next2");
    var prev1 = document.getElementById("add_prev1");
    var prev2 = document.getElementById("add_prev2");

    next1.addEventListener("click", function () {
      step2.style.right = "10%";
      step1.style.right = "100%";
    });

    prev1.addEventListener("click", function () {
      step2.style.right = "-100%";
      step1.style.right = "10%";
    });

    next2.addEventListener("click", function () {
      step3.style.right = "10%";
      step2.style.right = "100%";
    });

    prev2.addEventListener("click", function () {
      step3.style.right = "-100%";
      step2.style.right = "10%";
    });

    var checkDepartementBtns = document.querySelectorAll(
      ".check_departement_add_Btns"
    );

    checkDepartementBtns.forEach(function (radioButton) {
      radioButton.addEventListener("change", function () {
        departementId = this.getAttribute("data-departement-id");
        checkDepartementBtns.forEach(function (btn) {
          if (btn !== radioButton && btn.name === radioButton.name) {
            btn.checked = false;
          }
        });
      });
    });

    var checkInternBtns = document.querySelectorAll(".check_intern_add_Btns");
    checkInternBtns.forEach(function (radioButton) {
      radioButton.addEventListener("change", function () {
        internId = this.getAttribute("data-intern-id");
        checkInternBtns.forEach(function (btn) {
          if (btn !== radioButton && btn.name === radioButton.name) {
            btn.checked = false;
          }
        });
      });
    });

    var confirmeditBtn = document.getElementById("confirm_add_btn");

    confirmeditBtn.addEventListener("click", function () {
      stardate = document.getElementsByName("start_add_date")[0].value.trim();
      enddate = document.getElementsByName("end_add_date")[0].value.trim();

      var url = "Internship_action.php?";
      url += "added_departement_id=" + departementId;
      url += "&added_intern_id=" + internId;
      url += "&added_start_date=" + encodeURIComponent(stardate);
      url += "&added_end_date=" + encodeURIComponent(enddate);

      window.location.href = url;
    });
  });
});
