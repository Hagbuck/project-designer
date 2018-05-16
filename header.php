<header>
        <nav id="menu">
            <ul>
                <a href="index.php"><li>Home</li></a>
                <a href="#"><li>My Projects</li></a>
                <a href="workspace.php"><li>Workspace</li></a>
            </ul>
            <ul>
              <?php
                if(isset($_SESSION['user']))
                  echo "<a href='#'><li>Profil</li></a><a href='#'><li> Log Out </li></a>";
                else
                  echo "<a href='#'><li>Login</li></a><a href='#'><li>Sign In</li></a>";
              ?>
            </ul>
        </nav>
</header>
