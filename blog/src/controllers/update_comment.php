<?php

namespace Application\Controllers\UpdateComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

class UpdateComment
{
    public function execute(string $post,string $comment, array $input)
    {
        $comment_updated = null;
        if (!empty($input['comment'])) {
            $comment_updated = $input['comment'];
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->updateComment($comment, $comment_updated);
        if (!$success) {
            throw new \Exception('Impossible de modifier le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    }
}
