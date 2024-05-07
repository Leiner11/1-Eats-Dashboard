<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Place New Order</title>
    <link rel="stylesheet" href="newOrder.css" />
  </head>
  <body>
    <div class="add-container">
      <h2>Place New Order</h2>
      <form action="../php/placeNewOrder.php" method="post">
      <label for="selectFood">Select Food:</label>
        <?php include ("../php/getProductName.php");?>
        <label for="orderFor">Order for:</label>
        <input
          type="text"
          id="orderFor"
          name="orderFor"
          placeholder="Enter customer"
          required
        />

        <label for="Price">Price: [Pesos]</label>
        <input
          type="number"
          id="Price"
          name="Price"
          placeholder="Enter the Price"
          required
        />
        <label for="Quantity">Quantity</label>
        <input
          type="number"
          id="Quantity"
          name="Quantity"
          placeholder="Enter the Quantity"
          required
        />

        <button type="submit">Place Order</button>
      </form>
    </div>
  </body>
</html>
