
// XHR instant
var xhr = new XMLHttpRequest();

export function addNewAdminUser(e) {
    e.preventDefault();

    // Get form values.
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();
    var confirmPassword = document.getElementById("confirm_password").value.trim();

    var params =
    "name=" +
    encodeURIComponent(name) +
    "&email=" +
    encodeURIComponent(email) +
    "&password=" +
    encodeURIComponent(password) +
    "&confirm_password=" +
    encodeURIComponent(confirmPassword);

    var url = "http://localhost/pizzapoint/admins/add_admin";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        // In case user saved to DB.
        if (JSON.parse(this.responseText) == 1) {
        // Navigate to home page.
        window.location.href = "http://localhost/pizzapoint/admins/index";
        } else {
        var response = JSON.parse(this.responseText);
        console.log(response.email_err)
        
        // Show errors in form.
        document.getElementById("name-err").innerHTML = response.name_err;
        document.getElementById("email-err").innerHTML = response.email_err;
        document.getElementById("password-err").innerHTML = response.price_err;
        document.getElementById("confirm_password_err").innerHTML = response.price_err;
        }
    };
    xhr.send(params);
}
