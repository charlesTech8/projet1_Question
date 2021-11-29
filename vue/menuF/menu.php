<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="Center">
        <div class="logo">
            <h1>
                <a class="navbar-brand" href="../controler/index.php?pg=<?php echo md5('accueil') ?>">WE <span>CAN</span></a>
            </h1>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse Navigation" id="navbarSupportedContent">
            <ul>
                <li class="nav-item <?php if( isset($_REQUEST['pg']) && ($_REQUEST['pg'] == md5('accueil'))) echo 'active'; ?>">
                    <a href="../controler/index.php?pg=<?php echo md5('accueil') ?>">Accueil</a>
                    <span class="menu-item-bg"></span>
                </li>
                <li class="nav-item <?php if( isset($_REQUEST['pg']) && ($_REQUEST['pg'] == md5('question') || $_REQUEST['pg'] == md5('askform') || $_REQUEST['pg'] == md5('showask'))) echo 'active'; ?>">
                    <a href="../controler/index.php?pg=<?php echo md5('question') ?>">Questions</a>
                    <span class="menu-item-bg"></span>
                </li>
                <li class="nav-item <?php if(isset($_REQUEST['pg']) && ($_REQUEST['pg'] == md5('contactus'))) echo 'active'; ?>">
                    <a href="../controler/index.php?pg=<?php echo md5('contactus') ?>">Contact</a>
                    <span class="menu-item-bg"></span>
                </li>
                <li class="nav-item <?php if(isset($_REQUEST['pg']) && ($_REQUEST['pg'] == md5('connexion'))) echo 'active'; ?>">
                    <?php
                        if(isset( $_SESSION['id_user'] ) && !empty( $_SESSION['id_user'] ))
                            echo '<a style="color:red;" href="../controler/index.php?pg='.md5('deconnexion').'">Déconnexion</a>';
                        else
                            echo '<a href="../controler/index.php?pg='.md5('connexion').'">Connexion</a>';
                    ?>
                    
                    <span class="menu-item-bg"></span>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="pt-5"></div>