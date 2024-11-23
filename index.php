<?php
$blogs = file_get_contents('blogs.json');
$blogArray = json_decode($blogs, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Travel Blogs</h1>
        <div class="row">
            <?php foreach($blogArray as $blog): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img class="card-img-top" src="uploads/<?php echo $blog['image']; ?>" alt="<?php echo $blog['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $blog['title']; ?></h5>
                            <p class="card-text"><?php echo substr($blog['content'], 0, 100); ?>...</p>
                            <p><small class="text-muted">By <?php echo $blog['author']; ?> on <?php echo $blog['date']; ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
