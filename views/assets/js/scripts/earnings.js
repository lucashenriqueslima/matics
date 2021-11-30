tableGrid()

function tableGrid() {
    const grid = new gridjs.Grid({
     
      language: {
        search: {
          placeholder: 'Procurar...'
        },
        pagination: {
          previous: 'Anterior',
          next: 'Próximo',
          navigate: (page, pages) => `Página ${page} de ${pages}`,
          page: (page) => `Página ${page}`,
          showing: 'Mostrando de',
          of: 'entre',
          to: 'a',
          results: 'resultados',
        },
        loading: 'Carrregando...',
        noRecordsFound: 'Nenhum resultado encontrado',
        error: 'Erro ao conectar a base de dados',
      },

      pagination: {
        limit: 10,
        
      },
      sort: true,
    search: {
    enabled: true
    },

    style: {
      th: {
        'text-align': 'center'
      },
      td:{
        'text-align': 'center'

      }      
    },
  columns: [
                {
                    name: 'Nome Fatasia'
                },
                {
                    name: 'CNPJ'
                },
                {
                    name: 'Descrição'
                },
                {
                    name: "Valor"
                },
                {
                    name: "Data"
                },
                {
                  name: "Data Pagamento",
                  sort: false
                },
  
            ],
  server: {
    url: `${url}/getearnings`,
   then: data => data.map(earnings => [earnings.nome_fantasia, earnings.cnpj,earnings.description, number_format(earnings.value), earnings.date, earnings.date_payed]) 
  } 
}).render(document.getElementById("grid-table"));

}

tableGrid();

