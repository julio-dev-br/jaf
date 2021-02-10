<div class="right-sidebar">
    <div class="sidebar-title">
        <h3 class="weight-600 font-16 text-blue">
            Configurações de Layout
            <span class="btn-block font-weight-400 font-12">Configurações da interface do usuário</span>
        </h3>
        <div class="close-sidebar" data-toggle="right-sidebar-close">
            <i class="icon-copy ion-close-round"></i>
        </div>
    </div>
    <div class="right-sidebar-body customscroll">
        <div class="right-sidebar-body-content">
            <h4 class="weight-600 font-18 pb-10">Fundo do cabeçalho</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">Claro</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Escuro</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Fundo da barra lateral</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">Claro</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Escuro</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Ícone do menu suspenso</h4>
            <div class="sidebar-radio-group pb-10 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
                    <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
                    <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
                    <label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
                </div>
            </div>

            <h4 class="weight-600 font-18 pb-10">Ícone da lista de menus</h4>
            <div class="sidebar-radio-group pb-30 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
                    <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
                    <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
                    <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
                    <label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
                    <label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
                    <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                </div>
            </div>

            <div class="reset-options pt-30 text-center">
                <button class="btn btn-danger" id="reset-settings">Redefinir as configurações</button>
            </div>
        </div>
    </div>
</div>

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="<?php echo url('/dashboard'); ?>">
            <img src="<?php echo assets('theme/deskapp/images/logo-dark.png'); ?>" alt="" class="dark-logo">
            <img src="<?php echo assets('theme/deskapp/images/logo-white.png'); ?>" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">  
                <li>
                    <a href="<?php echo url('/dashboard'); ?>" class="dropdown-toggle no-arrow sidebar-link" id="dashboard-link">
                        <span class="micon dw dw-analytics-13"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/attendances'); ?>" class="dropdown-toggle no-arrow sidebar-link" id="attendances-link">
                        <span class="micon dw dw-calendar-2"></span><span class="mtext">Atendimentos</span>
                    </a>
                </li>	
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle sidebar-link" id="usuarios-link">
                        <span class="micon dw dw-menu"></span><span class="mtext">Cadastros</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?php echo url('/medical-insurances'); ?>" class="sidebar-link" id="medical-insurances-link">Convênio Médico</a></li>
                        <li><a href="<?php echo url('/patients'); ?>" class="sidebar-link" id="patients-link">Pacientes</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
