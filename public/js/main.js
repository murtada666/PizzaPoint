import { search } from "./search.js";
import { isEmpty} from "./services.js";
import { addToCart, remove } from "./ajaxs.js";

const page = document.getElementById("page");
const addBtns = document.getElementsByClassName("add-btn");

// XHR instant
var xhr = new XMLHttpRequest();

// Empty pages note.
if (page && isEmpty(page)) {
  page.innerHTML = `
    <h1 class="empty">There are no items yet!</h1>
  `;
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
  addBtns[i].addEventListener("click", function(e) {
    addToCart(e);
  });
}

if (document.getElementById("search-form")) {
  const searchForm = document.getElementById("search-form");

  searchForm.addEventListener("submit", function (e) {
    search(e);
  });
}
