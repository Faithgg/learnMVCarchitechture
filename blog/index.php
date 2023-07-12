<?php

require_once('src/controllers/add_comment.php');
require_once('src/controllers/update_comment.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');

use Application\Controllers\AddComment\AddComment;
use Application\Controllers\UpdateComment\UpdateComment;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Post\Post;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new AddComment())->execute($identifier, $_POST);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'updateComment') {
            if (isset($_GET['post_identifier']) && $_GET['post_identifier'] > 0 && isset($_GET['comment_identifier']) && $_GET['comment_identifier'] > 0) {
                $post_identifier = $_GET['post_identifier'];
                $comment_identifier = $_GET['comment_identifier'];

                (new UpdateComment())->execute($post_identifier,$comment_identifier, $_POST);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé ou/et de commentaire envoyé');
            }
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
