	<!-- js -->
	<script src="<?php echo assets('theme/deskapp/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/core.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/script.min.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/process.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/layout-settings.js'); ?>"></script>
	<!-- Datatables -->
	<script src="<?php echo assets('theme/deskapp/js/datatables/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/datatables/dataTables.responsive.min.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/datatables/responsive.bootstrap4.min.js'); ?>"></script>
	<!-- sweetalert2 -->
	<script src="<?php echo assets('theme/deskapp/js/sweetalert2/sweetalert2.all.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/sweetalert2/sweet-alert.init.js'); ?>"></script>	
	<!-- toastr -->
	<script src="<?php echo assets('theme/deskapp/js/toastr/toastr.min.js'); ?>"></script>
	<!-- custom -->
	<script src="<?php echo assets('theme/deskapp/js/custom.js'); ?>"></script>
	<!-- js functions -->
	<script src="<?php echo assets('theme/deskapp/js/datatables/datatable-setting.js'); ?>"></script>
	<script src="<?php echo assets('theme/deskapp/js/ajax.js'); ?>"></script>

	<script>
		// Ativar link sidebar
		// 1 - Obter a url corrente
		var currentUrl = window.location.href;
		// 2 - Adicionar a classe "active" na url corrente
		var segment = currentUrl.split('/').pop();
		$('#' + segment + '-link').addClass('active');
	</script>
	</body>
</html>
