<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mr-auto text-gray-800"><i class="fas fa-industry"></i></i> Empresas</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary d-inline">Tabela de Empresas</h6>
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
                    <h5 class="modal-title" id="addeModalTitle">Adicionar Nova Empresa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="addModalContent">
                <form action="<?=$this->router->route("api.addCompany")?>" method="post">
                    <div class="input-group py-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Razão Social | Nome Fantasia</span>
                        </div>
                        <input type="text" id="razao_social" name="razao_social" class="form-control">
                        <input type="text" id="nome_fantasia" name="nome_fantasia" class="form-control">
                    </div>
                    <div class="input-group py-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">CNPJ</span>
                        </div>
                        <input type="text" id="cnpj" name="cnpj" class="form-control">
                        
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="editModalContent">
                <form action="<?=$this->router->route("api.editCompany")?>" method="post">
                    <div class="input-group py-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Razão Social | Nome Fantasia</span>
                        </div>
                        <input type="text" id="edit_razao_social" name="edit_razao_social" class="form-control">
                        <input type="text" id="edit_nome_fantasia" name="edit_nome_fantasia" class="form-control">
                    </div>
                    <div class="input-group py-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">CNPJ</span>
                        </div>
                        <input type="text" id="edit_cnpj" name="edit_cnpj" class="form-control">
                        
                    </div>

                    <input type="text" id="edit_id_company" name="edit_id_company" class="d-none">
                
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-icon-split" type="button" data-dismiss="modal">
                        <span class="icon text-white-50">
                            <i class="fas fa-times"></i>
                        </span>
                        <span class="text">Cancelar</span>
                    </button>
                    <button class="btn btn-primary btn-icon-split" id="editModalButton" type="submit">
                        <span class="icon text-white-50">
                            <i class="far fa-edit"></i>
                        </span>
                        <span class="text">Editar</span>
                    </button>
                </div>
                </form>
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
        $("#edit_cnpj").mask("00.000.000/0000-00")
    })
 
</script>   

<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>            
<script src="<?=asset("/js/scripts/companies.js")?>"></script>            
