<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $date = date("Y-m-d");

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    // Check if image is uploaded
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Get existing blogs from JSON file
        $blogs = file_get_contents('blogs.json');
        $blogArray = json_decode($blogs, true);

        // Add new blog to array
        $newBlog = array(
            "title" => $title,
            "author" => $author,
            "content" => $content,
            "date" => $date,
            "image" => $image
        );
        $blogArray[] = $newBlog;

        // Save updated array back to JSON file
        file_put_contents('blogs.json', json_encode($blogArray, JSON_PRETTY_PRINT));

        // Redirect to the main page
        header("Location: index.php");
        exit();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit Blog</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Submit Your Blog Post</h2>
    <form action="submit.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="author">Author:</label>
        <input type="text" name="author" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="content">Content:</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
      </div>
      <div class="form-group">
        <label for="image">Upload Image:</label>
        <input type="file" name="image" class="form-control-file" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>
