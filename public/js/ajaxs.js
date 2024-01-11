import { showSnackbar, generatePizzaHTML } from "./services.js";

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
    var resID = searchResID.value;
    var params = "search_content=" + search;
    var url = "http://localhost/pizzapoint/clients/restaurant/" + resID;
  
    xhr.open("POST", url, true);
    // Needed when using POST request
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.onload = function () {
      let response = this.responseText;
      if (response.trim() === "") {
        page.innerHTML = `
                <h1 class="empty">there is no match items!<h1>
                `;
      } else {
        page.innerHTML = this.responseText;
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
      var response = this.responseText;

      // Check for duplicates and alert if exist
      if (response.startsWith("exist")) {
        showSnackbar("Pizza already in the cart");
      }
    };
    xhr.send(params);
  } 
}

// Remove item from cart AJAX.
export function remove(e) {
    var pizzaID = e.target.getAttribute("id");
    var url = "http://localhost/pizzapoint/clients/remove/" + pizzaID;
    var params = "pizza_id=" + pizzaID;
  
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      var pizzas = JSON.parse(this.responseText);
  
      // Check if the response(pizzas) is an array.
      if (Array.isArray(pizzas)) {
        page.innerHTML = "";
  
        pizzas.forEach(function (pizza) {
          page.innerHTML += generatePizzaHTML(pizza);
        });
      } else {
        page.innerHTML = `
      <h1 class="empty">there is no items yet!<h1>
      `;
      }
    };
    xhr.send(params);
  }