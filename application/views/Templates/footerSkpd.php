<!--footer start-->
<footer class="site-footer">
	<div class="text-center">
		<p>
			&copy; <?= date('Y') ?> Sistem Informasi Penyelesaian Tindak Lanjut.
		</p>
		<a href="index.html#" class="go-top">
			<i class="fa fa-angle-up"></i>
		</a>
	</div>
</footer>
<!--footer end-->
</section>

<script src="<?= base_url() ?>assetsAdmin/lib/jquery/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/js/jquery.js"></script>
<script src="<?= base_url() ?>assetsAdmin/lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?= base_url() ?>assetsAdmin/lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?= base_url() ?>assetsAdmin/lib/jquery.scrollTo.min.js"></script>
<script src="<?= base_url() ?>assetsAdmin/lib/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/js/DT_bootstrap.js"></script>

<script src="<?= base_url() ?>assetsAdmin/lib/common-scripts.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		var nCloneTh = document.createElement('th');
		var nCloneTd = document.createElement('td');
		nCloneTd.className = "center";
		var oTable = $('#hidden-table-info').dataTable({
			"aoColumnDefs": [{
				"bSortable": false,
				"aTargets": [0]
			}],
			"aaSorting": [
				[1, 'asc']
			]
		});

		$('#hidden-table-info tbody td img').live('click', function () {
			var nTr = $(this).parents('tr')[0];
			if (oTable.fnIsOpen(nTr)) {
				oTable.fnClose(nTr);
			} else {
				oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
			}
		});
	});
    
	function getLHP(tahun) {
        $("#tahun").val(tahun);
    }

</script>
</body>

</html>
