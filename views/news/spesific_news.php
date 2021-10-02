<p>
    <a href="/news" class="btn btn-info">Go back to News</a>
</p>
<img src="<?= $news['image']; ?>" alt="">
<h1> <?= $news['title']; ?> </h1>
 <p>
     <?= $news['content']; ?>
 </p>

 <p> Author: <?= $news['author']?></p>
 <p> Category: <?= $news['category']?></p>
 <p> Created: <?= $news['create_date']?></p>
