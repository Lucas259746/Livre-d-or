<div class="hero">
    <div class="hero-content">
        <h1><?php e($message); ?></h1>
        <p class="hero-subtitle">Livre D'or</p>
        <?php if (!is_logged_in()): ?>
            <div class="hero-buttons">
                <a href="<?php echo url('auth/register'); ?>" class="btn btn-primary">Inscription</a>
                <a href="<?php echo url('auth/login'); ?>" class="btn btn-secondary">Connexion</a>
            </div>
        <?php else: ?>
            <p class="welcome-message">
                <i class="fas fa-user"></i>
                Bienvenue, <?php e($_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name']); ?> !
            </p>
        <?php endif; ?>
    </div>
</div>

<section class="getting-started">
    <div class="container">
        <h2>Accès Rappide</h2>
        <div class="steps">
            <div class="step">
                <?php if (is_logged_in()): ?>
                    <div class="step-number">1</div>
                    <h3>CV</h3>
                    <p>un lien vers ma page CV</p>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h3>PROJET</h3>
                <p>Un lien vers tout mes projet personnel et projet auquel j'ai participé</p>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h3>AVIS</h3>
                <p>Connectez vous et laisser un avis pour savoir ce que vous pensez du site</p>
            </div>
        <?php else: ?>
            <div class="step">
                <div class="step-number">3</div>
                <h3>Connexion</h3>
                <p>Connectez vous pour accèdé au contenu du site et laisser un avis pour que je puisse savoir ce que vous en pensez </p>
            </div>
        <?php endif; ?>
        </div>
    </div>
</section>
</body>
<footer>
</footer>

</html>