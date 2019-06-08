<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img class="navbar-logo" src="res/img/fav-logo.png" alt="Logo image">
        Image Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> Help</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-images"></i> Feed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-cogs"></i> Manager</a>
            </li>
        </ul>
        <form id="login_form" class="form-inline my-2 my-lg-0" role="form" action="" method="POST">
            <input id="tooltip_user" type="" data-toggle="tooltip" data-placement="bottom"
                   title="Input your username or email" class="form-control form-control-sm mr-sm-2 test"
                   name="login_name" placeholder="Email or username" required>
            <input data-toggle="tooltip" data-placement="bottom" title="Input your password"
                   class="form-control form-control-sm mr-sm-2" type="password" name="login_pw" placeholder="Password"
                   aria-label="password" required>
            <button class="btn btn-sm btn-outline-dark my-2 my-sm-0" type="submit">Login <i
                        class="fas fa-sign-in-alt"></i></button>
        </form>
    </div>
</nav>