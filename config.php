<?php
    $localhost_cleardb_url = "mysql://b5b1cb78e858b3:3697fa73@us-cdbr-iron-east-01.cleardb.net/heroku_3304c2e9fdb6f9b?reconnect=true";
    if(!getenv("CLEARDB_DATABASE_URL")) {
        putenv("CLEARDB_DATABASE_URL=$localhost_cleardb_url");
    }
?>