<?php
session_start();
include 'core/function.php';
session_destroy();
redirect('login.php');
die;