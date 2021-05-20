<?php

include_once "controller/permissao.php";

?>

<li class="nav-item dropdown no-arrow mx-1">
  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-bell fa-fw"></i>
      <span class="badge badge-danger badge-counter">13+</span>
    </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
      aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
        Interesses  
      </h6>
      <?php  

        $estado = 'indefinido';
        $instid = $_SESSION['instid'];
        $sql2 = "SELECT tbusuario.nome, tbgostos.data, tbpublicacoes.titulo FROM (tbgostos INNER JOIN tbusuario ON tbusuario.id=tbgostos.usuarioid)
        INNER JOIN tbpublicacoes ON tbpublicacoes.pubid=tbgostos.pubid
         WHERE tbpublicacoes.instid=".$instid;
        $result2 = mysqli_query($conn, $sql2);
        if(mysqli_num_rows($result2)){
          while($row2 = mysqli_fetch_assoc($result2)){

            $nome = $row2['nome'];
            $data2 = $row2['data'];
            $titulo = $row2['titulo'];

      ?>
      <a class="dropdown-item d-flex align-items-center" href="#">
        <div class="mr-3">
          <div class="icon-circle bg-primary">
            <i class="fas fa-file-alt text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500"><?php print($data2); ?></div>
          <span class="font-weight-bold"><?php print($nome); ?> - <?php print($titulo); ?></span>
        </div>
      </a>
      <?php  
          }
        }
      ?>
      <a class="dropdown-item text-center small text-gray-500" href="todosinterresses.php">Monstrar todos interessados</a>
    </div>
  </li>
  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-envelope fa-fw"></i>
      <span class="badge badge-warning badge-counter">45</span>
    </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
      aria-labelledby="messagesDropdown">
      <h6 class="dropdown-header">
        Mensagens Privadas
      </h6>
      <?php

          $estado = 'indefinido';
          $instid = $_SESSION['instid'];
          $sql = "SELECT * FROM tbsms where estado='$estado' AND leituraadmin!='lido' AND instid='$instid' ORDER BY smsid DESC LIMIT 2";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result)){
            while($row = mysqli_fetch_assoc($result)){
              $smsid = $row['smsid'];
              $mensagem = $row['mensagem'];
              $data = $row['data'];

      ?>
      <a class="dropdown-item d-flex align-items-center" href="mensagem.php?smsid=<?php print($smsid) ?>">
        <div class="dropdown-list-image mr-3">
          <img class="rounded-circle" src="img/man.png" style="max-width: 60px" alt="">
          <div class="status-indicator bg-success"></div>
        </div>
        <div class="font-weight-bold">
          <div class="text-truncate"><?php print($mensagem); ?></div>
          <div class="small text-gray-500"><?php print($data); ?></div>
        </div>
      </a>
      <?php

          }
        }

      ?>
      <a class="dropdown-item text-center small text-gray-500" href="todasmensagens.php">Todas Mensagens</a>

    </div>
  </li>
  <div class="topbar-divider d-none d-sm-block"></div>
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
      <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $acronimo ?></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="alterarsenha.php">
        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
        Alterar Senha
      </a>
      <div class="dropdown-divider"></div>
      <!-- <a class="dropdown-item" href="logout.php">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Sair
      </a> -->
      <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Sair
      </a>
    </div>
</li>