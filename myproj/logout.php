<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

session_unset();
session_destroy();

header('Location: index.php');
