<?php
setcookie("acesso[usuario]", '', time() - 7200);
setcookie("acesso[email]", '', time() -7200);
setcookie("acesso[senha])", '', time() - 7200);
setcookie("acesso[permissao]", '', time() - 7200);
setcookie("acesso[id]", '', time() - 7200);
header("Location:index.php");