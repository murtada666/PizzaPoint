import { showSnackbar } from "./services.js";

// XHR instant
var xhr = new XMLHttpRequest();

// Signed up snackbar AJAX.
export function CheckSigned() {
    var url = "http://localhost/pizzapoint/users/check_signed";
  
    xhr.open("GET", url, true);
    xhr.onload = function () {
      if (this.responseText.trim() === "true") {
        showSnackbar("You are signed up!");
      }
    };
    xhr.send();
  }
  