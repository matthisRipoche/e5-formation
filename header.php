<header class="bg-dark">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo_container">
                <h2><a class="text-white" href="/e5-formation/home">Sign and Work</a></h2>
            </div>
            <div>
                <?php
                if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                    echo '<a class="text-white" href="/e5-formation/logout">logout</a>';
                } else {
                    echo '<a class="text-white" href="/e5-formation/login">login</a>';
                }
                ?>
            </div>
        </div>
    </div>
</header>