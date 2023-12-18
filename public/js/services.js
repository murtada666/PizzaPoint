export function showSnackbar(message) {
  var snackbar = document.getElementById("snackbar");
  snackbar.textContent = message; // Set the message dynamically
  snackbar.style.display = "block";

  // Hide the Snackbar after 3 seconds (3000 milliseconds)
  setTimeout(function () {
    snackbar.style.display = "none";
  }, 3000);
}

// checks if the page is empty or not
export function isEmpty(page_name) {
  const page_content = page_name.innerHTML.trim();
  if (page_content) {
    return false;
  } else {
    return true;
  }
}

export function generatePizzaHTML(pizza) {
  var html = `
      <div class='pizza-container'>
          <img src='../img/pizza.svg'>
          <div>
              <h6>${pizza.title}</h6>
              <ul class='ing'>
                  ${pizza.ingredients.split(',').map(ing => `<li>${ing.trim()}</li>`).join('')}
              </ul>
          </div>
          <div class='pizza-btn'>
            <input type='button' name='remove' value='Remove' id="${pizza.id}" class="remove-btn">
            <a href="http://localhost/pizzapoint/clients/details/${pizza.id}">More info</a>
          </div>
      </div>`;
  return html;
}  