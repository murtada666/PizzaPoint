const page = document.getElementById("page");
const searchResID = document.getElementById("res-id");


const searchForm = document.getElementById("search-form");
const searchContent = document.getElementById("search-content");

const addForms = document.getElementsByClassName("add-form");
const pizzaID = document.getElementById("pizza-id");

const snackbar = document.getElementById("snackbar");

const removeForms = document.getElementsByClassName("remove-from-cart");


function showSnackbar(message) {
  var snackbar = document.getElementById("snackbar");
  snackbar.textContent = message;  // Set the message dynamically
  snackbar.style.display = "block";

  // Hide the Snackbar after 3 seconds (3000 milliseconds)
  setTimeout(function(){
      snackbar.style.display = "none";
  }, 3000);
}


// XHR instant
var xhr = new XMLHttpRequest();

// checks if the page is empty or not
function isEmpty(page_name) {
  const page_content = page_name.innerHTML.trim();
  if (page_content) {
    return false;
  } else {
    return true;
  }
}
// Empty pages note
if (isEmpty(page)) {
  page.innerHTML = `
    <h1 class="empty">there is no items yet!<h1>
    `;
}

// Search function
function search(e) {
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
    if(response.trim() === "") {
      page.innerHTML =  `
        <h1 class="empty">there is no match items!<h1>
        `;
    } else {
      page.innerHTML = this.responseText; 
    }
  };

  xhr.send(params);
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
      console.log(response);
      // Check for duplicates and alert if exist
      if (response.startsWith("exist")) {
        showSnackbar('Pizza already in the cart');
        // alert("Pizza already in the cart");
      }
    }
    // console.log(params);
    xhr.send(params);
  }
}

// Remove item from cart
function remove(e) {
    console.log('worked');

  e.preventDefault();

  console.log('worked');


}





// Event Listeners
searchForm.addEventListener("submit", search);
// removeForm.addEventListener("submit", remove);

for (var i = 0; i < removeForms.length; i++) {
  // Add event listener to each form
  removeForms[i].addEventListener("submit", remove);
}
for (var i = 0; i < addForms.length; i++) {
  // Add event listener to each form
  addForms[i].addEventListener("submit", addToCart);
}

