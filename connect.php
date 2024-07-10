<?php
define("DB_HOST", "localhost");
define("DB_NAME", "test_task");
define("DB_USER", "root");
define("DB_PASS", "");

return mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
