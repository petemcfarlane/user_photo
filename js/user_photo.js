$(document).ready(function() {
	
	$.ajaxSetup({
		beforeSend: function() {
			$('#ajax_loading').show();
		},
		complete: function() {
			$('#ajax_loading').hide();
		},
	});
	
	$("#upload_photo").on('change', function() {
		if (window.FormData !== undefined) {
			var file = $('#upload_photo')[0].files[0];
			var data = new FormData(document.getElementById('photoform'));
			
			$.ajax({
				url: OC.filePath('user_photo','ajax','addphoto.php'), 
				type: "POST", 
				data: data, 
				dataType: 'json',
				processData: false,
				contentType: false,
				success: function(data){
					d = new Date();
					$(".photoimg").attr("src", OC.filePath('user_photo', null, 'photo.php') + "?uid=" + data.uid + "&thumb=140&" + d.getTime() );
				}
			});
		}
	});

	
	$("#delphotobutton").click(function(e) {
		e.preventDefault();
		$.post(OC.filePath('user_photo', 'ajax', 'deletephoto.php'), function (data) {
			if (data.deleted) {
				d = new Date();
				$(".photoimg").attr("src", OC.filePath('user_photo', null, 'photo.php') + "?uid=" + data.uid + "&thumb=140&" + d.getTime() );
			}
		}, 'json');
	});

}); 