<?

    if ($full_path == 1)
    {
        require "../include/config.php";
        include "../include/database-mysql.php";
    }
    else
    {
        require "include/config.php";
        include "include/database-mysql.php";
    }

    // let's connect to database host

        db_connect();

        if (!$conn)
        {
           print "Access to database host denied, please check include/config.php file<br>";
           print "Settings are: host=$sys_dbhost, user=$sys_dbuser, dbname=$sys_dbname<br>";
           print "Error: " . db_error();
           exit;
        }
    
/*
    if (!db_select_db(DB_NAME))
    {
        print "Database doesn't exist. Please read README file.";
        exit;
        // in the future database should be created here
    }

    db_select_db (DB_NAME);
*/     
    

?>