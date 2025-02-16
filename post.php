<?php
$title = 'Bosh sahifa';
require 'includes/header.php';
require 'database.php';

$id = $_GET['id'];

$statmenet = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$statmenet->execute([$id]);
$post = $statmenet->fetch();


?>


<div class="container mt-5">
    <h4><?= $post['id'] ?></h4>
    <h1><?= $post['title'] ?></h1>
    <p class="fs-5 col-md-8"><?= $post['body'] ?></p>
    <p><?= $post['created_at'] ?></p>

</div>




<?php require 'includes/footer.php'; ?>