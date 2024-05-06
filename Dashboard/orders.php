<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1-Eats 1-Skul</title>
    <!--METERIAL CDN-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!--STYLESHEET-->
    <link rel="stylesheet" href="./index.css">
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <a href="index.php">
                        <img src="./images/logo.png">
                    </a>
                    <a href="index.php">
                        <h2>1EATS<span class="danger"> 1SKUL</span></h2>
                    </a>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>

            <div class="sidebar">
                <a href="index.php">
                    <span class="material-symbols-outlined">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <!--<a href="#">
                    <span class="material-symbols-outlined">mail_outline</span>
                    <h3>Messages</h3>
                    <span class="message-count">26</span>
                </a>-->
                <a href="#" class="active">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <h3>Orders</h3>
                </a>
                <a href="analytics.html">
                    <span class="material-symbols-outlined">insights</span>
                    <h3>Analytics</h3>
                </a>
                <a href="inventory.html">
                    <span class="material-symbols-outlined">inventory</span>
                    <h3>Inventory</h3>
                </a>
                <!--<a href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <h3>Settings</h3>
                </a>-->
                <a href="#">
                    <span class="material-symbols-outlined">add</span>
                    <h3>Manage Inventory</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <!----- END OF ASIDE BAR ----->

        <main>
            <h1>Orders</h1>

            <!--------------- END OF INSIGHTS --------------->

            <div class="recent-orders">
                <h2>Recent Orders</h2>
                <table>
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Customer Name</th>
                      <th>Order Date</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include("../php/Config.php");
                    include("../php/recentOrders.php");
                    ?>
                  </tbody>
                </table>
              </div>
        </main>
        <!------------------- END OF MAIN --------------------->

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-outlined active">light_mode</span>
                    <span class="material-symbols-outlined">dark_mode</span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Good day, <b>User</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./images/profile-1.jpg">
                    </div>
                </div>
            </div>
            <!----- END OF TOP ------>
            

    <script src="./order.js"></script>
    <script src="./index.js"></script>
</body>
</html>