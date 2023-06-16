const pswrdField = document.querySelectorAll(".input-field input[type='password']");
const toggleIcons = document.querySelectorAll(".input-field .fa-eye-slash");

for (let i = 0; i < toggleIcons.length; i++) {
  toggleIcons[i].onclick = () => {
    if (pswrdField[i].type === "password") {
      pswrdField[i].type = "text";
      toggleIcons[i].classList.add("active");
    } else {
      pswrdField[i].type = "password";
      toggleIcons[i].classList.remove("active");
    }
  };
}