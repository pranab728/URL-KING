(function ($) {
	"use strict";

	$(document).ready(function () {

    // Login form Script Start from here

        $("#loginform").on("submit", function (e) {
			var $this = $(this).parent();
			e.preventDefault();
			$this.find("button.submit-btn").prop("disabled", true);
			$this.find(".alert-info").show();
			$this.find(".alert-info p").html($("#authdata").val());
			$.ajax({
				method: "POST",
				url: $(this).prop("action"),
				data: new FormData(this),
				dataType: "JSON",
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {
					if (data.errors) {
						$this.find(".alert-success").hide();
						$this.find(".alert-info").hide();
						$this.find(".alert-danger").addClass("d-flex");
						$this.find(".alert-danger").show();
						$this.find(".alert-danger ul").html("");
						for (var error in data.errors) {
							$this.find(".alert-danger p").html(data.errors[error]);
						}
					} else {
						$this.find(".alert-info").hide();
						$this.find(".alert-danger").hide();
						$this.find(".alert-success").addClass("d-flex");
						$this.find(".alert-success").show();
						$this.find(".alert-success p").html("Success !");
                        
						if (data == 1) {
							
							location.reload();
						} else {
							window.location.href = data;
						}
					}
					$this.find("button.submit-btn").prop("disabled", false);
				},
			});
		});

        // Login form Script End from here


		// Register Script Start From Here
		$("#registerform").on('submit', function (e) {
			e.preventDefault();
			if(loader == 1)
		{
		$('.Loader').show();
		}
			var $this = $(this).parent();
			$this.find('button.submit-btn').prop('disabled', true);
			$this.find('.alert-info').show();
			var processdata = $this.find('.mprocessdata').val();
			$this.find('.alert-info p').html(processdata);
			$.ajax({
			  method: "POST",
			  url: $(this).prop('action'),
			  data: new FormData(this),
			  dataType: 'JSON',
			  contentType: false,
			  cache: false,
			  processData: false,
			  success: function (data) {
				if (data == 1) {
				  window.location = mainurl + '/user/dashboard';
				} else {
	  
				  if ((data.errors)) {
					$this.find('.alert-success').hide();
					$this.find('.alert-info').hide();
					$this.find('.alert-danger').show();
					$this.find('.alert-danger ul').html('');
					for (var error in data.errors) {
					  $this.find('.alert-danger p').html(data.errors[error]);
					}
					$this.find('button.submit-btn').prop('disabled', false);
				  } else {
					$this.find('.alert-info').hide();
					$this.find('.alert-danger').hide();
					$this.find('.alert-success').show();
					$this.find('.alert-success p').html(data);
					$this.find('button.submit-btn').prop('disabled', false);
					if(loader == 1)
						{
						$('.Loader').hide();
						}
				  }
				}
					window.scrollTo({top: 10, behavior: 'smooth'});
				
			  }
			});
	  
		  });


		  //**************************** USER FORM SUBMIT SECTION ****************************************

		$(document).on("submit", "#userform", function (e) {

	
			e.preventDefault();
			$(".gocover").show();
			$("button.submit-btn").prop("disabled", true);
			$.ajax({
				method: "POST",
				url: $(this).prop("action"),
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {
					if (data.errors) {
						for (var error in data.errors) {
							toastr.error(data.errors[error]);
						}
					} else {
						$("#userform")[0].reset();
						toastr.success(data);
						
					}
					$(window).scrollTop(-1);
					$(".gocover").hide();
					$("button.submit-btn").prop("disabled", false);
				},
			});
		});



		$(document).on("submit", "#short-linkk", function (e) {

			e.preventDefault();

			$.ajax({
				method: "POST",
				url: $(this).prop("action"),
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {

					if(data==3){
						toastr.error('Your Allowed URL Exceed! Renew Plan');
					}

					if(data==2){
						toastr.error('Your Subscription Validity Expired!');
					}

					if(data==1){
						window.location = mainurl + '/user/login';
					}
					else{
					if (data.errors) {
						for (var error in data.errors) {
							toastr.error(data.errors[error]);
						}
					} else {
						toastr.success(data.msg);

						$('#first-form').addClass('d-none');
						$('#second-form').removeClass('d-none');
						var link= mainurl+'/'+ data.link;
						$('#surl').val(link);


					}
				}
				},

			});
		});



		$(document).on("submit", "#user-short", function (e) {

			e.preventDefault();

			$.ajax({
				method: "POST",
				url: $(this).prop("action"),
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {

					if(data==3){
						toastr.error('Your Allowed URL Exceed! Renew Plan');
					}

					if(data==2){
						toastr.error('Your Subscription Validity Expired!');
					}

					if(data==1){
						window.location = mainurl + '/user/login';
					}
					else{
					if (data.errors) {
						for (var error in data.errors) {
							toastr.error(data.errors[error]);
						}
					} else {
						$('#user-short')[0].reset();
						$('#copyModal').modal('show');

						
						var link= data.domain+'/'+ data.link;
						$('#surl').val(link);

					}
				}
				},

			});
		});
		
		$(document).on('click','#copy',function(){
			var link=$('#surl').val();
			navigator.clipboard.writeText(link);
			toastr.success("URL Copied");
		   
		  });

		  $(document).on('click','#copy-user',function(){
			var link=$(this).data('value');
			navigator.clipboard.writeText(link);
			toastr.success("URL Copied");
		   
		  });

		    // POPUP MODAL


  // POPUP MODAL ENDS

// Currency and Language Section

$(".selectors").on('change',function () {
	var url = $(this).val();
	window.location = url;
  });

// Currency and Language Section Ends
















});
})(jQuery);