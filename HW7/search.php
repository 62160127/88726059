<?php
    // connect database
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "12345678";
    $db_name = "song";

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    // check connection error 
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    } else {
        // connect success, do nothing
        // echo "Connect success.";
    }

         // select data from tables
         $kw = $_GET['kw'];
         //$kw = "1";
         //$kw = $_POST['kw'];
         $sql = "SELECT music.NameSong , artist.NameArtist , album.NameAlbum , album.ReleaseYear , music.Lylics
         FROM ((music
         INNER JOIN artist ON music.NameArtist = artist.NameArtist)
         INNER JOIN album ON music.NameAlbum = album.NameAlbum)
         WHERE NameSong LIKE '%$kw%' or artist.NameArtist LIKE '%$kw%'";
        $result = $mysqli->query($sql);
     

        $arr = array();
        if ($result->num_rows > 0){
            // Convert MySQL Result Set to PHP Array of object
            while($row = $result->fetch_object())
            {
                $arr[] = $row;
            }
        } else {
            // echo "Not found.";
        }
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);


        