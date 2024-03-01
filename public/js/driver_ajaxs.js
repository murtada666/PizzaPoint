// XHR instant
var xhr = new XMLHttpRequest();

// Update Order status.
export function updateOrderStatus_driver(e) {
  // Represents the new status of the order.
  var theNewStatus = e.target.getAttribute("status");
  var orderID = e.target.id;
  var params =
    "the_new_status=" +
    encodeURIComponent(theNewStatus) +
    "&order_id=" +
    encodeURIComponent(orderID);

  var url = "http://localhost/pizzapoint/drivers/update_status";
  xhr.open("POST", url, true);

  // Needed when using POST request
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    // Check if the order is Updated successfully.
    if (this.responseText == 1) {
      // Navigate to orders page after updating the order.
      window.location.href = "http://localhost/pizzapoint/driver/index";
    }
  };
  xhr.send(params);
}
