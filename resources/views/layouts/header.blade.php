<nav class="navbar navbar-expand-lg navbar-light">
    <a href="/home" class="navbar-brand">App Logo</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
        <div class="navbar-nav ml-auto">
            <?php if(session()->has('role')){
                if (session('role') == 1) { ?>
                <a href="/usersAdmin" class="nav-item nav-link">Admin Users</a>
                <a href="" class="nav-item nav-link">Admin {{session()->get('username')}}</a>
                <a href="/logout" class="nav-item nav-link">Logout</a>
            <?php }
        } ?>


            <?php if(session()->has('user_id') && session()->has('role')){
                if (session('role') != 1) { ?>
                    <a href="/addPost" class="nav-item nav-link">Add Post</a>
                    <a href="/userPosts" class="nav-item nav-link">My Posts</a>
                    <a href="/profile" class="nav-item nav-link">{{session()->get('username')}}'s Profile</a>
                    <a href="/logout" class="nav-item nav-link">Logout</a>
            <?php }}
                else {     ?>
                    <a href="/login" class="nav-item nav-link">Login</a>
                    <a href="/register" class="nav-item nav-link">Register</a>
              <?php
        } ?>
        </div>
    </div>
</nav>
