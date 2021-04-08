// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart
$(document).ready(function () {
  $.ajax({
    url: "/library/dataPie.php",
    method: "GET",
    success: function (dataPie) {
      var name = [];
      var percent = [];
      dataPie = JSON.parse(dataPie)
      for (var i in dataPie) {
        name.push("" + dataPie[i].name);
        percent.push(dataPie[i].posts_count);
      }

      var chartdata = {
        labels: name,
        datasets: [
          {
            label: "Posts",
            data: percent,
            backgroundColor: ['#ffb032', '#4e73df', '#1cc88a', '#36b9cc'],
            hoverBackgroundColor: ['#ff9d00', '#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          }
        ]
      };

      var ctx = $("#myPieChart");

      var LineGraph = new Chart(ctx, {
        type: 'doughnut',
        data: chartdata,
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          legend: {
            display: false
          },
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#b8b2b2",
            titleFontColor: '#aaabb1',
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
        }
      });
    },
    error: function (dataPie) {
      console.log(dataPie);
      print("Unable to load Chat data")
    }
  });
});