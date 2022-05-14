<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<script>
		$(document).on('click','#save',function(e){
			var data = $("#form1").serialize();
			$.ajax({
				data : data,
				type : "post",
				url : "registro.php",
				success :function(data){
					alert("guardado " +data);
				}
			});
		});
	</script>
	
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" id="form1" method="POST">
		<input type="text" id="nombre">
		<input class="form-btn" name="save" type="submit" value="Registrar" />
	</form>
</body>
</html>