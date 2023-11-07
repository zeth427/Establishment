<?php
include 'partials/header.php';
//fetch featured post from database
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);
//fetch all posts from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC ";
$posts = mysqli_query($connection, $query);
?>
<!--============================= Search ===============================================-->

<section class="search_bar">
    <form class="container search_bar-container" action="<?= ROOT_URL ?>search.php" method="GET" >
        <div>
            <i class='bx bx-search-alt' ></i>
            <input type="search" name="search" placeholder="Buscar">
            
        </div>
        <button type="submit" name="submit" class="btn">Ir</button>
    </form>
</section>

<!--============================= End of Search ===============================================-->
<!--============================= Featured ===============================================-->

<?php if(mysqli_num_rows($featured_result) == 1) : ?>
    <section class="featured">
        <div class="container featured_container">
            <div class="post_thumbnail_p">
                <img src="./Images/<?= $featured['thumbnail'] ?>">
            </div>
            <div class="post_info">
                <?php
                //featured category from categories table using category_id of post
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                
                ?>
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $featured['category_id'] ?>" class="category_button"><?= $category['title'] ?></a>
                <h2 class="post_title"> <a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a> </h2>
                <p class="post_body">
                    <?= substr($featured['body'], 0, 300 )?>
                </p>
                <div class="post_author">
                    <?php
                    //fetch author from users table using author_id
                    $author_id = $featured['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>
                    <!--
                    <div class="post_author-avatar">
                        <img src="./Images/<"?= $author['avatar'] ?>">
                    </div>
                    -->
                    <div class="post_author-info">
                        <!-- <h5>By: <"?= "{$author['firstname']} {$author['lastname']}" ?></h5> -->
                        <small>
                            <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>


    <section class="posts <?= $featured ? '' : 'section_extra-margin' ?>">
        <div class= "container posts_container">
            <?php while($post = mysqli_fetch_assoc($posts)): ?>
                <article class= "post">
                    <div class="post_thumbnail">
                        <img src="./Images/<?= $post['thumbnail'] ?>">
                    </div>
                    <div class="post_info">
                    <?php
                    //featured category from categories table using category_id of post
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                
                    ?>
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id']?>" class="category_button"><?= $category['title']?></a>
                    <h3 class="post_title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id']?>"><?= $post['title'] ?></a>
                    </h3>
                    <p class="post_body">
                        <?= substr($post['body'], 0 ,150) ?>
                    </p>
                        <div class="post_author">
                        <?php
                        //fetch author from users table using author_id
                        $author_id = $post['author_id'];
                        $author_query = "SELECT * FROM users WHERE id=$author_id";
                        $author_result = mysqli_query($connection, $author_query);
                        $author = mysqli_fetch_assoc($author_result);
                        ?>
                            <!--
                            <div class="post_author-avatar">
                                <img src="./Images/<"?= $author['avatar'] ?>">
                            </div>
                            -->
                            <div class="post_author-info">
                                <!-- <h5>Por: <"?= "{$author['firstname']} {$author['lastname']}" ?></h5> -->
                                <small>
                                    <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile ?>
            
        </div>
    </section> 


<!--============================= End of Posts===============================================-->




<section class="category_buttons">
    <div class="container category_buttons-container">
        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection, $all_categories_query);
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)): ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category_button"><?= $category['title']?></a>
        <?php endwhile ?>
    </div>
</section>



<!--============================= End of Category buttons===============================================-->

<?php
include 'partials/footer.php';
?>