(function ($) {
	"user strict";
	$("body").addClass("overflow-hidden");
	$(window).on("load", function () {
		$(".loader").fadeOut(500);
		$("body").removeClass("overflow-hidden");
		var img = $(".bg_img");
		img.css("background-image", function () {
			var bg = `url(${$(this).data("img")})`;
			return bg;
		});
	});
	$(document).ready(function () {
		$(".accordion-title").on("click", function (e) {
			var element = $(this).parent(".accordion-item");
			if (element.hasClass("open")) {
				element.removeClass("open");
				element.find(".accordion-content").removeClass("open");
				element.find(".accordion-content").slideUp(200, "swing");
			} else {
				element.addClass("open");
				element.children(".accordion-content").slideDown(200, "swing");
				element
					.siblings(".accordion-item")
					.children(".accordion-content")
					.slideUp(200, "swing");
				element.siblings(".accordion-item").removeClass("open");
				element
					.siblings(".accordion-item")
					.find(".accordion-title")
					.removeClass("open");
				element
					.siblings(".accordion-item")
					.find(".accordion-content")
					.slideUp(200, "swing");
			}
		});

		$(".counter-item").each(function () {
			$(this).isInViewport(function (e) {
				if ("entered" === e)
					for (
						var i = 0;
						i < document.querySelectorAll(".odometer").length;
						i++
					) {
						var n = document.querySelectorAll(".odometer")[i];
						n.innerHTML = n.getAttribute("data-odometer-final");
					}
			});
		});
		$("ul>li>.sub-nav").parent("li").addClass("parent-menu");
		$("ul")
			.parent("li")
			.hover(function () {
				var menu = $(this).find("ul");
				var menupos = $(menu).offset();
				if (menupos.left + menu.width() > $(window).width()) {
					var newpos = -$(menu).width();
					menu.css({
						left: newpos,
					});
				}
			});
		$(".nav-menu li a").on("click", function (e) {
			var element = $(this).parent("li");
			if (element.hasClass("open")) {
				element.removeClass("open");
				element.find("li").removeClass("open");
				element.find("ul").slideUp(300, "swing");
			} else {
				element.addClass("open");
				element.children("ul").slideDown(300, "swing");
				element.siblings("li").children("ul").slideUp(300, "swing");
				element.siblings("li").removeClass("open");
				element.siblings("li").find("li").removeClass("open");
				element.siblings("li").find("ul").slideUp(300, "swing");
			}
		});

		var scrollTop = $(".toTopBtn");
		$(window).on("scroll", function () {
			if ($(this).scrollTop() < 500) {
				scrollTop.removeClass("active");
			} else {
				scrollTop.addClass("active");
			}
		});

		$(".toTopBtn").on("click", function () {
			$("html, body").animate(
				{
					scrollTop: 0,
				},
				500
			);
			return false;
		});

		if ($(window).width() >= 992) {
			$(".nav-toggle").on("mouseenter", function () {
				$(this).toggleClass("active");
				$(".nav-menu, .dashboard-sidebar").toggleClass("active");
			});
		}
		$(".nav-toggle").on("click", function () {
			$(this).toggleClass("active");
			$(".nav-menu, .dashboard-sidebar").toggleClass("active");
		});

		$(".overlay, .menu-close, .close-crypto-sidebar").on(
			"click",
			function () {
				$(
					".nav-menu, .dashboard-sidebar, .nav-toggle, .overlay, .menu-close"
				).removeClass("active");
			}
		);

		var header = $("header");
		$(window).on("scroll", function () {
			if ($(this).scrollTop() > 0) {
				header.addClass("active");
			} else {
				header.removeClass("active");
			}
		});

		const bannerTopSpace = () => {
			var h = $("header").height();
			$(".hero-section").css("padding-top", h);
			return true;
		};

		bannerTopSpace();

		$(window).on("scroll", bannerTopSpace);
		$(window).on("resize", bannerTopSpace);

		$(".partner-slider").owlCarousel({
			items: 2,
			autoplay: true,
			margin: 14,
			responsive: {
				576: {
					items: 3,
				},
				768: {
					items: 4,
				},
				992: {
					items: 5,
				},
				1200: {
					items: 6,
				},
			},
		});

		$(".testimonial-slider").owlCarousel({
			items: 1,
			autoplay: true,
			margin: 24,
			responsive: {
				992: {
					items: 3,
				},
				768: {
					items: 2,
				},
			},
		});
		$(".owl-prev").html('<i class="fas fa-angle-left">');
		$(".owl-next").html('<i class="fas fa-angle-right">');

		// Elements Animation
		if ($(".wow").length) {
			var wow = new WOW({
				boxClass: "wow",
				animateClass: "animated",
				offset: 0,
				mobile: true,
				live: true,
			});
			wow.init();
		}
		const footerHeight = () => {
			const ctas__height = $(".ctas-wrapper").height() / 2;
			$(".ctas-wrapper").css("margin-bottom", () => {
				return ctas__height * -1;
			});
			$("footer").css("padding-top", () => {
				return ctas__height;
			});
			return true;
		};
		footerHeight();
		$(window).on("resize", footerHeight);

		$(".dashboard-refer .input--group").on("click", () => {
			var textInput = $(this).find(".form-control");
			textInput.select();
			document.execCommand("copy");
		});
		$(".dashboard-header-profile").on("click", function () {
			$(this).siblings(".user-toggle-menu").toggleClass("active");
		});

		const userPanelHeight = () => {
			$(".dashborad--content").css("min-height", () => {
				var userBreadcrumb = $(".dashboard-header").height();
				return `calc(100vh - ${userBreadcrumb}px)`;
			});
			return true;
		};

		$(window).on("resize", userPanelHeight);
		userPanelHeight();
	});


	$(document).on("submit", "#emailreply1" , function(e){
		e.preventDefault();

		var token = $(this).find('input[name=_token]').val();
		var subject = $(this).find('input[name=subject]').val();
		var message =  $(this).find('textarea[name=text]').val();

		$('#subj1').prop('disabled', true);
		$('#msg1').prop('disabled', true);
		$('#emlsub1').prop('disabled', true);
   $.ajax({
		  type: 'post',
		  url: $(this).prop("action"),
		  data: {
			  '_token': token,
			  'subject'   : subject,
			  'message'  : message
				},
		  success: function( data) {
		$('#subj1').prop('disabled', false);
		$('#msg1').prop('disabled', false);
		$('#subj1').val('');
		$('#msg1').val('');
	  $('#emlsub1').prop('disabled', false);
	  if(data == 0)
		toastr.error("Oops Something Went Wrong !");
	  else
		toastr.success("Message Sent");
	  $('.close').click();
		  }

	  });
		return false;
	  });


	  $(document).on("submit", "#messageform", function (e) {

		alert
		e.preventDefault();
		var href = $(this).data("href");
		$(".gocover").show();
		$("button.mybtn1").prop("disabled", true);
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
					toastr.success(data);
					$('.tckt.active').click();
					
					
				}
				$(".gocover").hide();
				$("button.mybtn1").prop("disabled", false);
			},
		});
	});


	//  FORM SUBMIT SECTION

    $(document).on('submit','#contactform',function(e){
		e.preventDefault();
		$('.gocover').show();
		$('button.submit-btn').prop('disabled',true);
			$.ajax({
			 method:"POST",
			 url:$(this).prop('action'),
			 data:new FormData(this),
			 contentType: false,
			 cache: false,
			 processData: false,
			 success:function(data)
			 {
				if(data==1){
					toastr.error('You have already voted');
				}
				else{

				
				if ((data.errors)) {
					toastr.error(data);
				
				  for(var error in data.errors)
				  {
					toastr.error(data.errors[error]);
				  }
				
				}
				else
				{
					toastr.success(data);
					$('#label_text').hide();
				    $('.overcontact').hide();
					
					if(isset(link)){
						window.location = link;
					}
					
					
					
  
				}
			}
				$('.gocover').hide();
				$('button.submit-btn').prop('disabled',false);
				


				
			 }
  
			});
  
	  });
	  //  FORM SUBMIT SECTION ENDS


	  $("#forgotform").on("submit", function (e) {
		e.preventDefault();
		var $this = $(this).parent();
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
					
					for (var error in data.errors) {
						$this.find(".alert-info").hide();
						toastr.error(data.errors[error]);
					}
				} else {
					$this.find(".alert-info").hide();
					toastr.success(data);
					$this.find("input[type=email]").val("");
				}
				$this.find("button.submit-btn").prop("disabled", false);
			},
		});
	});

	$(".subscribeform").on("submit", function (e) {
		var $this = $(this);
		e.preventDefault();
		$this.find("input").prop("readonly", true);
		$this.find("button").prop("disabled", true);
		$("#sub-btn").prop("disabled", true);
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
					toastr.success(data);
					$this.find("input[name=email]").val("");
				}
				$this.find("input").prop("readonly", false);
				$this.find("button").prop("disabled", false);
			},
		});
	});

	




})(jQuery);
