    const meses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul","Ago","Set","Out","Nov","Dez"];
    
    function number_format(number) {   
      return "R$ " + (number).toLocaleString('pt-br')
    }

    function date_format_input(date) {
      return `${meses[date.split("-")[1] - 1]}/${date.split("-")[0]}`
    }

    function  date_format_sql(date) {
      return `${meses[date.split("/")[0] - 1]}/${date.split("/")[1]}`
    }