import { isEmpty } from "./services.js";
import { CheckSigned } from "./user_ajax.js";
import {
  removeItemFromRes,
  updatePizzaDetails,
  updateOrderStatus_res,
  checkUpdatedOrder,
  addPizza,
  checkNewPizza,
} from "./res_ajaxs.js";
import {
  addToCart,
  removeFromCart,
  search,
  placeOrder,
  CheckPlaceOrder,
} from "./client_ajaxs.js";
import { updateOrderStatus_driver } from "./driver_ajaxs.js";
import { addNewAccount } from "./admin_ajax.js"
// Used to show (empty note).
const page = document.getElementsByClassName("page");
// Used for event Listener.
const clientPage = document.getElementById("page");
const resPage = document.getElementById("res-index");
const placeBtn = document.getElementById("place-btn");
const itemUpdateForm = document.getElementById("item-update-form");
const restaurantOrderForm = document.getElementById("restaurant-order-form");
const driverOrderForm = document.getElementById("driver-order-form");
const addForm = document.getElementById("add-pizza-form");
const addBtn = document.getElementById("add-pizza-btn");
const newAdminBtn = document.getElementById("new-admin-submit-btn");
const newRestaurantBtn = document.getElementById("new-restaurant-submit-btn");
const newDriverBtn = document.getElementById("new-driver-submit-btn");
const newClientBtn = document.getElementById("new-client-submit-btn");

// XHR instant
// var xhr = new XMLHttpRequest();

/*
  - Checks if the page is empty to add empty note.
  - We used page[0] because its a class and it will return HTMLCollection [].
*/
if (page[0] && isEmpty(page[0])) {
  page[0].innerHTML = `
   <h1 class='empty'>There are no items yet!</h1>
  `;
}





/*--------------------------------------------- Event Listeners -------------------------------------- */

// We Used Event Delegation.
if (clientPage) {
  clientPage.addEventListener("click", function (e) {
    // Removing items to cart eventListener.
    if (e.target && e.target.classList.contains("remove-btn")) {
      removeFromCart(e);
      // Adding items to cart eventListener.
    } else if (e.target && e.target.classList.contains("add-btn")) {
      addToCart(e);
    }
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
  placeBtn.addEventListener("click", function (e) {
    placeOrder(e);
  });
}

// Remove item from dashboard, Restaurant side.
if (resPage) {
  resPage.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("remove-btn")) {
      removeItemFromRes(e);
    }
  });
}

// Update item in the dashboard, Restaurant side.
if (itemUpdateForm) {
  const updateSubmitBtn = document.getElementById("update-submit-btn");
  updateSubmitBtn.addEventListener("click", function (e) {
    updatePizzaDetails(e);
  });
}

// Update order status from restaurant side.
if (restaurantOrderForm) {
  restaurantOrderForm.addEventListener("click", updateOrderStatus_res);
}

// Add new item to restaurant event listener.
if (addForm) {
  addBtn.addEventListener("click", addPizza);
}

// Update order status from driver side.
if (driverOrderForm) {
  driverOrderForm.addEventListener("click", updateOrderStatus_driver);
}

// Adding new admin account btn.
if(newAdminBtn) {
  newAdminBtn.addEventListener('click', addNewAccount)
}
if(newRestaurantBtn) {
  newRestaurantBtn.addEventListener('click', addNewAccount)
}
if(newDriverBtn) {
  newDriverBtn.addEventListener('click', addNewAccount)
}
if(newClientBtn) {
  newClientBtn.addEventListener('click', addNewAccount)
}



/*----------------------------------------- Snack bars event listeners ------------------------------------ */

// Place order snackbar.
document.addEventListener("DOMContentLoaded", CheckPlaceOrder);
// Signed up snackbar.
document.addEventListener("DOMContentLoaded", CheckSigned);
// Updated order snackbar.
document.addEventListener("DOMContentLoaded", checkUpdatedOrder);
// New pizza add snackbar.
document.addEventListener("DOMContentLoaded", checkNewPizza);