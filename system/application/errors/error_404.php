<html>
    <head>
        <title>Under Construction</title>
    </head>
    <body>
        <?php

        $url = "http://" . $_SERVER['HTTP_HOST'] . '/';
        $uri = split('[/]', $_SERVER["REQUEST_URI"]);
        if (strtolower($uri[2]) == 'admin' && $uri[3]=='')
            header('location:' . $url . $uri[1].'/'. $uri[2] . '/login');
        else {
            header('location:' . $url . $uri[1].'/administrations/p_404');
        }
        ?>
    </body>
</html>