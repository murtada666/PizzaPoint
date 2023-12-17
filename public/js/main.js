import { search } from "./search.js";
import { showSnackbar, isEmpty, generatePizzaHTML } from "./services.js";


const page = document.getElementById("page");
const searchResID = document.getElementById("res-id");

const addForms = document.getElementsByClassName("add-form");

const removeForms = document.getElementsByClassName("remove-from-cart");

if (document.getElementById("search-form")) {
  const searchForm = document.getElementById("search-form");

  searchForm.addEventListener("submit", function (e) {
    search(e);
  });
}

// XHR instant
var xhr = new XMLHttpRequest();

// Empty pages note.
if (page) {
  if (isEmpty(page)) {
    page.innerHTML = `
        <h1 class="empty">there is no items yet!<h1>
        `;
  }
}

function addToCart(e) {
  if (e.target && e.target.id.startsWith("add-form")) {
    e.preventDefault();


    var form = e.target;

    var pizzaID = form.getAttribute("data-product-id");

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
        // alert("Pizza already in the cart");
      }
    };
    // console.log(params);
    xhr.send(params);
  }
}

// Remove item from cart
function remove(e) {
  e.preventDefault();

  var form = e.target;
  var pizzaID = form.getAttribute("data-product-id");
  var url = "http://localhost/pizzapoint/clients/remove/" + pizzaID;
  var params = "pizza_id=" + pizzaID;

  xhr.open("POST", url, true);

  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {

    var pizzas = JSON.parse(this.responseText);

    if (Array.isArray(pizzas)) {

      page.innerHTML = "";

      pizzas.forEach(function(pizza) {
        page.innerHTML += generatePizzaHTML(pizza);
          console.log("my pizza: ", pizza);
      });
  }
  };
  xhr.send(params);
}

// Event Listeners
for (var i = 0; i < removeForms.length; i++) {
  // Add event listener to each form
  removeForms[i].addEventListener("submit", remove);
}
for (var i = 0; i < addForms.length; i++) {
  // Add event listener to each form
  addForms[i].addEventListener("submit", addToCart);
}