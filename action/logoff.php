<?php

include_once __DIR__ . '/../config/showErros.php';
include_once __DIR__ . '/../config/dbConn.php';
require_once __DIR__ . '/../database/Database.php';

session_start();
session_unset();
session_destroy();

header('Location: ../view/login.php');