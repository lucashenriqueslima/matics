<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mr-auto text-gray-800"><i class="fas fa-industry"></i></i> Empresas</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabela de Empresas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <div id="grid-table"></div>
            
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
                    <a class="btn btn-primary" href="<?= route("/me/logoff")?>">Sair</a>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>            
<script src="<?=asset("/js/scripts/companies.js")?>"></script>            
