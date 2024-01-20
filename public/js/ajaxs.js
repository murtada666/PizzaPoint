import { showSnackbar, generateClientPizzaHTML, generateResPizzaHTML } from "./services.js";

const searchResID = document.getElementById("res-id");
const page = document.getElementById("page");
const searchContent = document.getElementById("search-content");
const resPage = document.getElementById("res-index");
const itemUpdateForm = document.getElementById('item-update-form');


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
        page.innerHTML += generatePizzaHTML(pizza);
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
    var resID = searchResID.value;
    var url = "http://localhost/pizzapoint/clients/restaurant/" + resID;
    var params = "pizza_id=" + pizzaID;

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
  var url = "http://localhost/pizzapoint/clients/remove/" + pizzaID;
  var params = "pizza_id=" + pizzaID;

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    var pizzas = JSON.parse(this.responseText);

    // Check if the response(pizzas) is an array.
    if (Array.isArray(pizzas)) {
      page.innerHTML = '';

      pizzas.forEach(function (pizza) {
        page.innerHTML += generateClientPizzaHTML(pizza);
      });
    } else {
      page.innerHTML = `
      <h1 class="empty">there is no items yet!<h1>
      `;
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
    if ((pizzas = pizzas = JSON.parse(this.responseText))) {
      if (Array.isArray(pizzas)) {
        resPage.innerHTML = '';

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
  var pizzaID = itemUpdateForm.getAttribute('value');
  const title = document.getElementById('update-title');
  const ing = document.getElementById('update-ing');
  // EncodeURIComponent -> Encodes a string to make it safe for use as a component of a Uniform Resource Identifier (URI).
  var params =
    'pizza_id=' +
    encodeURIComponent(pizzaID) +
    '&title=' +
    encodeURIComponent(title.value) +
    '&ing=' +
    encodeURIComponent(ing.value);

  var url = 'http://localhost/pizzapoint/restaurants/update_pizza';
  xhr.open('POST', url, true);

  // Needed when using POST request
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    // Decode the response first.
    var response = JSON.parse(this.responseText);
    // Redirect to index page if there is NO errors!.
    if (response === 'done') {
      window.location.href = 'http://localhost/pizzapoint/restaurants/index';
      // Check for any errors to render it.
    } else if (response.title !== '' || response.ingredients !== '') {
        // Title checking.
        if (response.title === 'empty') {
          document.getElementById('title-err').innerHTML = 'Title is required';
        } else if (response.title === 'unacceptable') {
          document.getElementById('title-err').innerHTML =
            'Title must be letters and spaces only';
        } else {
          document.getElementById('title-err').innerHTML = '';
        }
        
        // Ingredients checking.
        if (response.ingredients === 'empty') {
          document.getElementById('ing-err').innerHTML =
            'At least one ingredient is needed';
        } else if (response.ingredients === 'unacceptable') {
          document.getElementById('ing-err').innerHTML =
            'Ingredients must be a comma separated list';
        } else {
          document.getElementById('ing-err').innerHTML = '';
        }
    }
  };
  xhr.send(params);
}