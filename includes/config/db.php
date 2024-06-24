<?php

function conectarDb(): mysqli
{
    $db = mysqli_connect('monorail.proxy.rlwy.net', 'root', 'gLiViqcicZjbKSsXiJTkXyuhwkHlxNXk', 'DbCine', 58970);

    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
        echo "errno de depuración: " . mysqli_connect_errno();
        echo "error de depuración: " . mysqli_connect_error();
        exit;
    }

    return $db;
}

