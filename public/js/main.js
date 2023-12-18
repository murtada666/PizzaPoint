import { search } from "./search.js";
import { showSnackbar, isEmpty, generatePizzaHTML } from "./services.js";

const page = document.getElementById("page");
const searchResID = document.getElementById("res-id");
const addBtns = document.getElementsByClassName("add-btn");

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
  } else {
    console.log("target nothing");
  }
}

// Remove item from cart
function remove(e) {
  var pizzaID = e.target.getAttribute("id");
  var url = "http://localhost/pizzapoint/clients/remove/" + pizzaID;
  var params = "pizza_id=" + pizzaID;

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    var pizzas = JSON.parse(this.responseText);

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

// Event Listeners

// We Used Event Delegation.
page.addEventListener("click", function (e) {
  if (e.target && e.target.classList.contains("remove-btn")) {
    remove(e);
  }
});

for (var i = 0; i < addBtns.length; i++) {
  // Add event listener to each form
  addBtns[i].addEventListener("click", addToCart);
}

if (document.getElementById("search-form")) {
  const searchForm = document.getElementById("search-form");

  searchForm.addEventListener("submit", function (e) {
    search(e);
  });
}
