<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog System</title>
    <link rel="stylesheet" href="/content/css/blog.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="/content/js/getSidebarContent.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper">
              <a href="/" class="brand-logo">Blog System</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="blog-nav-item" href="/">Home</a></li>           
                <li><a class="blog-nav-item" href="/posts">Posts</a></li>
                <?php if(!$this->isLoggedIn()):?>
                    <li><a class="blog-nav-item" href="/users/login">Login</a></li>
                    <li><a class="blog-nav-item" href="/users/register">Register</a></li>
                <?php endif;?>
                <?php if($this->isAdmin()):?>
                    <li><a class="blog-nav-item bold" href="/tags">Tags</a></li></li>
                    <li><a class="blog-nav-item bold" href="/comments">View Comments</a></li>
                <?php endif;?>
                <?php if($this->isLoggedIn()): ?>            
                        <li><a class="blog-nav-item bold" href="/users/logout">Logout</a></li>
                <?php endif; ?>
              </ul>
            </div>
        </nav>
    </header>
    <div class="">
        <?php include_once('views/layouts/messages.php'); ?>
        <div class="">
            <div class="">