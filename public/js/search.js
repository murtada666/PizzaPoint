const page = document.getElementById("page");
const searchResID = document.getElementById("res-id");
const searchContent = document.getElementById("search-content");


// XHR instant
var xhr = new XMLHttpRequest();

// Search function
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