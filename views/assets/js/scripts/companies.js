
    new gridjs.Grid({
     
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
                  name: 'Razão Social'
                },
                {
                  name: 'Nome Fantasia'
                },
                {
                  name: 'CNPJ'
                },
                {
                  name: "Ações",
                  sort: false
                },
  
            ],
  server: {
    url: 'http://localhost/matics2/api/v1/getcompanies',
    then: data => data.map(companies => [companies.razao_social, companies.nome_fantasia, companies.cnpj, gridjs.html(`
  <button class="btn btn-sm btn-circle btn-outline-dark" id="${companies.id_company}"><i class="fas fa-info"></i></button><button class="btn btn-sm btn-circle btn-outline-dark mx-3" id="${companies.id_company}"><i class="far fa-edit"></i></button> <button class="btn btn-sm btn-circle btn-outline-dark" id="${companies.id_company}" onclick="deleteModal(this)" data-toggle="modal" data-target="#deleteModal"><i class="far fa-trash-alt"></i></button>
`)]) 
  } 
}).render(document.getElementById("grid-table"));

function deleteModal(element) {
    let row = (element.parentNode.parentNode.parentNode)
    
    document.getElementById("deleteModalTitle").innerHTML = `Deseja Deletar <b>${row.firstChild.innerText}</b>?`
    document.getElementById("deleteModalContent").innerHTML = `Clique em "Deletar" para excluir <b>${row.firstChild.innerText} - ${row.children[1].innerText}</b>?`
    
}