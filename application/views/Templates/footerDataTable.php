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
<!-- js placed at the end of the document so the pages load faster -->
<script src="<?= base_url() ?>assetsAdmin/lib/jquery/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/js/jquery.js"></script>
<script src="<?= base_url() ?>assetsAdmin/lib/bootstrap/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?= base_url() ?>assetsAdmin/lib/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?= base_url() ?>assetsAdmin/lib/jquery.scrollTo.min.js"></script>
<script src="<?= base_url() ?>assetsAdmin/lib/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/js/DT_bootstrap.js"></script>
<!--common script for all pages-->
<script src="<?= base_url() ?>assetsAdmin/lib/common-scripts.js"></script>
<!--script for this page-->
<script type="text/javascript">

	$(document).ready(function () {
		var i=1;  
		$('#add').click(function(){  
			i++;             
			// $('#dynamic_field').append('<div id="row'+i+'"><div class="form-group"><div class="col-sm-8" style="margin-left:8px;"><input type="text" name="temuan[]" class="form-control" placeholder="Isi Temuan"></div><div class="col-sm-2"><button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-plus"></i></button></div></div></div>');
			$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="temuan[]" placeholder="Isi Temuan" class="form-control name_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
		});

		$('#add2').click(function(){  
			i++;             
			// $('#dynamic_field').append('<div id="row'+i+'"><div class="form-group"><div class="col-sm-8" style="margin-left:8px;"><input type="text" name="temuan[]" class="form-control" placeholder="Isi Temuan"></div><div class="col-sm-2"><button type="button" name="add" id="add" class="btn btn-primary"><i class="fa fa-plus"></i></button></div></div></div>');
			$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="rekomendasi[]" placeholder="Isi Rekomendasi" class="form-control name_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
		});
		
		$(document).on('click', '.btn_remove', function(){  
			var button_id = $(this).attr("id"); 
			var res = confirm('Are You Sure You Want To Delete This?');
			if(res==true){
			$('#row'+button_id+'').remove();  
			$('#'+button_id+'').remove();  
			}
		});
		
		/*
		 * Insert a 'details' column to the table
		 */
		var nCloneTh = document.createElement('th');
		var nCloneTd = document.createElement('td');
		// nCloneTd.innerHTML = '<img src="<?= base_url() ?>assetsAdmin/lib/advanced-datatable/images/details_open.png">';
		nCloneTd.className = "center";

		// $('#hidden-table-info thead tr').each(function () {
		// 	this.insertBefore(nCloneTh, this.childNodes[0]);
		// });

		// $('#hidden-table-info tbody tr').each(function () {
		// 	this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
		// });

		/*
		 * Initialse DataTables, with no sorting on the 'details' column
		 */
		var oTable = $('#hidden-table-info').dataTable({
			"aoColumnDefs": [{
				"bSortable": false,
				"aTargets": [0]
			}],
			"aaSorting": [
				[1, 'asc']
			]
		});

		/* Add event listener for opening and closing details
		 * Note that the indicator for showing which row is open is not controlled by DataTables,
		 * rather it is done here
		 */
		$('#hidden-table-info tbody td img').live('click', function () {
			var nTr = $(this).parents('tr')[0];
			if (oTable.fnIsOpen(nTr)) {
				/* This row is already open - close it */
				// this.src = "<?= base_url() ?>assetsAdmin/lib/advanced-datatable/media/images/details_open.png";
				oTable.fnClose(nTr);
			} else {
				/* Open this row */
				// this.src = "<?= base_url() ?>assetsAdmin/lib/advanced-datatable/images/details_close.png";
				oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
			}
		});

	});

</script>
</body>

</html>
