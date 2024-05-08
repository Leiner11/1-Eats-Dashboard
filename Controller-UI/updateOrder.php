<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Order</title>
    <link rel="stylesheet" href="updateOrder.css" />

    <script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('../php/getExistingOrders.php')
   .then(response => {
        console.log("Response:", response);
        return response.json();
    })
   .then(pendingOrders => {
        console.log("Pending Orders:", pendingOrders);
        var selectElement = document.getElementById('orderSelect');
        selectElement.innerHTML = ''; // Clear the current options

        // Add a default placeholder option
        var defaultOption = document.createElement('option');
        defaultOption.value = ""; // Set a default value, e.g., an empty string
        defaultOption.text = "Select Order"; // Set the display text
        selectElement.appendChild(defaultOption); // Append the default option

        // Now add the actual order options
        pendingOrders.forEach(function(orderDetail) {
            var option = document.createElement('option');
            option.value = orderDetail.id; // Use the id as the value
            option.text = orderDetail.customer_name + ' (' + orderDetail.id + ')'; // Display the order detail as the option text
            option.setAttribute('data-order-id', orderDetail.id); // Set the data-order-id attribute to the id
            selectElement.appendChild(option);
        });

        // Set the order ID when an order is selected
        selectElement.addEventListener('change', function() {
            document.getElementById('orderId').value = this.options[this.selectedIndex].getAttribute('data-order-id');
        });
    })
   .catch(error => console.error('Error:', error));
});

</script>

  </head>
  <body>
  <div style="margin-right: 20px;"class="add-container">
      <h2 style="margin-right: 0;">This is a simulation of the User Interface for Updating a Customer Order.</h2><br>
      <h2 style="margin-right: 20px;">Once updated, the status will be reflected back to the Dashboard.</h2>
  </div>
    <div class="add-container">
      <h2>Update Order</h2>
      <form action="../php/updateOrderStatus.php" method="post">
    <input type="hidden" id="orderId" name="orderId">
    <label for="category">Mark Status As:</label>
    <select id="statusSelect" name="status" required>
        <option value="">Select Status</option>
        <option value="COMPLETED">COMPLETED</option>
        <option value="CANCELLED">CANCELLED</option>
        <option value="ACTIVE">ACTIVE</option>
    </select>

    <label for="orderSelect">Select Order:</label>
    <select id="orderSelect" name="orderSelect" required></select>

    <button type="submit">Done</button>
</form>

      <a href="../Dashboard/index.php">
        <button>Go back</button>
      </a>
    </div>
    
  </body>
</html>
