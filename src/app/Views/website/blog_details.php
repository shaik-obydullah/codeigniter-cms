<article>
    <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
        <div class="col-md-12 px-0">
            <h1 class="display-4 font-italic"><?= $blog_info['blog_title'] ?></h1>
            <p class="lead my-3"><?= $blog_info['blog_summary'] ?></p>
        </div>
    </div>
    <div class="col-md-12 blog-main">
        <div class="text-center">
            <img src="<?= base_url() . '/uploads/blog/featured_image/' . $blog_info['featured_image'] ?>" alt="<?= $blog_info['blog_title'] ?>" class="img-thumbnail">
        </div>
        <div class="blog-post mt-5 mb-5">
            <?php
            $date = $blog_info['modify_date'] ? $blog_info['modify_date'] : $blog_info['create_date'];
            ?>
            <h6 style="color: #777" class="mt-1">Date: <?php echo date($settings['date_format'], strtotime($date)) ?></h6>
            <?php
            if ($blog_info['tags']) :
            ?>
                <h6 style="color: #777" class="mt-1">
                    Tags:
                    <?php
                    foreach ($blog_info['tags'] as $tag) :
                        $tags = implode(', ', $tag);
                    ?>
                        <span class="badge rounded-pill bg-primary" style="color:white"><?= $tags ?></span>
                    <?php
                    endforeach;
                    ?>
                </h6>
                <hr />
            <?php endif ?>
            <p><?= $blog_info['blog'] ?></p>
        </div>
    </div>
</article>