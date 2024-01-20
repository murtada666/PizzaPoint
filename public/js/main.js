import { isEmpty } from './services.js';
import {
  addToCart,
  removeFromCart,
  search,
  placeOrder,
  CheckPlaceOrder,
  CheckSigned,
  removeItemFromRes,
  updatePizzaDetails
} from './ajaxs.js';

const indexSnackbar = document.getElementsByClassName('index-snackbar');
const signedSnackbar = document.getElementsByClassName('signed-snackbar');
// Used to show (empty note).
const page = document.getElementsByClassName('page');
// Used for event Listener.
const clientPage = document.getElementById('page');
const resPage = document.getElementById('res-index');
const addBtns = document.getElementsByClassName('add-btn');
const placeBtn = document.getElementById('place-btn');
const itemUpdateForm = document.getElementById('item-update-form');

// XHR instant
var xhr = new XMLHttpRequest();

/*
  - Checks if the page is empty to add empty note.
  - We used page[0] because its a class and it will return HTMLCollection [].
*/
if (page[0] && isEmpty(page[0])) {
  page[0].innerHTML = `
   <h1 class='empty'>There are no items yet!</h1>
  `;
}
/* Event Listeners */ 

// Removing items to cart eventListener.
// We Used Event Delegation.
if (clientPage) {
  clientPage.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('remove-btn')) {
      removeFromCart(e);
    }
  });
}

// Adding items to cart eventListener.
for (var i = 0; i < addBtns.length; i++) {
  // Add event listener to each form.
  addBtns[i].addEventListener('click', function (e) {
    addToCart(e);
  });
}
// Search event listener.
if (document.getElementById('search-form')) {
  const searchForm = document.getElementById('search-form');

  searchForm.addEventListener('submit', function (e) {
    search(e);
  });
}

// Place order event listener.
if (placeBtn) {
  placeBtn.addEventListener('click', function (e) {
    placeOrder(e);
  });
}
// Place order snackbar.
if (indexSnackbar) {
  document.addEventListener('DOMContentLoaded', CheckPlaceOrder);
}
// Signed up snackbar.
if (signedSnackbar) {
  document.addEventListener('DOMContentLoaded', CheckSigned);
}

// Remove item from dashboard, Restaurant side.
if (resPage) {
  resPage.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('remove-btn')) {
      removeItemFromRes(e);
    }
  });
}

// Update item in the dashboard, Restaurant side.
if (itemUpdateForm) {
  const updateSubmitBtn = document.getElementById('update-submit-btn');
  updateSubmitBtn.addEventListener('click', function (e) {
    updatePizzaDetails(e);
  });
}
