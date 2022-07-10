<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}


use App\Services\Page;
use App\Services\Router;

Page::part('header');

if (empty($_SESSION['user'])) {
    Router::redirect('login');
}
?>

<body>

    <?php Page::part('navbar'); ?>

    <div class="container">
        <div class="jumbotron mt-4">
            <h1 class="display-4">Hello <?php echo $_SESSION['user']['full_name'] ?></h1>
            <img src="<?php echo $_SESSION['user']['avatar'] ?>" alt="avatar">
        </div>
    </div>
</body>

</html>