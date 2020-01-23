
			$(document).ready(function ()
			{
				$('#usuario').focus();
				
				$("ul#mainmenu li ul").hide();
				$("ul#mainmenu li").bind("mouseover", null, function (event){
					$("ul#mainmenu li").not($("ul", this)).stop();
					$("ul", this).slideDown("fast");
				})
			})
			
			
			
			
			
			