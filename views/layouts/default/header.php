<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/content/styles.css" />
    <title><?php echo htmlspecialchars($this->title) ?></title>
</head>

<body>
    <header>
        <a href="/"><img src="/content/images/banner-gallery.jpg"></a>
        <ul class="menu">
            <li><a href="/">Home</a></li>
            <li><a href="/albums">Albums</a></li>
            <li><a href="/photos">Photos</a></li>

            <?php 
                if($this->isAdmin()){
                    echo '<li style="margin-left:50px;"><a href="/admin/categories">Admin Categories</a></li>';
                    echo '<li><a href="/admin/albums">Admin Albums</a></li>';
                    echo '<li><a href="/admin/photos">Admin Photos</a></li>';
                    echo '<li><a href="/admin/comments">Admin Comments</a></li>';
                    echo '<li><a href="/admin/users">Admin Users</a></li>';
                } 

                if($this->isLoggedIn()) {
                    echo '<li style="float:right;margin-right:60px;"><a href="/account/logout">Logout</a></li>';
                    echo '<li style="float:right;margin-right:5px;"><a>Username: '. $_SESSION['username']. '</a></li>';
                } else {
                    echo '<li style="float:right;margin-right:40px;"><a href="/account/register">Register</a></li><li style="float:right"><a href="/account/login">Login</a></li>';
                }
            ?>
        </ul>
    </header>
    <?php include_once('views/layouts/messages.php'); ?>

