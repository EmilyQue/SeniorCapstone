<div class="header">
    <h1 class="text-center">ADVENTR</h1>
    <h4 class="text-center">A COMMUNITY TRAVEL GUIDE</h4>
</div>

<nav class="navbar navbar-expand-lg navbar-light">
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
        <span>MENU</span>

    </button>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <div class="navbar-nav ml-auto">
            <?php if(session()->has('role')){
                if (session('role') == 1) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> Admin {{session()->get('username')}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="/usersAdmin" class="nav-item nav-link">Admin Users</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout">LOGOUT</a>
                    </div>
                  </li>
            <?php }
        } ?>


            <?php if(session()->has('user_id') && session()->has('role')){
                if (session('role') != 1) { ?>
                    <a href="home" class="nav-item nav-link">HOME</a>
                    <a href="/displayPosts" class="nav-item nav-link">EXPLORE</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{session()->get('username')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="displayMyPosts">MY POSTS</a>
                          <a class="dropdown-item" href="profile">PROFILE</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="logout">LOGOUT</a>
                        </div>
                      </li>
            <?php }}
                else {     ?>
                    <a href="/login" class="nav-item nav-link">Login</a>
                    <a href="/register" class="nav-item nav-link">Register</a>
                    <?php
                } ?>
                </div>
            </div>
</nav>
