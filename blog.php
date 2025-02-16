<?php
$title = 'Blog';
require 'includes/header.php';

require 'database.php';

$statmenet = $pdo->prepare("SELECT * FROM posts");
$statmenet->execute();
$posts = $statmenet->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['DELTE'])) {

  $post_id = $_POST['post_id'];

  $statmenet = $pdo->prepare('DELETE FROM posts WHERE id = ?');
  $statmenet->execute([$post_id]);

  $_SESSION['success'] = 'Post muvofiqatli o\'chirildi';

  header("Location: blog.php");
  exit;
}


if (isset($_SESSION['success'])) {
  $message = $_SESSION['success'];
}

?>



<section class="py-5 text-center container">


  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light">Bizing Blog</h1>
      <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="/post-create.php" class="btn btn-primary my-2">Post Yaratish</a>
        <a href="/index.php" class="btn btn-secondary my-2">Bosh sahifa</a>
      </p>
    </div>
  </div>
</section>

<div class="album py-5 bg-body-tertiary">
  <div class="container">



    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success" role="alert">
        <?= $_SESSION['success'] ?>
        <?php unset($_SESSION['success']) ?>
      </div>
    <?php endif; ?>








    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

      <?php foreach ($posts as $post): ?>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>
            <div class="card-body">
              <a href="post.php?id=<?= $post['id'] ?>">
                <h5><?= $post['title'] ?></h5>
              </a>
              <p class="card-text"><?= $post['body'] ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="/post-edit.php?id=<?= $post['id']?>" class="btn btn-sm btn-outline-secondary">Edit</a>

                  <form method="POST" onSubmit="return confirm('Rosdan ham o\'chirmoqchimisiz?')">
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <input type="hidden" name="DELTE">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                  </form>
                </div>
              </div>
              <small><?= $post['created_at'] ?></small>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>




<?php require 'includes/footer.php'; ?>