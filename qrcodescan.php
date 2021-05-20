<!DOCTYPE html>
<html>
<head>
	<title>Scanear QR Code</title>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" ></script>	
    <script src="qrcode/instascan.min.js"></script>

    <style>
    
    #preview {
        
        border: 5px #333 solid;
        width:255px;
        height:255px;
    }
    </style>
</head>
<body>

	<center>
		<video id="preview"></video>
        <hr>
        NB: Aponte a camera do celular ao Qr code de venda para efectuar o pagamento presencial
        <script>
            let scanner = new Instascan.Scanner(
                {
                    video: document.getElementById('preview'), mirror: false
                }
            );
            scanner.addListener('scan', function(content) {
                //alert('Escaneou o conteudo: ' + content);
                //window.open(content, "_blank");

                function imageOption() {
                    document.getElementById("preview").src = content;
                }

                window.location.replace(content);
            });
            Instascan.Camera.getCameras().then(cameras => 
            {
                if(cameras.length > 0){
                    scanner.start(cameras[0]);
                } else {
                    console.error("Não existe câmera no dispositivo!");
                }
            });
        </script>
	</center>

</body>
</html>