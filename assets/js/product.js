var save_method; //for save method string
$(document).ready(function() {
  
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
		$('input').removeClass('is-invalid');
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
	$("textarea").change(function(){
		$('input').removeClass('is-invalid');
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
	
});

function add()
{
	save_method = 'add';
	$('#tambah_form').show();
}

function save()
{
	var formData = new FormData($('#form')[0]);
    $.ajax({
        url : base_url+"product/ajax_add",
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
					    //alert(data.error_string[i]);
						//$('input[name='+data.inputerror[i]+']').addClass('invalid');
						
						Materialize.toast(data.error_string[i], 4000);
						
						
					}
                }
			}
			
		}
	});
}

function delete_product(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : base_url+"product/ajax_delete/"+id,
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

$(document).keypress(function(e) {
	if(e.which == 13) {
		$('#form').submit();
	}
});

// function searchFilter(page_num) {
// 	page_num = page_num?page_num:0;
// 	var keywords = $('#keywords').val();
// 	//alert(keywords);
// 	var sortBy = $('#sortBy').val();
// 	$.ajax({
// 		type: 'POST',
// 		url: base_url+'product/ajaxPaginationData/'+page_num,
// 		data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
// 		beforeSend: function () {
// 			$('.loading').show();
// 		},
// 		success: function (html) {
// 			//alert(html);
// 			$('#postList').html(html);
// 			$('.loading').fadeOut("slow");
// 		}
// 	});
// }

function searchFilter(page_num) {
    //alert(1);
	page_num = page_num?page_num:0;
	var category   = $('#category_id').val();
	var product  = $('#product').val();
	
	var sortBy = $('#sortBy').val();
	$.ajax({
		type: 'POST',
		url: base_url+'product/ajaxPaginationData/'+page_num,
		data:'page='+page_num+'&category='+category+'&product='+product,
		beforeSend: function () {
			$('.loading').show();
		},
		success: function (html) {	
			$('#postList').html(html);
			$('.loading').fadeOut("slow");
		}
	});
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$('.publish_value').click(function() {
	var id = $(this).val();
	//console.log(id);
	$.ajax({
		method: 'GET',
		url :  base_url+"product/check_active/" + id,
		//data:{id:id},
		success:function(e)
		{
			var data = JSON.parse(e);
			//console.log(data);
			Materialize.toast(data.note, 2000);
		}
	});
});

$("#imgInp").change(function() {
  readURL(this);
});


// Script Search Select
document.addEventListener('DOMContentLoaded', event => {

    document.querySelectorAll('select[searchable]').forEach(elem => {
        const select = elem.M_FormSelect;
        const options = select.dropdownOptions.querySelectorAll('li:not(.optgroup)');

        // Add search box to dropdown
        const placeholderText = select.el.getAttribute('searchable');
        const searchBox = document.createElement('div');
        searchBox.style.padding = '6px 16px 0 16px';
        searchBox.innerHTML = `
            <input type="text" placeholder="${placeholderText}">
            </input>`
        select.dropdownOptions.prepend(searchBox);
        
        // Function to filter dropdown options
        function filterOptions(event) {
            const searchText = event.target.value.toLowerCase();
            
            options.forEach(option => {
                const value = option.textContent.toLowerCase();
                const display = value.indexOf(searchText) === -1 ? 'none' : 'block';
                option.style.display = display;
            });

            select.dropdown.recalculateDimensions();
        }

        // Function to give keyboard focus to the search input field
        function focusSearchBox() {
            searchBox.firstElementChild.focus({
                preventScroll: true
            });
        }

        select.dropdown.options.autoFocus = false;

        if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
            select.input.addEventListener('click', focusSearchBox);
            options.forEach(option => {
                option.addEventListener('click', focusSearchBox);
            });
        }
        searchBox.addEventListener('keyup', filterOptions);
    });
});