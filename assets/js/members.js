var save_method; //for save method string
$(document).ready(function() {
  
	
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
		$('input').removeClass('is-invalid');
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
	
});

function add()
{
	save_method = 'add';
	$('[name="id"]').val("");
    $('[name="name"]').val("");
	$('[name="address"]').val("");
	$('[name="phone"]').val("");
	$('#tambah_form').show();
}
function edit_member(id)
{
    save_method = 'update';
	$('#tambah_form').show();
    //Ajax Load data from ajax
    $.ajax({
        url :  base_url+"members/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
			$('[name="address"]').val(data.address);
			$('[name="phone"]').val(data.phone);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save()
{
	var url;
    if(save_method == 'add') {
        url = base_url+"members/ajax_add";
    }else {
        url = base_url+"members/ajax_update";
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

function delete_member(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : base_url+"members/ajax_delete/"+id,
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

/*  $(document).keypress(function(e) {
	if(e.which == 13) {
		$('#btnSave').trigger('click');
	}
});  */

function searchFilter(page_num) {
	page_num = page_num?page_num:0;
	var keywords = $('#keywords').val();
	//alert(keywords);
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'members/ajaxPaginationData/'+page_num,
		data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
		beforeSend: function () {
			$('.loading').show();
		},
		success: function (html) {
			//alert(html);
			$('#postList').html(html);
			$('.loading').fadeOut("slow");
		}
	});
}