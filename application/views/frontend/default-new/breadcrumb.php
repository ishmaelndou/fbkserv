<!---------- Bread Crumb Area Start ---------->
<section>
    <div class="bread-crumb">
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <nav  aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo site_url(); ?>">
                                 <!--   <img class="brd-home mb-1" src="<?php echo base_url('assets/frontend/default-new/image/c-bread-crumb-home.png') ?>">-->
                                    <span><?php echo get_phrase('Home') ?></span>
                                </a>
                            </li>
                            <li><i class="fa-solid fa-chevron-right"></i></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <span><?php echo "Dashboard"; ?></span>
                            </li>
                        </ol>
                    </nav>
                    <h1><?php echo "My Dashboard"; ?></h1>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!---------- Bread Crumb Area End ---------->