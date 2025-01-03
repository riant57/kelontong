	function searchFilter(page_num) {
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();	
		var sortBy = $('#sortBy').val();
		$.ajax({
			type: 'POST',
			url: base_url+'material/ajaxPaginationData/'+page_num,
			data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
			beforeSend: function () {
				$('.loading').show();
			},
			success: function (html) {	
				$('#postList').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}

	function add()
	{
		//alert(1);
		save_method = 'add';
		$('#tambah_form').show();
	}


	function save()
	{
		
		//alert(1);
		
		var url;
		if(save_method == 'add') {
			url = base_url+"material/ajax_add";
		}else {
			url = base_url+"material/ajax_update";
		}
		var formData = new FormData($('#form')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) 
				{
					$('#form')[0].reset();
					Materialize.toast('Data berhasil disimpan', 2000);
					searchFilter(0);
					$('#tambah_form').hide();
				}else{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
						if(data.error_string[i] !== ""){
							$('input[name='+data.inputerror[i]+']').addClass('invalid');
						}
					}
				}
				
			}
		});
	}
	function delete_material(id)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			$.ajax({
				url : base_url+"material/ajax_delete/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Materialize.toast('Data berhasil dihapus', 2000);
					searchFilter(0);
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}