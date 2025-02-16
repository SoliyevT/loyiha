<?php
$title = 'Post Yaratish';
require 'includes/header.php';

require 'database.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    $title = $_POST['title'];
    $body = $_POST['body'];

    $statmenet = $pdo->prepare("INSERT INTO posts (title, body) VALUES (:title, :body)");
    $statmenet->execute([
        'title' => $title,
        'body' => $body
    ]);

    $_SESSION['success'] = 'Post muvofaqiyatli yaratildi';

    header("Location: blog.php");
    exit;
}

?>
<div class="container py-4">
    <div class="pb-3 mb-4 border-bottom">
        <h1 class="fw-light">Post Yaratish</h1>
    </div>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <form method="POST" action="" class="container-fluid py-5">
            <div class="mb-3">
                <label class="form-label">Sarlavha</label>
                <input name="title" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Matn</label>
                <textarea name="body" class="form-control" rows="3"></textarea>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Saqlash</button>
            </div>
        </form>
    </div>
</div>


<?php require 'includes/footer.php'; ?>