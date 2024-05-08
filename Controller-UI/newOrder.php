<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Place New Order</title>
    <link rel="stylesheet" href="newOrder.css" />
  </head>
  <script>
function calculateTotal() {
    // Get the selected food item's ID and the entered quantity
    var selectedItem = document.getElementById('category').value;
    var enteredQuantity = document.getElementById('Quantity').value;

    // Find the hidden input field for the selected product's price
    var priceInput = document.getElementById('price_' + selectedItem);

    // Get the price of the selected product
    var pricePerItem = parseFloat(priceInput.value);

    var totalPrice = pricePerItem * enteredQuantity;

    // Update the total price input field
    document.getElementById('Price').value = totalPrice.toFixed(2); // Format to 2 decimal places
}
</script>
  <body>
  <div style="margin-right: 20px;"class="add-container">
      <h2 style="margin-right: 0;">This is a simulation of the User Interface for Placing A New Order.</h2><br>
      <h2 style="margin-right: 20px;">Once placed, the order will be reflected back to the Dashboard.</h2>
  </div>
    <div style="margin-right: 20px;"class="add-container">
      <h2>This is a sample UI for Placing New Order and Updating an Order Status</h2>
            <form action="../php/placeNewOrder.php" method="post">
          <label for="selectFood">Select Food:</label>
          
          <?php include ("../php/getProductName.php");?>

          <label for="orderFor">Order for:</label>
<input
    type="text"
    id="orderFor"
    name="orderFor"
    placeholder="Enter customer name"
    required
/>

<label for="Quantity">Quantity</label>
<input
    type="number"
    id="Quantity"
    name="Quantity"
    placeholder="Enter the Quantity"
    required
    onchange="calculateTotal()" 
/> <!-- Trigger calculation on quantity change -->

<label for="Price">Price: [Pesos]</label>
<input
    type="number"
    id="Price"
    name="Price"
    placeholder="Enter the Price"
    required
    readonly
/>  <!-- Make the input field read-only -->
          <button type="submit">Place Order</button>
      </form>

      <a href="../Dashboard/index.php">
        <button type="submit">Go back</button>
        </a>
    </div>
  </body>
</html>
