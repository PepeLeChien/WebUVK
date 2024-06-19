<?php

function conectarDb(): mysqli
{
    $db = mysqli_connect('viaduct.proxy.rlwy.net', 'root', 'zEgWoIWdoKYgJbLJrBkjJhoxHFbZDDHf', 'DBCINE', 13854);

    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
        echo "errno de depuración: " . mysqli_connect_errno();
        echo "error de depuración: " . mysqli_connect_error();
        exit;
    }

    return $db;
}