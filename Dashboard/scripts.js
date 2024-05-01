const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

// show sidebar
menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

// close sidebar
closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
})

// change theme
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})
//DATA FOR TOP 5 PRODUCTS CHART//
// Assuming your PHP script returns data in the following format:
// [{"name": "Chicken", "count": 9}, {"name": "Menudo", "count": 5},...]

// Fetch data from your PHP script
fetch('../php/topProduct.php')
.then(response => {
  // Clone the response to read it twice: once for JSON and once for text
  const responseClone = response.clone();
  return response.json().then(data => {
      // Process the JSON data as before
      const seriesData = data.map(item => ({
          x: item.name,
          y: item.count
      }));

      var barChartOptions = {
          series: [{
              data: seriesData
          }],
      chart: {
        type: 'bar',
        height: 350,
        toolbar: {
          show: false
        },
      },
      colors: [
        "#246dec",
        "#cc3c43",
        "#367952",
        "#f5b74f",
        "#4f35a1"
      ],
      plotOptions: {
        bar: {
          distributed: true,
          borderRadius: 4,
          horizontal: false,
          columnwidth: '40%',
        }
      },
      dataLabels: {
        enabled: false
      },
      legend: {
        show: false
      },
      xaxis: {
        categories: data.map(item => item.name),
      },
      yaxis: {
        title: {
          text: "Count"
        }
      },
    };

    var barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartOptions);
    barChart.render();
}).catch(error => {
    // Handle JSON parsing error
    console.error('Error parsing JSON from response:', error);
    return responseClone.text().then(bodyText => {
        // Log the raw response text
        console.log('Received the following instead of valid JSON:', bodyText);
    });
});
})
.catch(error => console.error('Error fetching data:', error));
// Area Chart
//Purchase and Sales Orders Data//

var AreaChartOptions = {
    series: [{
    name: 'Purchase Orders',
    data: [31, 40, 28, 51, 42, 109, 100]
  }, {
    name: 'Sales Orders',
    data: [11, 32, 45, 32, 34, 52, 41]
  }],
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
        show: false,
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: 'smooth'
  },
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
  markers: {
    size: 0
  },
  yaxis: [
    {
      title: {
        text: 'Purchase Orders',
      },
    },
    {
      opposite: true,
      title: {
        text: 'Sales Orders',
      },
    },
  ],
  tooltip: {
    shared: true,
    intersect: false,
  }
  };

  var areaChart = new ApexCharts(document.querySelector("#area-chart"), AreaChartOptions);
  areaChart.render();