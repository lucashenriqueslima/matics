if(typeof dataFinance != "undefined"){

var allData = credit_total + earning_total + expense_total; 

var creditPercent = credit_total*100 / allData
var earningPerncent = earning_total*100 / allData
var expensePercent = expense_total*100 / allData



Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Despesas", "Ganhos", "Créditos"],
    datasets: [{
      data: [parseFloat(expensePercent).toFixed(2), parseFloat(earningPerncent).toFixed(2), parseFloat(creditPercent).toFixed(2)],
      backgroundColor: ['#ef5350', '#1cc88a', '#f6c23e'],
      hoverBackgroundColor: ['#e53935', '#17a673', '#ffab00'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

let last = " - (Últimos "
            let date_count = date.length
            let month = " Meses)"

            if (date.length == 1) {
                last = " - (Último "
                date_count = " "
                month = " Mês)"
                
            }

            document.getElementById("media_lucro").innerHTML = document.getElementById("media_lucro").innerHTML + last + date_count + month
            document.getElementById("lucro_total").innerHTML = document.getElementById("lucro_total").innerHTML + last + date_count + month
            document.getElementById("visao_geral").innerHTML = document.getElementById("visao_geral").innerHTML + last + date_count + month
            document.getElementById("porcent").innerHTML = document.getElementById("porcent").innerHTML + last + date_count + month
            
            document.getElementById("total").innerHTML = number_format(profit_total)
            profit_average = profit_total / (date.length)
            document.getElementById("average").innerHTML = number_format(profit_average)

                if(profit_total < 0){
                document.getElementById("total").style.color = "#ff3333"
                document.getElementById("lucro_total").style.color = "#ff3333"
                document.getElementById("media_lucro").style.color = "#ff3333"
                document.getElementById("average").style.color = "#ff3333"


                }



}