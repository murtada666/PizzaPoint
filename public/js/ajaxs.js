// import { showSnackbar } from "./services.js";
// const searchResID = document.getElementById("res-id");



// export function addToCart(e) {
//     if (e.target && e.target.id.startsWith("add-form")) {
//       e.preventDefault();

//       var form = e.target;

//       var pizzaID = form.getAttribute("data-product-id");
//     console.log(pizzaID);

//       var resID = searchResID.value;
//       var url = "http://localhost/pizzapoint/clients/restaurant/" + resID;
//       var params = "pizza_id=" + pizzaID;
  
//       xhr.open("POST", url, true);
  
//       xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
//       xhr.onload = function () {
//         var response = this.responseText;
  
//         // Check for duplicates and alert if exist
//         if (response.startsWith("exist")) {
//           showSnackbar("Pizza already in the cart");
//           // alert("Pizza already in the cart");
//         }
//       };
//       // console.log(params);
//       xhr.send(params);
//     }
//   }