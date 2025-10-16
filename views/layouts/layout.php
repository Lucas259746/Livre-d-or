<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? esc($title) . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo url('/assets/css/style.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<?php
if (isset($_COOKIE['logout_message'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_COOKIE['logout_message']) . '</div>';
    setcookie('logout_message', '', time() - 3600, '/'); // Delete the cookie
}
check_and_logout_if_session_expired();
?>

<body>
    <header class="header">
        <nav class="navbar">
            <div class="nav-brand">
                <a href="<?php echo url(); ?>"><?php echo APP_NAME; ?></a>
            </div>
            <ul class="nav-menu">
                <li><a href="<?php echo url(); ?>">Accueil</a></li>
                <li><a href="<?php echo url('home/avis'); ?>">Avis</a></li>
                <?php if (is_logged_in()): ?>
                    <li><a href="<?php echo url('home/profile'); ?>">CV</a></li>
                    <li><a href="<?php echo url('home/profile'); ?>">Projet</a></li>
                    <li><a href="<?php echo url('home/contact'); ?>">Laisser un Avis</a></li>
                    <li><a href="<?php echo url('home/profile'); ?>">profile</a></li>
                    <li><a href="<?php echo url('auth/logout'); ?>">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="<?php echo url('auth/login'); ?>">Connexion</a></li>
                    <li><a href="<?php echo url('auth/register'); ?>">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <?php flash_messages(); ?>
        <?php echo $content ?? ''; ?>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. Tous droits réservés.</p>
            <p>Version <?php echo APP_VERSION; ?></p>
        </div>
    </footer>

    <script src="<?php echo url('assets/js/app.js'); ?>"></script>
</body>

</html>