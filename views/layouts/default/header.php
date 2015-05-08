<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="/content/css/blog.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="/content/js/getSidebarContent.js"></script>
    <script src="/content/js/bootbox.min.js"></script>
    <script src="/content/js/attachDeleteHandler.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-custom navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a class="blog-nav-item" href="/">Home</a></li>           
                <li><a class="blog-nav-item" href="/posts">Posts</a></li>
                <?php if(!$this->isLoggedIn()):?>
                    <li><a class="blog-nav-item" href="/users/login">Login</a></li>
                    <li><a class="blog-nav-item" href="/users/register">Register</a></li>
                <?php endif;?>
                <?php if($this->isAdmin()):?>
                    <li><a class="blog-nav-item" href="/posts/create">Create Post</a></li>
                    <li><a class="blog-nav-item" href="/tags/create">Create Tag</a></li>
                    <li><a class="blog-nav-item" href="/comments">View Comments</a></li>
                    <li><a class="blog-nav-item" href="/tags">View Tags</a></li></li>
                <?php endif;?>
                <?php if($this->isLoggedIn()): ?>            
                        <li><a class="blog-nav-item" href="/users/logout">Logout</a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </nav>
    </header>
    <div class="container">
        <?php include_once('views/layouts/messages.php'); ?>
        <div class="row">
            <div class="col-sm-7 blog-main">