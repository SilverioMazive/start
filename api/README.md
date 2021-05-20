HAKELA APP
=================

* => Simbolo de envio de informacao a API via GET
~ => Simbolo que representa os EndPoints ou os dados recebidos via JSON
! => Simbolo que vai devolver os erros ou a falta de informacao resultante dos GETs enviados



-----------------*************************   REGISTRO E LOGIN   ************************************************************************************
(1) CRIAR NOVA CONTA


https://cs.musicambicano.com/dreamseeder/api/novaconta.php => Corresponde a criacao de conta como cliente
	* (1.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente']
		** O nome do cliente enviado via GET['nome']
		** O id do bairro enviado via GET['bairroid'] sendo encontrado no seguinte link: https://cs.musicambicano.com/dreamseeder/api/bairrolist.php
			
			NB: Estes id's serao listados por uma select lista ou dropdown
		** A senha do cliente enviado via GET['password']
		** A senha do cliente repetida via GET['reppassword']


	~ (1.2) Nesta sessao serao devolvidos os seguintes EndPoints
		~~ No caso de sucesso
			~~~ {"registrosucess":1,"resposta":"Registro efectuado com sucesso!"}
				~~~~ O resultado "registrosucess" indica que o cliente preencheu os dados corretamente.
				! Caso ocorra um erro neste processo
					!! {"registroerror":1,"resposta":"Registro nao realizado com sucesso!"};



-----------------*************************************************************************************************************
(2) EFECTUAR LOGIN


https://cs.musicambicano.com/dreamseeder/api/login.php => Corresponde ao processo de login do cliente
	* (2.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente']		
		** A senha do cliente enviado via GET['password']


	~ (2.2) Nesta sessao serao devolvidos os seguintes EndPoints
		~~ No caso de sucesso
			~~~ {"loginsucess":1,"resposta":"Login efectuado com sucesso!"}
				~~~~ O resultado "loginsucess" indica que o cliente preencheu os dados corretamente referentes a senha e o numero do telefone.
				! Caso ocorra um erro neste processo
					!! {"loginerror":1,"resposta":"Login nao realizado com sucesso!"};




##############################################################################################################################
-----------------*************************   PROCESSAMENTO   ************************************************************************************
(1) INDEX.PHP 

https://cs.musicambicano.com/dreamseeder/api/index.php => Corresponde ao primeiro pagamento de onde o cliente inicia a leitura do qrCode do vendedor
	* (1.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente']
		** O numero do telemovel do vendedor enviado via GET['tlvendedor'] //Sera esta informacao enviada para o pagamento direto pois o pagamento pela carrinha sera processado sem a necessidade de enviar o numero do vendedor
		** O valor referente ao pagamento enviado via GET['valor']

	~ (1.2) Nesta sessao serao devolvidos os seguintes EndPoints (Caso o usuario tenha saldo na sua conta):
		~~ No caso de sucesso
			~~~ {"vendasucess":1,"resposta":"Venda efectuada com sucesso!"}
				~~~~ O resultado "vendasucess" indica que foi retirado na carteira digital do cliente e o vendedor recebeu com sucesso.
				! Caso ocorra um erro neste processo
					!! {"falhadecobranca":1,"resposta":"Falha uma durante a cobranca!"};
		~~ No caso de falha
			! No caso de uma falha ou erro o vendedor nao ira receber a mensagem de confirmacao do MPesa mais o valor sera creditado na sua conta e vai receber o seguinte resultado:
				~~~ {"vendasucess2":0,"resposta":"O vendedor efectuou a venda com sucesso mais não recebeu a mensagem de confirmação o saldo apenas caiu na conta dele do aplicativo."};


	~ (1.3) Nesta sessao serao devolvidos os seguintes EndPoints (Caso o usuario nao tenha saldo na sua conta):
		~~ Serao repetidos todos os passos do ponto anterior (1.2) com o diferencial de que o valor sera cobrado atraves do envio de uma notificacao para o numero do MPesa do usuario.
		!! Em caso de uma falha ocorrida
			!!! {"usersaldo":1,"resposta":"O saldo foi recarregado directamente na sua conta."};
			NB: Esse e um caso em que o usuario foi cobrado na sua conta do MPesa mas nao recebeu nada entao o valor sera recarregado na sua carteira movel


	! (1.4) Caso nao tenha o numero de telefone do vendedor com conta;
		!! {"nonvendedor":1,"resposta":"Não temos registo de um vendedor com este contacto!"};
		 !!! De seguida mostrar a informacao explicando que naquele QrCode nao identificamos o numero de telefone do vendedor;


	! (1.5) Caso nao o numero de telefone do usuario com conta;
		!! {"noncliente":1,"resposta":"Este cliente não tem numero registado na plataforma!"};
		 !!! De seguida enviar ao painel de abertura de conta como cliente;


 	! (1.6) Caso nao seja enviada uma das tres informacoes (Contacto do vendedor, cliente ou o valor de pagamento);
 		!! {"payoff":1,"resposta":"Sem dados completos para processar o pagamento!"};
 			!!! Abrir a pagina do tente novamente;





-----------------*************************************************************************************************************
(2) LISTAR TODAS COMPRAS

https://cs.musicambicano.com/dreamseeder/api/compraslist.php => Nesta sessao iremos listar todas as compras realizadas com sucesso de um determinado clientee respectivamente as suas cobrancas ou vendas.
	* (2.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente'];

	~ (2.2) Nesta sessao serao devolvidos os seguintes EndPoints (Caso o usuario tenha conta activa):
		~~ No caso de sucesso
			~~~ {"valorgasto":"O valor que gastou","data":"A data da compra","tipo":"a forma de faturamento diferenciando se foi uma compra ou uma cobranca","telefonedopagamento":"O numero de telefone que pagou","nomevendedor":"O nome do vendedor / estabelecimento"};
				
		!! Caso nao tenha efectuado nenhuma compra
	 		!! {"compralist":1,"resposta":"Nenhuma informação encontrada!"}

	! (2.3) Caso nao tenha encontado o numero do telemovel do cliente na base de dados
		! {"paybad":1,"resposta":"Sem dados completos para processar a lista de recarregamentos"}






-----------------*************************************************************************************************************
(3) RECARREGAMENTO 

https://cs.musicambicano.com/dreamseeder/api/recarregamento.php => Nesta sessao iremos executar a accao de recarregamento da conta de um usuario
	* (3.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente'];
		** O valor referente ao recarregamento enviado via GET['valor']

	~ (3.2) O recarregamento feito com sucesso
		~~ {"recargsucess":1,"resposta":"Recarregamento efectuado com sucesso!}

	! (3.3) O recarregamento falhou 
		!! {"recargfail":1,"recargsucess":"Erro durante a execução! Tente novamente!"}

	~ (3.4) Receber informacao sem contacto de telefone
		~~ {"paybad":1,"resposta":"Sem dados completos para processar o recarregamentos"}




-----------------*************************************************************************************************************
(4) RECARREGAMENTO LIST

https://cs.musicambicano.com/dreamseeder/api/recarregamentolist.php => Nesta sessao iremos listar todos recarregamentos realizadas com sucesso de um determinado cliente
	* (4.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente'];

	~ (4.2) Nesta sessao serao devolvidos os seguintes EndPoints (Caso o recarregamento seja feito com sucesso)
		~~ Caso o resultado seja positivo teremos como resposta
			~~~ {"telefone":"numero de telefone","valor":"o valor que recarregou!,"data":"a data do recarregamento!"}

	! (4.3) Sem dados de recarregamento encontrados
		!! {"recarglist":1,"resposta":"Nenhuma informação encontrada!"}

	~ (4.4) DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
		~~ {"noncliente":1,"resposta":"Nenhuma informação encontrada!"}




-----------------*************************************************************************************************************
(5) LISTA DE COMPRAS

https://cs.musicambicano.com/dreamseeder/api/compraslist.php => Nesta sessao iremos listar todas compras ou pagamentos realizados com sucesso
	* (5.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente'];

	~ (5.2) Nesta sessao serao devolvidos os seguintes EndPoints (Caso encontre alguma informacao na base de dados)
		~~ Caso o resultado seja positivo teremos como resposta
			~~~ {"valorgasto":"referente ao valor usado na compra","datacompra":"data da compra","telefonedopagamento":"numero de telemovel utilizado para realizar a compra!","nomevendedor":"Apresentara o nome do vendedor!"}

	! (5.3) Sem dados de recarregamento encontrados
		!! {"compralist":1,"resposta":"Nenhuma informação encontrada!"}

	~ (5.4) DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
		~~ {"noncliente":1,"resposta":"Nenhuma informação encontrada!"}

	~ (5.5) Receber informacao sem contacto de telefone
		~~ {"paybad":1,"resposta":"Sem dados completos para processar o recarregamentos"}


-----------------*************************************************************************************************************
(6) LISTA DE VENDAS

https://cs.musicambicano.com/dreamseeder/api/vendaslist.php => Nesta sessao iremos listar todas vendas realizadas com sucesso
	* (6.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente'];

	~ (6.2) Nesta sessao serao devolvidos os seguintes EndPoints (Caso encontre alguma informacao na base de dados)
		~~ Caso o resultado seja positivo teremos como resposta
			~~~ {"valorrecebido":"referente ao valor usado na compra","datavenda":"data da venda","telefonecliente":"numero de telemovel utilizado para realizar a compra!","nomecliente":"Apresentara o nome do cliente!"}

	! (6.3) Sem dados de recarregamento encontrados
		!! {"vendalist":1,"resposta":"Nenhuma informação encontrada!"}

	~ (6.4) DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
		~~ {"noncliente":1,"resposta":"Nenhuma informação encontrada!"}

	~ (6.5) Receber informacao sem contacto de telefone
		~~ {"paybad":1,"resposta":"Sem dados completos para processar o recarregamentos"}


-----------------
*************************************************************************************************************
(7) LISTAR USUARIOS

https://cs.musicambicano.com/dreamseeder/api/usuarioslist.php => Nesta sessao iremos listar todos usuarios da plataforma
	* Aqui nao enviaremos dados apenas usaremos a url acima para ter a disposicao a lista toda de usuarios ja cadastrados na plataforma


-----------------*************************************************************************************************************
(8) LEVANTAMENTO 

https://cs.musicambicano.com/dreamseeder/api/levantamento.php => Nesta sessao iremos executar a accao de levantamento da conta de um usuario
	* (3.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente'];
		** O valor referente ao levantamento enviado via GET['valor'];

	~ (3.2) O levantamento feito com sucesso
		~~ {"recargsucess":1,"resposta":"Recarregamento efectuado com sucesso!}

	! (3.3) O levantamento falhou 
		!! {"recargfail":1,"recargsucess":"Erro durante a execução! Tente novamente!"}

	~ (3.4) Receber informacao sem contacto de telefone
		~~ {"paybad":1,"resposta":"Sem dados completos para processar o recarregamentos"}




-----------------*************************************************************************************************************
(9) LEVANTAMENTOS LIST

https://cs.musicambicano.com/dreamseeder/api/levantamentolist.php => Nesta sessao iremos listar todos recarregamentos realizadas com sucesso de um determinado cliente
	* (9.1) Nesta sessao serao enviados: 
		** O numero do telemovel do cliente enviado via GET['tlcliente'];

	~ (9.2) Nesta sessao serao devolvidos os seguintes EndPoints (Caso o recarregamento seja feito com sucesso)
		~~ Caso o resultado seja positivo teremos como resposta
			~~~ {"telefone":"numero de telefone","valor":"o valor que recarregou!,"data":"a data do recarregamento!"}

	! (9.3) Sem dados de recarregamento encontrados
		!! {"recarglist":1,"resposta":"Nenhuma informação encontrada!"}

	~ (9.4) DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
		~~ {"noncliente":1,"resposta":"Nenhuma informação encontrada!"}



-----------------*************************************************************************************************************
(10) Adicionar produto

https://cs.musicambicano.com/dreamseeder/api/prodadd.php => Nesta sessao iremos adicionar produtos
	* (10.1) Nesta sessao serao enviados: 
		** O nome do produto GET['nome'];
		** O preco do produto GET['preco'];
		** A descricao do produto GET['descricao'];
		** O id do quantificador do produto este sera o medidor que pode ser por quilogramas, unidade e molho encontrando a lista no link https://cs.musicambicano.com/dreamseeder/api/quantificadores.php via GET['quantificadorid'];
		** A quantidade do produto GET['quantidade'];
		** A datavalidade do produto que sera o numero de dias que o produto pode ficar sem perder a qualidade via GET['datavalidade'];
		** O id da categoria do produto encontrando a lista no link https://cs.musicambicano.com/dreamseeder/api/categoriaslist.php GET['categoriaid'];
		


-> Listar produtos no link: https://cs.musicambicano.com/dreamseeder/api/produtos.php


-> Remover produto enviando o GET['prodid'], GET['tlvendedor'] e o codigo GET['codigo'] que sera Dr&@mSeed3r no link: https://cs.musicambicano.com/dreamseeder/api/prodremove.php
- 


-----------------*************************************************************************************************************
(11) LISTAR produtos

https://cs.musicambicano.com/dreamseeder/api/produtos.php => Nesta sessao iremos listar todos produtos
	* (11.1) Nesta sessao serao enviados: 
		** O tipo de seguimento de produtos pois existem produtos para os vendedores dos mercados assim como existem produtos para clientes;
			*** Sera enviado GET['prodtipo']=1 para listar produtos disponiveis para os clientes e GET['prodtipo']=2 para listar produtos disponiveis para os vendedores

	~ (11.2) Nesta sessao serao devolvidos os seguintes EndPoints (Caso o recarregamento seja feito com sucesso)
		~~ Caso o resultado seja positivo teremos como resposta
			~~~ {"sucess' => 1, 'resposta' => 'Produto adicionado na carrinha!"}


	~ (11.3) DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
		~~ {"noncliente":1,"resposta":"Nenhuma informação encontrada!"}



-----------------*************************************************************************************************************
(12) Adicionar a carrinha

https://cs.musicambicano.com/dreamseeder/api/carrinha.php => Nesta sessao iremos adicionar produtos a carrinha
	* (12.1) Nesta sessao serao enviados: 
		** O numero id do produto enviado via GET['prodid'];

	~ (12.2) Nesta sessao serao devolvidos os seguintes EndPoints (Caso o recarregamento seja feito com sucesso)
		~~ Caso o resultado seja positivo teremos como resposta
			~~~ {"sucess' => 1, 'resposta' => 'Produto adicionado na carrinha!"}

	! (12.3) Sem dados de recarregamento encontrados
		!! {"'Falha' => 0, 'resposta' => 'Erro durante a execução!'"}

	~ (12.4) DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
		~~ {"noncliente":1,"resposta":"Nenhuma informação encontrada!"}



-----------------*************************************************************************************************************
(13) listar produtos da carrinha

https://cs.musicambicano.com/dreamseeder/api/carrinhalist.php => Nesta sessao iremos listar todos recarregamentos realizadas com sucesso de um determinado cliente
	* (13.1) Nesta sessao serao enviados: 
		** O numero de telefone do cliente via GET['tlcliente'];

		Sera devolvida a lista de produtos adicionados



-----------------*************************************************************************************************************
(14) REMOVER produtos da carrinha

https://cs.musicambicano.com/dreamseeder/api/carrinharemove.php => Nesta sessao iremos remover um determinado produto da carrinha 
	* (14.1) Nesta sessao serao enviados: 
		** O numero de telefone do cliente via GET['tlcliente'];
		** O codigo para remover via GET['codigo'] que sera Dr&@mSeed3r;
		** O id do produto GET['prodid'];

		Sera removido o produto
