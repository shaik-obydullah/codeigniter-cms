<div class="banner-text-w3ls" id="home">
    <div class="container">
        <div class="mx-auto text-center">
            <h3>Hello, I am <?= $settings['project_name'] ?></h3>
            <p class="banp mx-auto mt-3">Web Application | Software Engineering | ERP Implementation | Server Administrator</p>
            <a class="btn btn-primary mt-lg-5 mt-3 agile-link-bnr" href="#contact" role="button">Connect Me</a>
        </div>
    </div>
</div>
<!-- About -->
<section class="slide-wrapper" id="about">
    <h2 class="w3_head mb-4">About Me</h2>
    <h4 class="main_hd">
        Self-motivated and experienced software engineer with over six years of expertise in developing web applications and websites using technologies like Laravel, React JS and Python. Proficient in building diverse applications ranging from simple tools to complex management systems, with a strong track record in leading teams, managing projects, and delivering high-quality results. I am seeking opportunities to apply my skills to innovative projects and contribute to the success of forward-thinking companies while continuing to grow professionally.
    </h4>
    <p class="iner mt-md-5">
        Being A Software Engineer is my childhood dream. I can still remember those days I was used to playing with Visual Basic, C, and Symbion OS. Learning HTML was my first step and PHP is the first programming language that I like. I am still impressed by It is syntax and simplicity. Recently I am working on Business-Focused Software.
    </p>
</section>
<!-- End of About -->
<!-- Services -->
<section class="services" id="skills">
    <div class="container">
        <h3 class="w3_head mb-4 text-left"> Skills</h3>
        <p class="iner mt-md-5 text-left"> Skills comes with daily experience.</p>
        <ul class="list-unstyled mt-5">
            <li>
                <div class="row">
                    <div class="col-2 ic-lft">
                        <span class="fa fa-code"></span>
                    </div>
                    <div class="col-10">
                        <h6>Web Architect</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-2 ic-lft">
                        <span class="fa fa-cubes"></span>
                    </div>
                    <div class="col-10">
                        <h6>Server Management</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-2 ic-lft">
                        <span class="fa fa-book"></span>
                    </div>
                    <div class="col-10">
                        <h6>Web Application</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-2 ic-lft">
                        <span class="fa fa-coffee"></span>
                    </div>
                    <div class="col-10">
                        <h6>Database Design</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-2 ic-lft">
                        <span class="fa fa-bolt"></span>
                    </div>
                    <div class="col-10">
                        <h6>Project Management</h6>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-2 ic-lft">
                        <span class="fa fa-cog"></span>
                    </div>
                    <div class="col-10">
                        <h6>Business Software</h6>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
<!-- End of Services -->
<!-- Blog -->
<div class="news" id="blog">
    <h3 class="w3_head mb-4 text-left"> Blog</h3>
    <p class="iner mt-md-5 text-left">Connect with my thoughts and working style</p>
    <?php foreach ($blogs as $blog) :
    ?>
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
    <div class="form-group pull-right">
        <a href="<?= base_url() ?>/blog" class="btn btn-success">Read More Blogs</a>
    </div>
</div>
<!-- End of Blog -->
<!-- Contact -->
<section class="contact-us" id="contact">
    <h3 class="w3_head mb-4 text-left"> Contact Me</h3>
    <p class="iner mt-md-5 text-left"> Engineers are introverts. However, I would love to meet new people.</p>
    <div class="contact_grid_right mt-5 mx-auto text-left">
        <form id="contactForm">
            <?= csrf_field() ?>
            <div class="row contact_top">
                <div class="col-sm-6">
                    <input type="text" name="name" placeholder="Name" required="">
                </div>
                <div class="col-sm-6">
                    <input type="email" name="email" placeholder="Email" required="">
                </div>
            </div>
            <textarea name="message" required placeholder="Enter Message"></textarea>
            <div id="message" style="display: none"></div>
            <input type="hidden" id="recaptcha_response" name="recaptcha_response" value="">
            <button type="submit" id="submit" class="btn">Send Message</button>
            <button type="reset" class="btn">Reset</button>
            <div class="clearfix"></div>
        </form>
    </div>
    <div class="cpy-right text-center">
        <p>© 2020 - <?php echo date('Y') ?> <?= $settings['project_name'] ?>. All Rights Reserved</p>
    </div>
</section>
<!-- End of Contact -->