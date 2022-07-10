<?php

use App\Services\Page;
use App\Services\Router;

if (isset($_SESSION['user'])) {
    Router::redirect('profile');
}



Page::part('header');
?>

<body>

    <?php Page::part('navbar'); ?>

    <div class="container">
        <h1 class="mt-4">Sign In</h1>
        <form class="mt-4" action="auth/login" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>