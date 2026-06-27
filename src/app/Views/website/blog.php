<!-- Blog -->
<div class="news" id="blog">
    <h3 class="w3_head mb-4 text-left"> Blog</h3>
    <p class="iner mt-md-5 text-left">Connect with my thoughts and working style</p>
    <?php foreach ($blogs as $blog) : ?>
        <a href="<?= base_url() . '/blog/' . $blog['blog_slug'] ?>">
            <div class="row news-grids-left mt-5">
                <div class="col-lg-5 news_top">
                    <img src="<?= base_url() . '/uploads/blog/featured_image/' . $blog['featured_image'] ?>" alt="<?= $blog['blog_title'] ?>" class="img-fluid">
                </div>
                <div class="col-lg-7 news_top">
                    <h5><?= $blog['blog_title'] ?></h5>
                    <?php
                    $date = $blog['modify_date'] ? $blog['modify_date'] : $blog['create_date'];
                    ?>
                    <h6 style="color: #777" class="mt-1">Date: <?php echo date($settings['date_format'], strtotime($date)) ?></h6>
                    <?php
                    if ($blog['tags']) :
                    ?>
                        <h6 style="color: #777" class="mt-1">
                            Tags:
                            <?php
                            foreach ($blog['tags'] as $tag) :
                                $tags = implode(', ', $tag);
                            ?>
                                <span class="badge rounded-pill bg-primary" style="color:white"><?= $tags ?></span>
                            <?php
                            endforeach;
                            ?>
                        </h6>
                    <?php endif ?>
                    <p class="mt-3"><?= $blog['blog_summary'] ?></p>
                </div>
            </div>
        </a>
    <?php endforeach ?>
    <?php
    if (isset($pager)) :
        echo $pager->links('blog', 'bootstrap_pagination');
    endif;
    ?>
</div>
<!-- End of Blog -->