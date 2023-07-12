<?php $title = "Le blog de l'AVBN"; 
$comment_identifier= filter_input(INPUT_GET,'comment_identifier');
$post_identifier= filter_input(INPUT_GET,'post_identifier');
?>

<?php ob_start(); ?>
<h1>Modifier le commentaire</h1>
<form action="../index.php?action=updateComment&comment_identifier=<?= $comment_identifier ?>&post_identifier=<?= $post_identifier?>" method="post">
    <label for="comment">Commentaire :</label>
    <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
    <button type="submit">Valider</button>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>