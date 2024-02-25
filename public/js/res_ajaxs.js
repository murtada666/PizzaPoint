import {
  generateResPizzaHTML,
  showSnackbar,
  validateAddForm,
} from "./services.js";

const resPage = document.getElementById("res-index");
const itemUpdateForm = document.getElementById("item-update-form");

// XHR instant
var xhr = new XMLHttpRequest();

// Remove item from restaurant dashboard.
export function removeItemFromRes(e) {
  e.preventDefault();
  var pizzaID = e.target.getAttribute("id");
  var params = "pizza_id=" + pizzaID;
  var url = "http://localhost/pizzapoint/restaurants/remove_item";

  xhr.open("POST", url, true);

  // Needed when using POST request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    var pizzas;
    if ((pizzas = JSON.parse(this.responseText))) {
      if (Array.isArray(pizzas)) {
        resPage.innerHTML = "";

        // var cardClass = 'pizza-res-container'

        pizzas.forEach(function (pizza) {
          resPage.innerHTML += generateResPizzaHTML(pizza);
        });
      }
    } else {
      resPage.innerHTML = `
          <h1 class="empty">there is no items yet!<h1>
          `;
    }
  };
  // xhr.send();
  xhr.send(params);
}

// Update pizza details in the dashboard.
export function updatePizzaDetails(e) {
  e.preventDefault();
  var pizzaID = itemUpdateForm.getAttribute("value");
  const title = document.getElementById("update-title");
  const ing = document.getElementById("update-ing");
  // EncodeURIComponent -> Encodes a string to make it safe for use as a component of a Uniform Resource Identifier (URI).
  var params =
    "pizza_id=" +
    encodeURIComponent(pizzaID) +
    "&title=" +
    encodeURIComponent(title.value) +
    "&ing=" +
    encodeURIComponent(ing.value);

  var url = "http://localhost/pizzapoint/restaurants/update_pizza";
  xhr.open("POST", url, true);

  // Needed when using POST request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // Decode the response first.
    var response = JSON.parse(this.responseText);
    // Redirect to index page if there is NO errors!.
    if (response === "done") {
      window.location.href = "http://localhost/pizzapoint/restaurants/index";
      // Check for any errors to render it.
    } else if (response.title !== "" || response.ingredients !== "") {
      // Title checking.
      if (response.title === "empty") {
        document.getElementById("title-err").innerHTML = "Title is required";
      } else if (response.title === "unacceptable") {
        document.getElementById("title-err").innerHTML =
          "Title must be letters and spaces only";
      } else {
        document.getElementById("title-err").innerHTML = "";
      }

      // Ingredients checking.
      if (response.ingredients === "empty") {
        document.getElementById("ing-err").innerHTML =
          "At least one ingredient is needed";
      } else if (response.ingredients === "unacceptable") {
        document.getElementById("ing-err").innerHTML =
          "Ingredients must be a comma separated list";
      } else {
        document.getElementById("ing-err").innerHTML = "";
      }
    }
  };
  xhr.send(params);
}

// Update Order status.
export function updateOrderStatus(e) {
  // Represents the new status of the order.
  var theNewStatus = e.target.getAttribute("status") || "";
  var orderID = e.target.id || "";
  var params =
    "the_new_status=" +
    encodeURIComponent(theNewStatus) +
    "&order_id=" +
    encodeURIComponent(orderID);

  var url = "http://localhost/pizzapoint/restaurants/update_status";
  xhr.open("POST", url, true);

  // Needed when using POST request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // Check if the order is Updated successfully.
    if (this.responseText == 1) {
      console.log(this.responseText, "nice");
      // Navigate to orders page after updating the order.
      window.location.href = "http://localhost/pizzapoint/restaurants/orders";
    }
  };
  xhr.send(params);
}

// Check if the order status is updated to show snackbar in orders page.
export function checkUpdatedOrder() {
  var url = "http://localhost/pizzapoint/restaurants/check_updated_order";
  // Get request since there is nothing to send in params.
  xhr.open("GET", url, true);

  xhr.onload = function () {
    if (this.responseText == 1) {
      showSnackbar("Your order is updated successfully");
    }
  };
  xhr.send();
}

// Add pizza AJAX.
export function addPizza(e) {
  e.preventDefault();

  var url = "http://localhost/pizzapoint/restaurants/add_pizza";

  var title = document.getElementById("title").value.trim();
  var ing = document.getElementById("ingredients").value.trim();
  var price = document.getElementById("price").value.trim();

  // Validate the inputs.
  var response = validateAddForm(title, ing, price);

  if (
    response.title_err === "" &&
    response.ing_err === "" &&
    response.price_err === ""
  ) {
    // Initiate params for POST request.
    var params =
      "title=" + encodeURIComponent(title) + "&ing=" + encodeURIComponent(ing);
    "&price=" + encodeURIComponent(price);

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      console.log("done");
    };

    xhr.send(params);
  }
}
