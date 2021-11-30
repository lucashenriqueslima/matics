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
                    name: 'Razão Social'
                },
                {
                    name: 'Nome Fantasia'
                },
                {
                    name: 'CNPJ'
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
    url: `${url}/getcredits`,
   then: data => data.map(credits => [credits.razao_social, credits.nome_fantasia, credits.cnpj, number_format(credits.value), credits.date, gridjs.html(`
 <button class="btn btn-sm btn-circle btn-outline-dark mr-1 d-inline" onclick="payedModal(this)" data-toggle="modal" data-target="#payedModal" id="${credits.id_credit_earning}"><i class="fas fa-hand-holding-usd"></i></button> <button class="btn btn-sm btn-circle btn-outline-dark ml-1 d-inline" id="${credits.id_earning_credit}" onclick="deleteModal(this)" data-toggle="modal" data-target="#deleteModal"><i class="far fa-trash-alt"></i></button>
`)]) 
  } 
}).render(document.getElementById("grid-table"));

}



function getRow(element) {
  row = (element.parentNode.parentNode.parentNode)
}


function payedModal(element) {
  getRow(element)
  
  document.getElementById("payedModalTitle").innerHTML = `Abater o crédito <b>${row.children[3].innerText} | ${row.children[4].innerText}</b>`
  document.getElementById("payedModalContent").innerHTML = `Clique em "Abater" para quitar o crédito referente a empresa <b>${row.children[0].innerText} | ${row.children[1].innerText} | ${row.children[2].innerText} </b>`
  
  document.getElementById("payedModalButton").dataset.value = element.id
  
}

function deleteModal(element) {
  getRow(element)
  
  document.getElementById("deleteModalTitle").innerHTML = `Deseja Deletar <b>${row.firstChild.innerText}</b>?`
  document.getElementById("deleteModalContent").innerHTML = `Clique em "Deletar" para excluir a empresa <b>${row.firstChild.innerText} | ${row.children[1].innerText}</b>`

  document.getElementById("deleteModalButton").dataset.value = element.id
  
}

document.getElementById("payedModalButton").addEventListener("click", async (e) => {
  
  btn = document.getElementById("payedModalButton")
  
  let response = await fetch(`${url}/payedcredit/${await btn.dataset.value}`, {
                        method: 'POST',
                        body: null
  })

    if(await response.json){
      resetTable()
      tableGrid()
      setTimeout(function() {
      alert('success', `Crédito no valor de <b>${row.children[3].innerText}</b> abatido com sucesso.`)
      }, 300) 
    }
})


document.getElementById("deleteModalButton").addEventListener("click", async (e) => {

  btn = document.getElementById("deleteModalButton")
  
  let response = await fetch(`${url}/deletecompany/${await btn.dataset.value}`, {
                        method: 'POST',
                        body: null
  })

    if(await response.json){
      resetTable()
      tableGrid()
      setTimeout(function() {
      alert('success', `Empresa <b>${row.firstChild.innerText}</b> excluida com sucesso.`)
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