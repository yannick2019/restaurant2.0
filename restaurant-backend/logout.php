<?php

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_destroy();	    
        header("location: /restaurant2.0/restaurant-frontend/index.html");
        die();
    }