<?php

use App\Services\Page;
use App\Services\Router;

Page::part('header');

if ($_SESSION['user'] AND $_SESSION['user']['group'] != 2) {
    Router::redirect('profile');
}
?>

<body>

    <?php Page::part('navbar'); ?>

    <div class="container">
        <div class="jumbotron mt-4">
            <h1 class="display-4">Admin Dashboard</h1>
            
        </div>
    </div>
</body>

</html>