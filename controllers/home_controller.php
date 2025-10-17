<?php
// Contrôleur pour la page d'accueil

/**
 * Page d'accueil
 */
function home_index()
{
    load_view_with_layout('home/index', [
        'title'   => 'Accueil',
        'message' => 'Bienvenue sur Mon Livre D\'or !',
    ]);
}

/**
 * Page à propos
 */
function home_about()
{
    if (!is_logged_in()) {
        return redirect('auth/login');
    }
    load_view_with_layout('home/about', [
        'title'   => 'À propos',
        'content' => 'Cette application est un starter kit PHP MVC développé avec une approche procédurale.',
    ]);
}

/**
 * Page contact
 */
function home_contact()
{
    if (!is_logged_in()) {
        return redirect('auth/login');
    }
    $data = [
        'title' => 'Avis'
    ];

    if (is_post()) {

        $id = ($_SESSION['user_id']);
        $email = get_email_of_user($id);
        $messages = clean_input(post('messages'));
        // Validation simple
        if (empty($messages)) {
            set_flash('error', 'Tous les champs sont obligatoires.');
        } else {
            create_message($email, $messages);
            // Ici vous pourriez envoyer l'email ou sauvegarder en base
            set_flash('success', 'Votre message a été crée avec succès !');
            redirect('home/contact');
        }
    }

    load_view_with_layout('home/contact', $data);
}


function home_profile()
{

    if (!is_logged_in()) {
        return redirect('auth/login');
    }

    $user_id = (int)($_SESSION['user_id'] ?? 0);
    if ($user_id <= 0) {
        set_flash('error', "Session invalide. Merci de vous reconnecter.");
        return redirect('auth/login');
    }

    $user = get_user_by_id($user_id);
    if (!$user) {
        set_flash('error', "Utilisateur introuvable.");
        return redirect('auth/login');
    }

    if (is_post()) {

        $first_name = clean_input(post('first_name'));
        $last_name  = clean_input(post('last_name'));
        $email      = clean_input(post('email'));
        $password   = (string)post('password');
        if (!$first_name || !$last_name || !$email) {
            set_flash('error', "Prénom, Nom et Email sont obligatoires.");
            return redirect('home/profile');
        }
        if (!validate_email($email)) {
            set_flash('error', "Adresse email invalide.");
            return redirect('home/profile');
        }
        if (email_exists($email, $user_id)) {
            set_flash('error', "Cet email est déjà utilisé par un autre compte.");
            return redirect('home/profile');
        }

        if ($password !== '') {
            $re = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$.!%(+;)\*\/\-_{}#~$*%:!,<²°>ù^`|@\[\]*?&]).{8,}$/';
            if (!preg_match($re, $password)) {
                set_flash('error', "Mot de passe non sécurisé ! Ajoute : 8+ caractères, 1 minuscule, 1 majuscule, 1 chiffre, 1 spécial.");
                return redirect('home/profile');
            }
        }

        $ok = update_user($user_id, $first_name, $last_name, $email);
        if ($ok && $password !== '') {
            $ok = update_user_password($user_id, $password) && $ok;
        }
        if ($ok) {
            $_SESSION['user_first_name'] = $first_name;
            $_SESSION['user_last_name']  = $last_name;
            $_SESSION['user_email']      = $email;
            set_flash('success', 'Profil mis à jour avec succès.');
        } else {
            set_flash('error', "Erreur lors de la mise à jour du profil.");
        }
        return redirect('home/profile');
    }

    load_view_with_layout('home/profile', [
        'title'   => 'Profil',
        'message' => 'Bienvenue sur votre profil',
        'content' => 'Cette application est un starter kit PHP MVC développé avec une approche procédurale.',
        'user'    => $user,
    ]);
}

/**
 * Page avis
 */
function home_avis()
{
    $data = [
        'title' => 'Page avis',
        'message' => 'Bienvenue sur les avis des utilisateurs',
    ];


    load_view_with_layout('home/avis', $data);
}
function home_projet_list()
{
    $data = [
        'title' => 'CV et Projets',
        'message' => 'Bienvenue sur la page des projets',
    ];
    load_view_with_layout('home/Projet_List', $data);
}
