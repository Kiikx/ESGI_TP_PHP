<section>
    <?php session_start(); ?>
    <h2>Bienvenue sur la page d'accueil</h2>
    
    <?php if (isset($_SESSION['user'])): ?>
        <p>Bonjour, <strong><?php echo htmlspecialchars($_SESSION['user']['firstname']); ?></strong> !</p>
        <a href="/se-deconnecter">Se déconnecter</a>
    <?php else: ?>
        <?php if (!empty($_GET['status']) && $_GET['status'] === 'not_logged_in'): ?>
            <p style="color: red;">Vous avez été déconnecté.</p>
        <?php endif; ?>
        <p>
            <a href="/se-connecter">Se connecter</a> ou 
            <a href="/user/add">Créer un compte</a>
        </p>
    <?php endif; ?>
</section>

