import { isEmpty} from "./services.js";
import { addToCart, remove, search, placeOrder, CheckPlaceOrder, CheckSigned} from "./ajaxs.js";

const indexSnackbar = document.getElementsByClassName('index-snackbar');
const signedSnackbar = document.getElementsByClassName('signed-snackbar');
const page = document.getElementById("page");
const addBtns = document.getElementsByClassName("add-btn");
const placeBtn = document.getElementById("place-btn");

// XHR instant
var xhr = new XMLHttpRequest();

// Empty pages note.
if (page && isEmpty(page)) {
  page.innerHTML = `
    <h1 class="empty">There are no items yet!</h1>
  `;
}

// Event Listeners.

// Removing items to cart eventListener.
// We Used Event Delegation.
if(page) {
  page.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("remove-btn")) {
      remove(e);
    }
  });
}
// Adding items to cart eventListener.
for (var i = 0; i < addBtns.length; i++) {
  // Add event listener to each form.
  addBtns[i].addEventListener("click", function(e) {
    addToCart(e);
  });
}
// Search event listener.
if (document.getElementById("search-form")) {
  const searchForm = document.getElementById("search-form");

  searchForm.addEventListener("submit", function (e) {
    search(e);
  });
}

// Place order event listener.
if (placeBtn) {
  placeBtn.addEventListener('click', function(e) {
    placeOrder(e);
  });
}
// Place order snackbar.
if(indexSnackbar) {
  document.addEventListener('DOMContentLoaded', CheckPlaceOrder);
}
// Signed up snackbar.
if(signedSnackbar) {
  document.addEventListener('DOMContentLoaded', CheckSigned);
}