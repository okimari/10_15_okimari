<?php
session_start();

$_SESSION['num'] += 1;

echo $_SESSION['num'];
