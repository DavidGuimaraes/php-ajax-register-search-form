<script type="text/javascript">
	function showSuggestion(str){
		if(str.length == 0){
			document.getElementById('output').innerHTML = '';
		}else{
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
  				if (this.readyState == 4 && this.status == 200) {
    				document.getElementById("output").innerHTML = this.responseText;
  				}
			}
			xhttp.open("GET", "suggest.php?q="+str, true);
			xhttp.send();
		}
	}
</script>

<?php include "header-template.php"; ?>
		<main style="max-width: 75%; margin:auto">
			<div class="container">
				<h2>Search Users</h2>
				<form>
					Search User:
					<input type="text" class="form-control" onkeyup="showSuggestion(this.value)">
				</form>
				<p>Suggestions: <span id="output" style="font-weight: bold"></span></p>
			</div>
		</main>
	</body>
</html>