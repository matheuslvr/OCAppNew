<?php

session_start();
    
    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = $user_type;
    echo "sessao comecou!";

 ?>