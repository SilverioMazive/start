<?php

    include "controller/permissao.php";

    //Pegando o novo id
    $sql2 = "SELECT * FROM questions order by question_number DESC limit 1";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $question_number = $row2['question_number'] + 1;

    $name = ''; $type = ''; $size = ''; $error = '';

    if ($_POST) 
    {

        //Pegando os dados do formulario
        $pergunta = $_POST['pergunta']; 
        $imagem = $_POST['imagem']; 
        $level = $_POST['level']; 
        $correct = $_POST['correct']; 
        $estado = 'disponivel';

        //Inserindo as informacoes na base de dados
        $number = count($_POST["name"]);
        //if($number > 1)
        if($number > 0)
        {
            for($i=0; $i<$number; $i++)
            {
                if(trim($_POST["name"][$i] != ''))
                {
                    //Aqui para fazer concidir a opcao certa com o numero do indice do textfield
                    if (($i + 1) == $_POST['correct']) 
                    {
                        $correct = '1';
                    }
                    else
                    {
                        $correct = '0';
                    }


                     $sql = "insert into choices (choice, question_number, is_correct)
                          values('".$_POST["name"][$i]."', '".$question_number."', '".$correct."')";
                      $result = mysqli_query($conn, $sql);
                      if($result)
                      {
                        //Aqui adicionar a propria pergunta
                        $sqlp = "insert into questions (question_number, question, level, image, estado, data) values ('".$question_number."', '".$pergunta."', '".$level."', '".$imagem."', '".$estado."', '".$datanow."')";
                          $resultp = mysqli_query($conn, $sqlp);
                          if($resultp)
                          {
                            $resposta = '<b>Pergunta adicionada com sucesso!</b>';
                            setcookie('info',$resposta, (time() + (10)));//1 ano
                            header('Location: addimg.php');
                          }
                          else
                          {
                            $errorMsg = 'Error '.mysqli_error($conn);
                            // setcookie('info',$errorMsg, (time() + (10)));//1 ano
                            // header('Location: addimg.php');
                          }
                      }
                      else
                      {
                        $errorMsg = 'Error '.mysqli_error($conn);
                      }
                }
            }
            
        }

        ?>
            <!-- <script type="text/javascript">window.location = "testes.php";</script> -->
        <?php

            
    }
?>

<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="addfield/bootstrap/css/bootstrap.min.css" />
        <script src="addfield/bootstrap/js/bootstrap.min.js"></script>
        <script src="addfield/jquery/jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <div class="container">

            <?php
                if($_POST)
                {
                    if ($error) 
                    {
                        ?>
                        <label class="error"><?php echo $error; ?></label>
            <?php
                    }
                }
            ?>
            
            <h2 align="center" style="color: green;">Adicionar Pergunta</h2><br />
            <div class="form-group">
                <form name="add_name" id="add_name" method="POST" action="addimgprocess.php" enctype="multipart/form-data">
                    <div class="form-group">             
                       <textarea name="pergunta" rows="4" class="form-control" placeholder="Adicionar a pergunta"></textarea>
                    </div>
                    <center>
                        <h4>Adicionar opções</h4>
                    </center>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <td><input type="text" name="name[]" placeholder="Inserir a opção" class="form-control name_list" /></td>
                                <td><button type="button" name="add" id="add" class="btn btn-success"><b style="font-size: x-large;">+</b></button></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Numero da opção correcta</label> 
                          <select name="correct" class="form-control" id="category">
                            <option value="1">1 --</option>
                            <option value="2">2 --</option>
                            <option value="3">3 --</option>
                            <option value="4">4 --</option>
                            <option value="5">5 --</option>
                            <option value="6">6 --</option>
                        </select>               
                    </div>  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nivel</label>
                        <select name="level" class="form-control" id="category">
                            <option value="0">-- 0 --</option>
                            <option value="1">-- 1 --</option>
                            <option value="2">-- 2 --</option>
                        </select>            
                    </div>  
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Imagem</label>
                        <select name="imagem" class="form-control" id="category">
                            <option value="0">--Selecionar a imagem--</option>
                            <?php
                                $sql2 = "SELECT * FROM tbartist order by data desc";
                                $result2 = mysqli_query($conn, $sql2);
                                if(mysqli_num_rows($result2)){
                                  while($row2 = mysqli_fetch_assoc($result2)){
                            ?>
                            <option value="<?php echo $row2['img'] ?>"><?php echo $row2['nome'] ?></option>
                            <?php
                                  }
                                }
                            ?>
                        </select>
                    </div>
                    
                    <input type="submit" name="submit" class="btn btn-info btn-lg" value="Confirmar" />
                    <br>
                    <br>
                </form>
            </div>
        </div>
    </body>
</html>

<script>
$(document).ready(function(){
    var i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Inserir a opção" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });
    
    $('#submit').click(function(){      
        $.ajax({
            url:"adicionarprocess.php",
            method:"POST",
            data:$('#add_name').serialize(),
            success:function(data)
            {
                alert(data);
                $('#add_name')[0].reset();
            }
        });
    });
    
});
</script>





