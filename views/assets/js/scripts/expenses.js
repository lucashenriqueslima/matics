tableGrid()

function tableGrid() {
  resetTable()
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
                    name: 'Descrição'
                },
                {
                    name: "Valor"
                },
                {
                    name: "Data"
                },
                {
                  name: "Ações",
                  sort: false
                },
  
            ],
  server: {
    url: `${url}/getexpenses`,
   then: data => data.map(expenses => [expenses.description, number_format(expenses.value), expenses.date, gridjs.html(`
 <button class="btn btn-sm btn-circle btn-outline-dark ml-1 d-inline" id="${expenses.id_expense}" onclick="deleteModal(this)" data-toggle="modal" data-target="#deleteModal"><i class="far fa-trash-alt"></i></button>
`)]) 
  } 
}).render(document.getElementById("grid-table"));

}



function getRow(element) {
  row = (element.parentNode.parentNode.parentNode)
}


function deleteModal(element) {
  getRow(element)
  
  document.getElementById("deleteModalTitle").innerHTML = `Deseja Deletar <b>${row.children[0].innerText} | ${row.children[1].innerText}</b> ?`
  document.getElementById("deleteModalContent").innerHTML = `Clique em "Deletar" para excluir a despesa <b>${row.firstChild.innerText}</b>`

  document.getElementById("deleteModalButton").dataset.value = element.id
  
}

document.getElementById("deleteModalButton").addEventListener("click", async (e) => {

  btn = document.getElementById("deleteModalButton")
  
  let response = await fetch(`${url}/deleteexpense/${await btn.dataset.value}`, {
                        method: 'POST',
                        body: null
  })

    if(await response.json){
      resetTable()
      tableGrid()
      setTimeout(function() {
      alert('success', `Despesa excluido com sucesso.`)
      }, 300) 
    }
})

function resetTable() {

  document.getElementById("grid-table").parentNode.removeChild(document.getElementById("grid-table"))
  document.getElementById("reset").innerHTML = '<div id="grid-table"></div>'

  document.querySelector('form').querySelectorAll('input').forEach((element) => {
    element.value = null
})
}
