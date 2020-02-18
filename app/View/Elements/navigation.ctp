<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Geneo</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php
                if ($loggedIn == 1): ?>
                    <li class=""> <li class=""><?= $this->Html->link(
                            'Posts',
                            '/posts/index',
                            array('class' => 'button')
                        ); ?></li></li>
                    <li class=""><?= $this->Html->link(
                            'Logout',
                            '/users/logout',
                            array('class' => 'button')
                        ); ?></li>
                <?php endif ?>
                <?php if ($loggedIn == 0): ?>
                    <li class=""><?= $this->Html->link(
                            'Login',
                            '/users/login',
                            array('class' => 'button')
                        ); ?></li>
                <?php endif ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>