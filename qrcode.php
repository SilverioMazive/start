<?php  

	$qrcode = $urlsite."pay.php?id=".$userid;

?>

<!doctype html>
	<head>
		<style>
			
			input {
			    padding:5px;
			    background-color:transparent;
			    border:none;
			    border-bottom:solid 4px #8c52ff;
			    width:250px;
			    font-size:16px;
			}
			
			.qr-btn {
			    background-color:#8c52ff;
			    padding:8px;
			    color:white;
			    cursor:pointer;
			}
		</style>
		
	</head>
	<body>
		<center>
			<h3>QR Code de venda</h3>
	        <canvas id="qr-code"></canvas>
	        <br>
	        <a href="#" class="btn btn-warning">Baixar <span class="fas fa-download"></span></a>
	        <hr>
	        NB: Imprima numa folha a sua escolha e afixe num ponto visível no seu estabelecimento para que os clientes possam pagar através deste código 
	        <!-- <a href="dataURL" target="_blank" download="image.png">Mountain</a> -->
		</center>
        <script src="../qrcode/qrious.min.js"></script>
		<script>
			var qr;
			(function() {
                    qr = new QRious({
                    element: document.getElementById('qr-code'),
                    size: 200,
                    value: '<?php print($qrcode); ?>'
                });
            })();
            // var dataURL = document.getElementById('qr-code').toDataURL();
		</script>
        
	</body>
</html>