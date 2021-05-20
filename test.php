<?php   


include "controller/permissao.php";

$hashPasswdlst = password_hash('1111', PASSWORD_DEFAULT);

print($hashPasswdlst);

?>