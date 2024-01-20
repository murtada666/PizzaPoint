// Dynamic snackbar.
export function showSnackbar(message) {
  var snackbar = document.getElementById("snackbar");
  snackbar.textContent = message; // Set the message dynamically
  snackbar.style.display = "block";

  // Hide the Snackbar after 3 seconds (3000 milliseconds)
  setTimeout(function () {
    snackbar.style.display = "none";
  }, 3000);
}

// Checks if the page is empty or not
export function isEmpty(element) {
  return element.childElementCount === 0 && element.textContent.trim() === "";
}

export function generateClientPizzaHTML(pizza) {
  var title =
    pizza.title.charAt(0).toUpperCase() + pizza.title.slice(1).toLowerCase();
  var html = `
      <div class='pizza-container'>
          <img src='http://localhost/pizzapoint/img/pizza.svg'>
          <div>
              <h6>${title}</h6>
              <ul class='ing'>
                  ${pizza.ingredients
                    .split(",")
                    .map((ing) => `<li>${ing.trim()}</li>`)
                    .join("")}
              </ul>
          </div>
          <div class='pizza-btn'>
            <input type='button' name='remove' value='Remove' id="${
              pizza.id
            }" class="remove-btn">
            <a href="http://localhost/pizzapoint/clients/details/${
              pizza.id
            }">More info</a>
          </div>
      </div>`;
  return html;
}

export function generateResPizzaHTML(pizza) {
  var title =
    pizza.title.charAt(0).toUpperCase() + pizza.title.slice(1).toLowerCase();
  var html = `
        <div class="pizza-res-container">
        <img src='http://localhost/pizzapoint/img/pizza.svg'>
        <div>
            <h6>${title}</h6>
            <ul class='ing'>
                  ${pizza.ingredients
                    .split(",")
                    .map((ing) => `<li>${ing.trim()}</li>`)
                    .join("")}
              </ul>
        </div>
        <div class="pizza-btn">
            <input type="submit" name="delete" value="Delete" class="remove-btn" id="${
              pizza.id
            }">
            <a href='update/${pizza.id}'>update</a>
        </div>
      </div>`;
  return html;
}
