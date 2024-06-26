<?php
session_start();
if (!isset($_SESSION['name'])) {
    // Redirect to the login page
    header("Location:../Login/loginPage.php");
    exit; // Ensure no code is executed after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>1-Eats 1-Skul</title>
    <!--METERIAL CDN-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">-->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
    <!--STYLESHEET-->
    <link rel="stylesheet" href="./index.css" />
    <!--SCRIPTS FOR TOTAL ACTIVE ORDERS, TOTAL COMPLETE ORDERS, AND TOTAL SALES-->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        fetch("../php/statusQuery.php")
          .then((response) => response.json())
          .then((data) => {
            document.querySelector(".left h1").textContent = data.totalOrders;
          })
          .catch((error) => console.error("Error:", error));
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        fetch("../php/totalOrders.php")
          .then((response) => response.json())
          .then((data) => {
            document.querySelector("#total-order h1").textContent =
              data.totalCompleteOrders;
          })
          .catch((error) => console.error("Error:", error));
      });
    </script>
    <script>
      function fetchTotalSales() {
        fetch("../php/totalSales.php")
          .then((response) => response.json())
          .then((data) => {
            updateTotalSalesHTML(data.total_sales);
          })
          .catch((error) =>
            console.error("Error fetching total sales:", error)
          );
      }
      function updateTotalSalesHTML(totalSales) {
        const totalSalesElement = document.getElementById("total-sales");
        const progressElement = document.getElementById("progress-percentage");

        totalSalesElement.textContent = totalSales;
        // Example progress calculation
        const progressPercentage = Math.round((totalSales / 9820) * 100);
        progressElement.textContent = `${progressPercentage}%`;
      }
      document.addEventListener("DOMContentLoaded", () => {
        fetchTotalSales();
      });
    </script>
    <!--SCRIPTS FOR TOTAL ACTIVE ORDERS, TOTAL COMPLETE ORDERS, AND TOTAL SALES-->
  </head>
  <body>
    <div class="container">
      <aside>
        <div class="top">
          <div class="logo">
            <a href="index.php">
              <img src="./images/logo.png" />
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
        <a href="../Controller-UI/controller.php">
            <span class="material-symbols-outlined">toggle_on</span>
            <h3>Prototype Controller</h3>
          </a>
          <a href="#" class="active">
            <span class="material-symbols-outlined">grid_view</span>
            <h3>Dashboard</h3>
          </a>
          <!--<a href="#">
                    <span class="material-symbols-outlined">mail_outline</span>
                    <h3>Messages</h3>
                    <span class="message-count">26</span>
                </a>-->
          <a href="orders.php">
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
          <a href="../AddFood/addfood.html">
            <span class="material-symbols-outlined">add</span>
            <h3>Manage Inventory</h3>
          </a>
          <a href="../php/logout.php">
            <span class="material-symbols-outlined">logout</span>
            <h3>Logout</h3>
          </a>
        </div>
      </aside>

      <!----- END OF ASIDE BAR ----->

      <main>
        <h1>Dashboard</h1>

        <div class="date">
          <input type="date" />
        </div>

        <div class="insights">
          <!----- START OF ACTIVE ORDERS ----->
          <div class="expenses">
            <span class="material-symbols-outlined">bar_chart</span>
            <div class="middle">
              <div class="left">
                <h3>Active Orders</h3>
                <h1>#</h1>
              </div>
              <div class="progress">
                <svg>
                  <circle cx="38" cy="38" r="36"></circle>
                </svg>
                <div class="number">
                  <p>62%</p>
                </div>
              </div>
            </div>
            <small class="text-muted">Today</small>
          </div>
          <!----- END OF ACTIVE ORDERS ----->

          <!----- START OF TOTAL NO. OF ORDERS ----->
          <div class="income">
            <span class="material-symbols-outlined">stacked_line_chart</span>
            <div class="middle">
              <div id="total-order" class="left">
                <h3>Total No. of Orders</h3>
                <h1 id="total-order">#</h1>
              </div>
              <div class="progress">
                <svg>
                  <circle cx="38" cy="38" r="36"></circle>
                </svg>
                <div class="number">
                  <p>44%</p>
                </div>
              </div>
            </div>
            <small class="text-muted">Last 24 Hours</small>
          </div>
          <!----- END OF TOTAL NO. OF ORDERS ----->

          <!----- START OF TOTAL SALES ----->
          <div class="sales">
            <span class="material-symbols-outlined">analytics</span>
            <div class="middle">
              <div class="left">
                <h3>Total Sales</h3>
                <h1 id="total-sales"></h1>
              </div>
              <div class="progress">
                <svg>
                  <circle cx="38" cy="38" r="36"></circle>
                </svg>
                <div class="number">
                  <p id="progress-percentage"></p>
                </div>
              </div>
            </div>
            <small class="text-muted">Last 24 Hours</small>
          </div>
          <!----- END OF TOTAL SALES ----->

          <!-- Other sections... -->
        </div>
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
          <?php 
          if (isset($_SESSION['name'])):?>
        <p>Good day, <b><?php echo $_SESSION['name'];?></b></p>
        <small class="text-muted">Admin</small>
          <?php else:?>
              <p>Please log in.</p>
          <?php endif;?>
</div>
            <div class="profile-photo">
              <img src="" />
            </div>
          </div>
        </div>
        <!----- END OF TOP ------>
        <div class="recent-updates">
          <h2>Recent Updates</h2>
          <div class="updates">
            <div class="update">
              <div class="profile-photo">
                <img src="" />
              </div>
              <div class="message">
                <p>
                  <b>Customer1</b> has received the order.
                </p>
                <small class="text-muted">2 minutes ago</small>
              </div>
            </div>
            <div class="update">
              <div class="profile-photo">
                <img src="" />
              </div>
              <div class="message">
                <p>
                <b>Customer2</b> has received the order.
                </p>
                <small class="text-muted">2 minutes ago</small>
              </div>
            </div>
            <div class="update">
              <div class="profile-photo">
                <img src="" />
              </div>
              <div class="message">
                <p>
                <b>Customer3</b> has received the order.
                </p>
                <small class="text-muted">2 minutes ago</small>
              </div>
            </div>
          </div>
        </div>
        <!--------------- END OF RECENT UPDATES --------------->
        <div class="sales-analytics">
          <h2>Sales Analytics</h2>
          <div class="item online">
            <div class="icon">
              <span class="material-symbols-outlined">shopping_cart </span>
            </div>
            <div class="right">
              <div class="info">
                <h3>ONLINE ORDERS</h3>
                <small class="text-muted">Last 24 Hours</small>
              </div>
              <h5 class="success">39%</h5>
              <h3>3849</h3>
            </div>
          </div>

          <div class="item offline">
            <div class="icon">
              <span class="material-symbols-outlined">local_mall </span>
            </div>
            <div class="right">
              <div class="info">
                <h3>OFFLINE ORDERS</h3>
                <small class="text-muted">Last 24 Hours</small>
              </div>
              <h5 class="danger">-17%</h5>
              <h3>1100</h3>
            </div>
          </div>

          <div class="item customers">
            <div class="icon">
              <span class="material-symbols-outlined">person </span>
            </div>
            <div class="right">
              <div class="info">
                <h3>NEW CUSTOMERS</h3>
                <small class="text-muted">Last 24 Hours</small>
              </div>
              <h5 class="success">+25%</h5>
              <h3>849</h3>
            </div>
          </div>
          <a href="../AddFood/addfood.html">
          <div class="item add-product">
            <div>
              <span class="material-symbols-outlined">add</span>
              <h3>Manage Inventory</h3>
            </div>
        </div>
        </a>
        </div>
      </div>
    </div>

    <script src="./order.js"></script>
    <script src="./index.js"></script>
  </body>
</html>
