			</div> <!-- #page -->
		</div> <!-- #main -->
	</div> <!-- #container -->
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			//Impoto la dimensione del main all'apertura della pagina
			var h = window.innerHeight-180;
			$("#main").css("height", h);

			//Recupero la posizione
			var path = location.pathname;
			//Rescupero sitename (valido solo in locale)
			var values = path.split("/");
			//Versione per il localhost
			if (values[3]) {
				$("#"+values[3]+"-main-menu").addClass("selected-item");
				$("#"+values[3]+"-menu").addClass("selected-sub");
				if (values[4]) {
					$("#"+values[4]).css("display","block");
					$("#"+values[4]).addClass("selected");
				} else {
					$("#"+values[3]+"-menu a:first-of-type").addClass("selected");
				}
			} else {
				$("#home-main-menu").addClass("selected-item");
				$("#home-menu").addClass("selected-sub");
				if (values[4]) {
					$("#"+values[4]).addClass("selected");
				} else {
					$("#home-menu a:first-of-type").addClass("selected");
				}
			}

			//Cambio la dimensione della pagina se viene ridimensionata
			$(window).resize(function() {
				var h = window.innerHeight-180;
				$("#main").css("height", h);
			});
		});
		
		function currentRefine(id) {
			alert(id);
			$(id).addClass("selected");
		}
	</script>
</body>
</html>