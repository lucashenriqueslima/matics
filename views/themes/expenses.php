<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mr-auto text-gray-800"><i class="fas fa-receipt"></i> Despesas</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary d-inline">Tabela de Despesas</h6>
        <button class="btn btn-circle btn-outline-success d-inline mr-2 float-right" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i></button> 
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="reset">
            <div id="grid-table"></div>
            </div>
    
    <!-- Modal Add -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addeModalTitle">Adicionar Nova Despesa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="addModalContent">
                <form action="<?=$this->router->route("api.addExpense")?>" method="post">
                    <div class="input-group py-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Descrição</span>
                        </div>
                        <input type="text" id="descricao" name="descricao" class="form-control">       
                    </div>

                    <div class="input-group py-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Valor</span>
                        </div>
                        <input type="text" id="valor" name="valor" class="form-control">       
                    </div>
                    <div class="input-group py-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Data</span>
                        </div>
                        <input type="text" id="data" name="data" class="form-control">       
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-icon-split" type="button" data-dismiss="modal">
                        <span class="icon text-white-50">
                            <i class="fas fa-times"></i>
                        </span>
                        <span class="text">Cancelar</span>
                    </button>
                    <button class="btn btn-success btn-icon-split" id="addModalButton" type="submit">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Adicionar</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="payedModalTitle"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="payedModalContent"></div>
                <div class="modal-footer">
                <button href="#" class="btn btn-secondary btn-icon-split" type="button" data-dismiss="modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-times"></i>
                    </span>
                    <span class="text">Cancelar</span>
                </button>
                <button class="btn btn-success btn-icon-split" id="payedModalButton" type="button" data-dismiss="modal">
                    <span class="icon text-white-50">
                    <i class="fas fa-hand-holding-usd"></i>
                    </span>
                    <span class="text">Abater</span>
                </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalTitle"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteModalContent"></div>
                <div class="modal-footer">
                <button href="#" class="btn btn-secondary btn-icon-split" type="button" data-dismiss="modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-times"></i>
                    </span>
                    <span class="text">Cancelar</span>
                </button>
                <button href="#" class="btn btn-danger btn-icon-split" id="deleteModalButton" type="button" data-dismiss="modal">
                    <span class="icon text-white-50">
                        <i class="far fa-trash-alt"></i>
                    </span>
                    <span class="text">Deletar</span>
                </button>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function(){
        $("#cnpj").mask("00.000.000/0000-00")
        $("#valor").maskMoney({prefix:'R$ -', thousands:'.', decimal:',', affixesStay: true});
        $('#data').mask("00/00/0000", {clearIfNotMatch: true});
    })
 
</script>   

<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>            
<script src="<?=asset("/js/scripts/expenses.js")?>"></script>            
