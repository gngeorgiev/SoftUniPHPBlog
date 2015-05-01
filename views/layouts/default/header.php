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
        </ul>
    </header>
    <?php include_once('views/layouts/messages.php'); ?>

