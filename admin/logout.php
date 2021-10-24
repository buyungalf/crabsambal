<?php
include "../lib/config.php";
session_start();
session_destroy();
header("location:$admin_url");
