import { showSnackbar, generateClientPizzaHTML } from "./services.js";

const searchResID = document.getElementById("res-id");
const page = document.getElementById("page");
const searchContent = document.getElementById("search-content");

// XHR instant
var xhr = new XMLHttpRequest();

// Search AJAX.
export function search(e) {
  e.preventDefault();

  // Search content is used to target the search action
  var search = searchContent.value;
  var params = "search_content=" + search;
  var url = "http://localhost/pizzapoint/clients/search";

  xhr.open("POST", url, true);
  // Needed when using POST request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    var response = JSON.parse(this.responseText);
    if (Array.isArray(response)) {
      page.innerHTML = "";

      response.forEach(function (pizza) {
        page.innerHTML += generateClientPizzaHTML(pizza, 'add');
      });
    } else if (response === "empty") {
      page.innerHTML = `
                <h1 class="empty">there is no match items!<h1>
                `;
    }
  };

  xhr.send(params);
}
// Add to cart AJAX.
export function addToCart(e) {
  if (e.target) {
    var pizzaID = e.target.getAttribute("id");
    var pizzaPrice = e.target.getAttribute("price");
    var resID = searchResID.value;
    var url = "http://localhost/pizzapoint/clients/restaurant/" + resID;
    var params =
      "pizza_id=" +
      encodeURIComponent(pizzaID) +
      "&price=" +
      encodeURIComponent(pizzaPrice);

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      // Check for duplicates and alert if exist
      if (this.responseText.startsWith("exist")) {
        showSnackbar("Pizza already in the cart");
      }
    };
    xhr.send(params);
  }
}

// Remove item from cart AJAX.
export function removeFromCart(e) {
  var pizzaID = e.target.getAttribute("id");
  var pizzaPrice = e.target.getAttribute("price");
  var url = "http://localhost/pizzapoint/clients/remove/" + pizzaID;
  var params =
    "pizza_id=" +
    encodeURIComponent(pizzaID) +
    "&price=" +
    encodeURIComponent(pizzaPrice);

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    var result = JSON.parse(this.responseText);

    // Check if the response(pizzas) is an array.
    if (Array.isArray(result[0])) {
      page.innerHTML = "";

      total.innerHTML = result[1][0].total;

      result[0].forEach(function (pizza) {
        page.innerHTML += generateClientPizzaHTML(pizza, 'remove');
      });
    } else {
      page.innerHTML = `
      <h1 class="empty">there is no items yet!<h1>
      `;
      total.innerHTML = 0;
    }
  };
  xhr.send(params);
}

// Place order AJAX.
export function placeOrder(e) {
  e.preventDefault();

  var url = "http://localhost/pizzapoint/clients/order";

  xhr.open("GET", url, true);
  xhr.onload = function () {
    // Check if the cart is empty to show snackbar.
    if (this.responseText.trim() === "empty") {
      page.innerHTML += '<div id="snackbar"></div>';
      showSnackbar("Cart is empty, please add some items first!");
      // Check if the order is placed.
    } else if (this.responseText.trim() === "placed") {
      window.location.href = "http://localhost/pizzapoint/clients/index";
    }
  };
  xhr.send();
}

// Place order snackbar AJAX.
export function CheckPlaceOrder() {
  var url = "http://localhost/pizzapoint/clients/checkPlaceOrder";

  xhr.open("GET", url, true);
  xhr.onload = function () {
    if (this.responseText.trim() === "true") {
      showSnackbar("Your order is placed!");
    }
  };
  xhr.send();
}
