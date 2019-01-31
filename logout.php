<?php

require_once 'app/helpers.php';
start_session('boris');
session_destroy();
header('location:signin.php?sm=You logged out Sucsessfully');