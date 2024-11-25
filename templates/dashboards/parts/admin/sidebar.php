<div class="sidebar col-2 p-0 bg-dark">
    <div class="offcanvas-md offcanvas-end bg-dark" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">

            <div class="container mb-5">
                <h1 class="text-white">Sign and Work</h1>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active text-white" aria-current="page" href="<?php echo $baseUrl ?>dashboards/admin/home">
                        <i class=" bi bi-house-fill"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-white" href="<?php echo $baseUrl ?>dashboards/admin/user">
                        <i class="bi bi-file-earmark"></i>
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-white" href="<?php echo $baseUrl ?>dashboards/admin/classe">
                        <i class="bi bi-cart"></i>
                        Classes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-white" href="<?php echo $baseUrl ?>dashboards/admin/matiere">
                        <i class="bi bi-people"></i>
                        Matières
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-white" href="<?php echo $baseUrl ?>dashboards/admin/cour">
                        <i class="bi bi-graph-up"></i>
                        Cours
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-white" href="<?php echo $baseUrl ?>dashboards/admin/signatures">
                        <i class="bi bi-graph-up"></i>
                        Signatures
                    </a>
                </li>
            </ul>

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-danger" href="/e5-formation/logout">
                        <i class="bi bi-door-closed"></i>
                        Sign out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>