<?php
$title = 'Post Yaratish';
require 'includes/header.php';

require 'database.php';

$id = $_GET['id'];

$statmenet = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$statmenet->execute([$id]);
$post = $statmenet->fetch();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['PUT'])){
   
    $id = $_POST['post_id'];
    $title = $_POST['title'];
    $body = $_POST['body'];

    $statmenet = $pdo->prepare("UPDATE posts SET title=:title, body=:body WHERE id=:id");
    $statmenet->execute([
        'title' => $title,
        'body' => $body,
        'id' => $id,
    ]);

    $_SESSION['success '] = 'Post muvofaqiyatli o\'zgartirildi';

    header("Location: blog.php");
    exit;
}

?>
<div class="container py-4">
    <div class="pb-3 mb-4 border-bottom">
        <h1 class="fw-light">Post O'zgartirish</h1>
    </div>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <form method="POST" action="" class="container-fluid py-5">
            <input type="hidden" name="PUT">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <h2><?= $post['id'] ?></h2>
            <div class="mb-3">
                <label class="form-label">Sarlavha</label>
                <input name="title" type="text" value="<?= $post['title']?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Matn</label>
                <textarea name="body" class="form-control" rows="3"><?= $post['body']?></textarea>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Saqlash</button>
            </div>
        </form>
    </div>
</div>


<?php require 'includes/footer.php'; ?>