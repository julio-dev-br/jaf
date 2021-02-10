<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Pessoas Físicas</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo url('/dashboard'); ?>">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Lista de Pessoas Físicas</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<button type="button" class="btn btn-primary btn-sm open-popup" data-bs-toggle="modal"  data-modal-target="#add-user-system-form" data-target="<?php echo url('users-systems/add'); ?>" title="Adicionar"> <i class="icon-copy fa fa-plus" aria-hidden="true"></i> </button>
						</div>
					</div>
				</div>
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div id="del-results"></div>
					<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">ID</th>
								<th>Nome</th>
								<th>CPF</th>
								<th>Nascimento</th>
								<th>status</th>
								<th>Ações</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				JAF - Gestão Hospitalar
			</div>
		</div>
	</div>
