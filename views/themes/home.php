<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mr-auto text-gray-800"><i class="fas fa-tachometer-alt"></i> Painel de Controle</h1>
    <button id="filter-graph" class="d-sm-inline-block btn btn-sm btn-secondary shadow-sm mr-3"
        data-toggle="modal" data-target="#filterModal"><i class="fas fa-search fa-sm text-white-50"></i> Filtros
    </button>
    <button class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Gerar Relatórios </button>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" id="media_lucro">
                            Média Lucro - <?=$year?>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="average">R$ 0,00</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1" id="lucro_total">
                            Lucro Total - <?=$year?>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="total">R$ 0,00</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1" id="porcentagem_total">Porcentagem de lucro - <?=$year?>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="porcentagem">0,00%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" id="porcentagem_width" role="progressbar"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-percent fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary" id="visao_geral">Visão Geral - <?=$year?></h6>

                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">

                        <div class="dropdown-header">Visão Geral:</div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Ver mais...</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area" id="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary" id="porcent">Porcentagens Financeiras - <?=$year?>
                </h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Porcentagens Financeiras</div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Ver mais...</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pb-2" id="chart-pie" style="padding-top: 1.5rem">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-yellow"></i> Crédito
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Ganho
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Despesa
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Fitler -->

<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filtrar Por Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               
                    
                        <label for="start-date">Data Inicial:</label>
                        <div class="input-group mb-4">
                            <input id="start-date" type="month" class="form-control" name="start-date">
                        </div>
                    
                    
                        <label for="final-date">Data Final:</label>
                        <div class="input-group mb-3">
                            <input id="final-date" type="month" class="form-control" name="final-date">
                        </div>
                   
                

            </div>
            <div class="modal-footer">
                <button href="#" class="btn btn-secondary btn-icon-split" type="button" data-dismiss="modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-times"></i>
                    </span>
                    <span class="text">Cancelar</span>
                </button>
                <button class="btn btn-primary btn-icon-split" id="filter-data-graph" type="button" disabled>
                    <span class="icon text-white-50">
                        <i class="fas fa-search"></i>
                    </span>
                    <span class="text">Filtrar Dados</span>
                </button>
            </div>
        </div>
    </div>
</div>


<script src="<?= asset("/js/scripts/home.js"); ?>"></script>
