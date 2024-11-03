// Javascript Area 

// Start Site Settings
    const getsitesettings = document.getElementById('sitesettings');
    getsitesettings.addEventListener('click',function(){
        document.body.classList.toggle('show-nav');
    });
// End Site Settings


// Start Top Sidebar
// Start Navbar
function dropbtn(e){
    // console.log(e.target);
    e.target.parentElement.nextElementSibling.classList.toggle('show');
}
// End Top Sidebar
// End Navbar

$(document).ready(function(){

    // Start Left Side Bar 
    $('.sidebarlinks').click(function(){
        $('.sidebarlinks').removeClass('currents');
        $(this).addClass('currents');
    });
    // End Left Side Bar 
});


// Start Gauge Area

var gaugeurs = new JustGage({
    id: "gaugeusers", // the id of the html element
    value: 50,
    min: 0,
    max: 100,
    decimals: 2,
    gaugeWidthScale: 0.6
});

var gaugecus = new JustGage({
    id: "gaugecustomers", // the id of the html element
    value: 50,
    min: 0,
    max: 100,
    decimals: 2,
    gaugeWidthScale: 0.6
});

var gaugeemps = new JustGage({
    id: "gaugeemployees", // the id of the html element
    value: 50,
    min: 0,
    max: 100,
    decimals: 2,
    gaugeWidthScale: 0.6
});

var gaugeinvs = new JustGage({
    id: "gaugeinvesters", // the id of the html element
    value: 50,
    min: 0,
    max: 100,
    decimals: 2,
    gaugeWidthScale: 0.6
});
// update the value randomly
setInterval(() => {
    gaugeurs.refresh(Math.random() * 100);
    gaugecus.refresh(Math.random() * 100);
    gaugeemps.refresh(Math.random() * 100);
    gaugeinvs.refresh(Math.random() * 100);
}, 5000)

// End Gauge Area

// Start Expenses Area
const ctx = document.getElementById('mypiechart');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [12, 19, 3],
      }]
    },
    options: {
    }
  });
// End Expenses Area


// Start Earnings Overview
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Sales Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
// End Earnings Overview


// Start Footer 
const getyear = document.getElementById('getyear');
const getfullyear = new Date().getFullYear();
getyear.textContent = getfullyear;
// End Footer 

// Javascript Area 
