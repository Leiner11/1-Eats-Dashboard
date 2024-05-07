<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Order</title>
    <link rel="stylesheet" href="updateOrder.css" />
  </head>
  <body>
  <div style="margin-right: 20px;"class="add-container">
      <h2 style="margin-right: 0;">This is a simulation of the User Interface for Updating a Customer Order.</h2><br>
      <h2 style="margin-right: 20px;">Once updated, the status will be reflected back to the Dashboard.</h2>
  </div>
    <div class="add-container">
      <h2>Update Order</h2>
      <form action="#" method="post">
        <label for="category">Mark Status As:</label>
        <select id="category" name="category" required>
          <option value="">Select Status</option>
          <option value="breakfast">Complete</option>
          <option value="lunch">Cancelled</option>
          <option value="dinner">Active</option>
        </select>

        <label for="category">Select Order:</label>
        <select id="category" name="category" required></select>

        <button type="submit">Done</button>

      </form>
      <a href="../Dashboard/index.php">
        <button type="submit">Go back</button>
      </a>
    </div>
    
  </body>
</html>
