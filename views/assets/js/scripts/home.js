
(async () =>{

    
    let date = new Date();

    const dategraphs = await req('getdategraph')

    let start_date = document.getElementById('start-date')
    let final_date = document.getElementById('final-date')
    
    start_date.min = await dategraphs['min_date']
    start_date.max = await dategraphs['max_date']

    final_date.min = await dategraphs['min_date']
    final_date.max = await dategraphs['max_date']
    
    filter_button = document.getElementById('filter-data-graph')
    
    createGraph(await req(`getdatagraph/${date.getFullYear()}-01-01/${date.getFullYear()}-12-31`));




    filter_button.addEventListener('click', async () =>{
      
      if(new Date(final_date.value) < new Date(start_date.value)){
        alert('error', 'Data Inicial deve ser uma data anterior a Data Final')
        return
      }
      alterFieldsDate(start_date.value, final_date.value)
      createGraph(await req(`getdatagraph/${ await document.getElementById('start-date').value}-01/${document.getElementById('final-date').value}-31`));
      $('#filterModal').modal('hide');
    })

     await [start_date, final_date].forEach(function (element) {
    element.addEventListener('change', async () => {

      if (start_date.value == '') {
        final_date.disabled = true;
        filter_button.disabled = true;
        alert('warning', 'Favor insira algum valor em Data Inicial para prosseguir com a filtragem.');
        
      }else{
        filter_button.disabled = false;
        final_date.disabled = false;
        final_date.min = start_date.value;
      }

      if (final_date.value == '') {
        filter_button.disabled = true;
        alert('warning', 'Favor insira algum valor em Data Final para prosseguir com a filtragem.');
        return;
      }


    });
  })

   /*req('getsessions').then(sessions => {
        sessionStorage.user = sessions.split(" ")[0]
        sessionStorage.sub_user = sessions.split(" ")[1]
    })*/


  function createGraph(data_graphs){

    console.log(data_graphs)
    //Reset Graph
    chart = document.getElementById("myAreaChart")
    chart.parentNode.removeChild(chart)
    document.getElementById("chart-area").innerHTML = '<canvas id="myAreaChart"></canvas>'

    chart_pie = document.getElementById('myPieChart')
    chart_pie.parentNode.removeChild(chart_pie)
    document.getElementById("chart-pie").innerHTML = '<canvas id="myPieChart"></canvas>'


    if(data_graphs[0] != undefined){
      

      let profit = []
      let credit = []
      let earning = []
      let expense = []
      let date = []
      
      var profit_total = 0
      let credit_total = 0
      let earning_total = 0
      let expense_total = 0
  
  
      for(let i = 0; i <= data_graphs.length - 1; i++){
          
        profit[i] = data_graphs[i]['earning'] - data_graphs[i]['expense']
        credit[i] = data_graphs[i]['credit']
        earning[i] = data_graphs[i]['earning']
        expense[i] = data_graphs[i]['expense']
        date[i] = date_format_sql(data_graphs[i]['date'])
  
        credit_total += parseFloat(data_graphs[i]['credit'])
        earning_total += parseFloat(data_graphs[i]['earning'])
        expense_total += parseFloat(data_graphs[i]['expense'])
        profit_total += parseFloat(profit[i])
      }
  
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    
    
    
    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: date,
        datasets: [{
          label: "Lucros",
          lineTension: 0.3,   
          backgroundColor: "rgba(78, 115, 223, 0.09)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: profit
        },{
          label: "Créditos",
          lineTension: 0.3,
          backgroundColor: "rgba(246, 194, 62, 0.2)",
          borderColor: "rgba(246, 194, 62, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(246, 194, 62, 1)",
          pointBorderColor: "rgba(246, 194, 62, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(246, 194, 62, 1)",
          pointHoverBorderColor: "rgba(246, 194, 62, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: credit
        },{
          label: "Ganhos",
          lineTension: 0.3,
          backgroundColor: "rgba(28, 200, 138, 0.1)",
          borderColor: "rgba(28, 200, 138, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(28, 200, 138, 1)",
          pointBorderColor: "rgba(28, 200, 138, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
          pointHoverBorderColor: "rgba(28, 200, 138, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: earning
        },{
          label: "Despesas",
          lineTension: 0.3,
          backgroundColor: "rgba(239, 83, 80, 0.1)",
          borderColor: "rgba(239, 83, 80, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(239, 83, 80, 1)",
          pointBorderColor: "rgba(239, 83, 80, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(239, 83, 80, 1)",
          pointHoverBorderColor: "rgba(239, 83, 80, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: expense
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 20,
            top: 0,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
    
     
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value) {
                return number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        }, 
      legend: {
        labels:{
          boxWidth: 15,
    
        }
      },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 20,
          yPadding: 25,
          intersect: false,
          
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ": " + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    });
    
  
      finance_total = credit_total + earning_total + expense_total
  
  
  
    
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Despesas", "Ganhos", "Créditos"],
        datasets: [{
          data: [parseFloat(expense_total * 100 / finance_total).toFixed(2), parseFloat(earning_total * 100 / finance_total).toFixed(2), parseFloat(credit_total * 100 / finance_total).toFixed(2)],
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
      

        let porcent = ((profit_total - expense_total)/expense_total * 100).toFixed(2)
                document.getElementById("average").innerHTML =   number_format(profit_total / data_graphs.length)
                document.getElementById("total").innerHTML = number_format(profit_total)
                document.getElementById("porcentagem").innerHTML = `${String(porcent).replace(".", ",")}%`
                document.getElementById("porcentagem_width").style.width = `${porcent < 0 ? 0 : porcent}%`

        alterFieldsColor(profit_total)
     
    }else{
  
      var desc = document.createElement('h5')
      desc.innerHTML = "Dados inexistentes para criação de gráfico."
      desc.style.textAlign = "center"
      document.getElementById("chart-area").appendChild(desc)
    
      var desc2 = document.createElement('h6')
      desc2.innerHTML = "Dados inexistentes para criação de gráfico."
      desc2.style.textAlign = "center"
    
    
      var chart_pie = document.getElementById("chart-pie")
      chart_pie.style.paddingTop = "0"
      chart_pie.appendChild(desc2)
    
      
      
    }
  
  }

  function alterFieldsDate(start_date, final_date) {
    document.getElementById("media_lucro").innerText = `MÉDIA LUCRO MENSAL - ${date_format_input(start_date)} a ${date_format_input(final_date)}`
    document.getElementById("lucro_total").innerText = `LUCRO TOTAL - ${date_format_input(start_date)} a ${date_format_input(final_date)}`
    document.getElementById("porcentagem_total").innerText = `PORCENTAGEM DE LUCRO - ${date_format_input(start_date)} a ${date_format_input(final_date)}`
    
  }

  function alterFieldsColor(profit_total) {
    if(profit_total < 0){              
      document.querySelectorAll("#total, #average, #porcentagem").forEach( (element) => {
        element.style.color = "#ef5350"
      })
      return
    }

      document.querySelectorAll("#total, #average, #porcentagem").forEach( (element) => {
        element.style.color = "#5a5c69"
      })
      
  }

  
})()