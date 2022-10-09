<footer class="site-footer">
	<div class="text-center">
		<p>
			&copy; <?= date('Y') ?> Sistem Informasi Penyelesaian Tindak Lanjut.
		</p>
		<a href="advanced_table.html#" class="go-top">
			<i class="fa fa-angle-up"></i>
		</a>
	</div>
</footer>
<!--footer end-->
</section>

<script src="<?= base_url() ?>assetsAdmin/lib/jquery/jquery.min.js"></script>
<script type="text/javascript" language="javascript"
	src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/js/jquery.js"></script>
<script src="<?= base_url() ?>assetsAdmin/lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?= base_url() ?>assetsAdmin/lib/jquery.dcjqaccordion.2.7.js">
</script>
<script src="<?= base_url() ?>assetsAdmin/lib/jquery.scrollTo.min.js"></script>
<script src="<?= base_url() ?>assetsAdmin/lib/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript"
	src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/js/DT_bootstrap.js"></script>

<script src="<?= base_url() ?>assetsAdmin/lib/common-scripts.js"></script>

<script type="text/javascript">
	function fnFormatDetails(oTable, nTr) {
		var aData = oTable.fnGetData(nTr);
		var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
		sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
		sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
		sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
		sOut += '</table>';

		return sOut;
	}

	$(document).ready(function () {
		var nCloneTh = document.createElement('th');
		var nCloneTd = document.createElement('td');
		nCloneTd.innerHTML = '<img src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/images/details_open.png">';
		nCloneTd.className = "center";

		$('#hidden-table-info thead tr').each(function () {
			this.insertBefore(nCloneTh, this.childNodes[0]);
		});

		$('#hidden-table-info tbody tr').each(function () {
			this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
		});

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
				this.src = "<?= base_url() ?>assetsAdmin/lib/advanced-datatable/media/images/details_open.png";
				oTable.fnClose(nTr);
			} else {
				this.src = "<?= base_url() ?>assetsAdmin/lib/advanced-datatable/images/details_close.png";
				oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
			}
		});
	});

</script>
</body>

</html>
