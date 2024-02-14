import { addToCart, removeFromCart } from "./client_ajaxs.js";
import { clientPage } from "./main.js";

/* Event Listeners */
// Removing items to cart eventListener.
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
