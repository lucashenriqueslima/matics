tableGrid()

function tableGrid() {
  resetTable()
    const grid = new gridjs.Grid({
     
      language: {
        search: {
          placeholder: 'Procurar...'
        },
        sort: {
          sortAsc: 'Ordenar coluna decrescentemente',
          sortDesc: 'Ordenar coluna crescentemente',
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
                  name: 'Nome'
                },
                {
                  name: 'Celular'
                },
                {
                  name: 'CPF'
                },
                {
                  name: "Ações",
                  sort: false
                },
  
            ],
  server: {
    url: `${url}/getclients`,
   then: data => data.map(clients => [clients.name, clients.cellphone, clients.cpf, gridjs.html(`
  <button class="btn btn-sm btn-circle btn-outline-dark d-inline" onclick="infoModal()"><i class="fas fa-info"></i></button><button class="btn btn-sm btn-circle btn-outline-dark mx-3 d-inline" onclick="editModal(this)" data-toggle="modal" data-target="#editModal" id="${clients.id_client}"><i class="far fa-edit"></i></button> <button class="btn btn-sm btn-circle btn-outline-dark d-inline" id="${clients.id_client}" onclick="deleteModal(this)" data-toggle="modal" data-target="#deleteModal"><i class="far fa-trash-alt"></i></button>
`)]) 
  } 
}).render(document.getElementById("grid-table"));

}



function getRow(element) {
  row = (element.parentNode.parentNode.parentNode)
}

function infoModal() {
  alert("warning", "Em Desenvolvimento.")
}

function editModal(element) {
  getRow(element)
  
  document.getElementById("editModalTitle").innerHTML = `Editar <b>${row.firstChild.innerText} | ${row.children[1].innerText}</b>`
  document.getElementById("edit_nome").value = row.firstChild.innerText
  document.getElementById("edit_celular").value = row.children[1].innerText
  document.getElementById("edit_cpf").value = row.children[2].innerText
  document.getElementById("edit_id_client").value = element.id
  
}

function deleteModal(element) {
  getRow(element)
  
  document.getElementById("deleteModalTitle").innerHTML = `Deseja Deletar <b>${row.firstChild.innerText}</b>?`
  document.getElementById("deleteModalContent").innerHTML = `Clique em "Deletar" para excluir o cliente <b>${row.firstChild.innerText} | ${row.children[1].innerText}</b>`

  document.getElementById("deleteModalButton").dataset.value = element.id
  
}

document.getElementById("deleteModalButton").addEventListener("click", async (e) => {

  btn = document.getElementById("deleteModalButton")
  console.log(`${url}/deleteclient/${await btn.dataset.value}`)
  let response = await fetch(`${url}/deleteclient/${await btn.dataset.value}`, {
                        method: 'POST',
                        body: null
  })

    if(await response.json){
      resetTable()
      tableGrid()
      setTimeout(function() {
      alert('success', `Cliente <b>${row.firstChild.innerText}</b> excluido com sucesso.`)
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