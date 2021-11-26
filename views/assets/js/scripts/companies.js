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

}

function getRow(element) {
  row = (element.parentNode.parentNode.parentNode)
}

function infoModal(element) {
  getRow(element)
  
  

}

function editModal(element) {

}

function deleteModal(element) {
  getRow(element)
  
  document.getElementById("deleteModalTitle").innerHTML = `Deseja Deletar <b>${row.firstChild.innerText}</b>?`
  document.getElementById("deleteModalContent").innerHTML = `Clique em "Deletar" para excluir a empresa <b>${row.firstChild.innerText} - ${row.children[1].innerText}</b>`

  document.getElementById("deleteModalButton").dataset.value = element.id
  
}

document.getElementById("deleteModalButton").addEventListener("click", async (e) => {

  btn = document.getElementById("deleteModalButton")
  
  let response = await fetch(`http://localhost/matics2/api/v1/deletecompany/${await btn.dataset.value}`, {
                        method: 'DELETE',
                        body: null
  })

    if(await response.json){
      document.getElementById("grid-table").parentNode.removeChild(document.getElementById("grid-table"))
      document.getElementById("reset").innerHTML = '<div id="grid-table"></div>'
      tableGrid()
      setTimeout(function() {
      alert('success', `Empresa ${row.firstChild.innerText} excluida com sucesso.`)
      }, 440) 
    }
})
