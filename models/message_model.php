<?php
// modele pour les messages

/**
 * Crée un message
 */
function create_message($email, $messages)
{
    $query = "INSERT INTO message (email, messages, created_at) VALUES (?, ?, NOW())";
    return db_execute($query, [$email, $messages]);
}
/**
 * Récupère tous les messages
 */
function fetch_all_messages()
{
    $query = "SELECT * FROM message ORDER BY created_at DESC";
    return db_select($query);
}
/**
 * Récupère un message par son utilisateur
 */
function fetch_message_by_user($email)
{
    $query = "SELECT * FROM message WHERE email = ? ORDER BY created_at DESC";
    return db_select($query, [$email]);
}
