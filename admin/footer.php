<?php


if ($_SESSION['roleId'] != 1 || !isset($_SESSION['login'])) {
    header('Location: ../');
}


?>

<footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="../">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="../">Giftyy</a>, made with love ❤❤❤
                        </p>
                    </nav>
                </div>
            </footer>