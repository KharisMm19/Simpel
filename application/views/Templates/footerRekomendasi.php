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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?= base_url() ?>assetsAdmin/lib/bootstrap/js/bootstrap.min.js"></script>

<script>
	$(document).ready(function () {
        var i=1;

		$('#add2').click(function(){  
			i++;
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

		$('#skpd').change(function() {
			var id_skpd = $(this).val();
			$.ajax({
                url: "<?= base_url() ?>DataLHP/get_lhp",
				method: "POST",
				data: {
					id_skpd: id_skpd
				},
				dataType: "JSON",
				success: function(response) {
					$('#lhp').html(response);
				}
			});
		});

        $('#lhp').change(function() {
			var id_lhp = $(this).val();
			$.ajax({
                url: "<?= base_url() ?>DataLHP/get_temuan",
				method: "POST",
				data: {
					id_lhp: id_lhp
				},
				dataType: "JSON",
				success: function(response) {
					$('#temuan').html(response);
				}
			});
		});
	});

	function getLHP(judul_lhp, tahun) {
			$("#judul_lhp").val(judul_lhp);
        	$("#tahun").val(tahun);
    	}
</script>
</body>

</html>
