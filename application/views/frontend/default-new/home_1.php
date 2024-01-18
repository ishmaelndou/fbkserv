<!---------- Banner Section Start ---------------->   
<section class="h-1-banner grid-view-body-v pt-5 ">
    <!--
<div class="video-background">
      <video autoplay loop muted playsinline>
        <source src="https://media.istockphoto.com/id/473265071/video/stock-market.mp4?s=mp4-640x640-is&k=20&c=68uctMcaRaAJrmPSnDPj2MRkdPdmQifaOJH0VXufs-8=" type="video/mp4">
      
      </video>
      <div class="film-overlay"></div>
    </div>-->


    
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 order-md-1 order-sm-2 order-2">
                <div class="h-1-banner-text mb-3">
                    <?php
                        $banner_title = site_phrase(get_frontend_settings('banner_title'));
                        $banner_title_arr = explode(' ', $banner_title);
                    ?>
                    <!--Top text<h1--><h1>
                        <?php
                        foreach($banner_title_arr as $key => $value){
                            if($key == count($banner_title_arr) - 1){
                                echo '<span class="d-inline-block">'.$value.'</span>';
                            }else{
                                echo $value.' ';
                            }
                        }
                        ?>
                    </h1>
                    <div class="h-1-banner-sub">
                    <p><?php echo site_phrase(get_frontend_settings('banner_sub_title')); ?></p>
                    </div>
                </div>
                <div class="search-option">
                    <!--<form action="<?php echo site_url('home/search'); ?>" method="get">
                        <input class="form-control" type="text" placeholder="<?php echo get_phrase('What do you want to learn'); ?>" name="query">
                        <button class="submit-cls" type="submit"><i class="fa fa-search"></i><?php echo get_phrase('Search') ?></button>
                    </form>-->
                    <div class="mt-sm-5 mt-4 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.7s" style="visibility: visible; animation-duration: 0.3s; animation-delay: 0.7s; animation-name: fadeInUp;">
  
  <?php if(!$user_id): ?>
          <a href="<?php echo site_url('login'); ?>" class="btn sp_light_border_btn mb-2"> <?php echo get_phrase('Login'); ?></a>
          <a href="<?php echo site_url('sign_up'); ?>" class="btn sp_theme_btn me-3 mb-2"> <?php echo get_phrase('Join Now'); ?></a>
        <?php endif; ?>

  <div class="row">
            <div class="col-lg-6">
            <div class="brand-4">
            <div class="">
              <?php $all_students = $this->db->get_where('users', ['role_id !=' => 1]); ?>
              <h1>800+</h1>
              <p><?php echo get_phrase('Signals') ?></p>
            </div>
            <div class="">
              <?php $all_instructor = $this->db->get_where('users', ['is_instructor' => 1]); ?>
              <h1>400+</h1>
              <p><?php echo get_phrase('Mentor Sessions') ?></p>
            </div>
            <div class="">
              <?php $status_wise_courses = $this->crud_model->get_status_wise_courses_front(); ?>
              <h1> 3.5k+</h1>
              <p><?php echo get_phrase('Students') ?></p>
            </div>
            <div class="">
              <?php $status_wise_courses = $this->crud_model->get_status_wise_courses_front(); ?>
              <h1> 80%</h1>
              <p><?php echo get_phrase('Customer Satisfaction') ?></p>
            </div>
          </div>
            </div>
        </div>
</div>
                    </div>
                <!--image area-->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 order-md-2 order-sm-1 order-1 pt-0 pt-md-5 ">
            <div id="tilt" style="background-image: url('<?php echo base_url("uploads/system/" . get_current_banner('banner_image')); ?>');"></div>
            </div>
        </div> 

         
    </div>
 </div>

  
    <div class="custom-carousel-container">
    <div class="custom-carousel">
        <a href="https://fbktechnologies.com/" target="_blank" class="image image-1"></a>
        <a href="https://fbkrides.com/" target="_blank" class="image image-2"></a>
        <a href="https://fbkmarkets.com/" target="_blank" class="image image-3"></a>
       <!-- <a href="https://fbktechnologies.com/" target="_blank" class="image image-1"></a>
        <a href="https://fbkrides.com/" target="_blank" class="image image-2"></a>
        <a href="https://fbkmarkets.com/" target="_blank" class="image image-3"></a>-->

        <!-- Add more images as needed -->
    </div>
</div>

  
  
  </section>
  <section class="">
  <div class="download-container">
        <h1></h1>
        <p>Download our free Forex guide e-book to get started with Forex trading:</p>
        <a href="assets/frontend/default-new/image/FBK Markets eBook.pdf" download="FBK Markets eBook.pdf" class="download-button">Download </a>
    </div>

  </section>
<!---------- Latest courses Section start --------------->
<section class="vect grid-view-body2 pb-4" id="vect grid-view-body2 pb-4">
    <div class="container">
        <h1 class="text-center"><span><?php echo site_phrase('Our') . '  ' . site_phrase('latest_courses'); ?></span></h1>
        <p class="text-center"><?php echo site_phrase('These_are_the_most_latest_courses_among_Listed_Courses')?></p>
        <div class="courses-card">
            <div class="course-group-slider ">
                <?php
                $latest_courses = $this->crud_model->get_latest_10_course();
                foreach ($latest_courses as $latest_course) :
                    $lessons = $this->crud_model->get_lessons('course', $latest_course['id']);
                    $instructor_details = $this->user_model->get_all_user($latest_course['creator'])->row_array();
                    $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($latest_course['id']);
                    $total_rating =  $this->crud_model->get_ratings('course', $latest_course['id'], true)->row()->rating;
                    $number_of_ratings = $this->crud_model->get_ratings('course', $latest_course['id'])->num_rows();
                    if ($number_of_ratings > 0) {
                        $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                    } else {
                        $average_ceil_rating = 0;
                    }
                    ?>
                    <div class="single-popup-course">
                        <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($latest_course['title'])) . '/' . $latest_course['id']); ?>" id="latest_course_<?php echo $latest_course['id']; ?>" class="checkPropagation courses-card-body">
                            <div class="courses-card-image">
                                <img src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>">
                                <div class="courses-icon <?php if(in_array($latest_course['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIconLatestCourse<?php echo $latest_course['id']; ?>">
                                    <i class="fa-solid fa-heart checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/'.$latest_course['id'].'/LatestCourse'); ?>')"></i>
                                </div>
                                <div class="courses-card-image-text">
                                    <h3><?php echo get_phrase($latest_course['level']); ?></h3>
                                </div> 
                            </div>
                            <div class="courses-text">
                                <h5 class="mb-2"><?php echo $latest_course['title']; ?>
                            </h5>
                            <p class="ellipsis-line-2">
                                <?php echo $latest_course['short_description'] ?>
                            </p>
                            <div class="review-icon">
                                <div class="review-icon-star align-items-center">
                                    <p><i class="fa-solid fa-star <?php if ($number_of_ratings > 0)
                                        echo 'filled'; ?>"></i></p>
                                    <p>(
                                        <?php echo $number_of_ratings; ?>
                                        <?php echo get_phrase('Reviews') ?>)
                                    </p>
                                </div>
                            </div>

                            <div class="courses-price-border">
                                <div class="courses-price">
                                    <div class="courses-price-left">
                                        <?php if ($latest_course['is_free_course']): ?>
                                        <h5>
                                            <?php echo get_phrase('Free'); ?>
                                        </h5>
                                        <?php elseif ($latest_course['discount_flag']): ?>
                                        <h5>
                                            <?php echo currency($latest_course['discounted_price']); ?>
                                        </h5>
                                        <p class="mt-1"><del>
                                                <?php echo currency($latest_course['price']); ?>
                                            </del></p>
                                        <?php else: ?>
                                        <h5>
                                            <?php echo currency($latest_course['price']); ?>
                                        </h5>
                                        <?php endif; ?>
                                    </div>
                                    <div class="courses-price-right ">
                                        <p class="m-0"><i class="fa-regular fa-clock p-0 text-15px"></i>
                                            <?php echo $course_duration; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>                        
		     </a>




                        <div id="latest_course_feature_<?php echo $latest_course['id']; ?>" class="course-popover-content">
                            <?php if ($latest_course['last_modified'] == "") : ?>
                                <p class="last-update"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $latest_course['date_added']); ?></p>
                            <?php else : ?>
                                <p class="last-update"><?php echo site_phrase('last_updated') . ' ' . date('D, d-M-Y', $latest_course['last_modified']); ?></p>
                            <?php endif; ?>
                            <div class="course-title">
                                 <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($latest_course['title'])) . '/' . $latest_course['id']); ?>"><?php echo $latest_course['title']; ?></a>
                            </div>
                            <div class="course-meta">
                                <?php if ($latest_course['course_type'] == 'general') : ?>
                                    <span class=""><i class="fas fa-play-circle"></i>
                                        <?php echo $this->crud_model->get_lessons('course', $latest_course['id'])->num_rows() . ' ' . site_phrase('lessons'); ?>
                                    </span>
                                    <span class=""><i class="far fa-clock"></i>
                                        <?php echo $course_duration; ?>
                                    </span>
                                <?php elseif ($latest_course['course_type'] == 'h5p') : ?>
                                    <span class="badge bg-light"><?= site_phrase('h5p_course'); ?></span>
                                <?php elseif ($latest_course['course_type'] == 'scorm') : ?>
                                    <span class="badge bg-light"><?= site_phrase('scorm_course'); ?></span>
                                <?php endif; ?>
                                <span class=""><i class="fas fa-closed-captioning"></i><?php echo ucfirst($latest_course['language']); ?></span>
                             </div>
                            <div class="course-subtitle">
                                 <?php echo $latest_course['short_description']; ?>
                            </div>
                            <h6 class="text-black text-14px mb-1"><?php echo get_phrase('Outcomes') ?>:</h6>
                            <ul class="will-learn">
                                <?php $outcomes = json_decode($latest_course['outcomes']);
                                foreach ($outcomes as $outcome) : ?>
                                    <li><?php echo $outcome; ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="popover-btns">
                                <?php $cart_items = $this->session->userdata('cart_items'); ?>
                                <?php if(is_purchased($latest_course['id'])): ?>
                                    <a href="<?php echo site_url('home/lesson/'.slugify($latest_course['title']).'/'.$latest_course['id']) ?>" class="purchase-btn d-flex align-items-center  me-auto"><i class="far fa-play-circle me-2"></i> <?php echo get_phrase('Start Now'); ?></a>
                                    <?php if ($latest_course['is_free_course'] != 1) : ?>
                                       <!-- <button type="button" class="gift-btn ms-auto" title="<?php echo get_phrase('Gift someone else'); ?>" data-bs-toggle="tooltip" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $latest_course['id'].'?gift=1'); ?>')"><i class="fas fa-gift"></i></button>-->
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if ($latest_course['is_free_course'] == 1) : ?>
                                        <a class="purchase-btn green_purchase ms-auto" href="<?php echo site_url('home/get_enrolled_to_free_course/' . $latest_course['id']); ?>"><?php echo get_phrase('Enroll Now'); ?></a>
                                    <?php else : ?>

                                        <!-- Cart button -->
                                        <a id="added_to_cart_btn_latest_course<?php echo $latest_course['id']; ?>" class="purchase-btn align-items-center me-auto <?php if(!in_array($latest_course['id'], $cart_items)) echo 'd-hidden'; ?>" href="javascript:void(0)" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $latest_course['id'].'/latest_course'); ?>');">
                                            <i class="fas fa-minus me-2"></i> <?php echo get_phrase('Remove from cart'); ?>
                                        </a>
                                        <a id="add_to_cart_btn_latest_course<?php echo $latest_course['id']; ?>" class="purchase-btn align-items-center me-auto <?php if(in_array($latest_course['id'], $cart_items)) echo 'd-hidden'; ?>" href="javascript:void(0)" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $latest_course['id'].'/latest_course'); ?>'); ">
                                            <i class="fas fa-plus me-2"></i> <?php echo get_phrase('Add to cart'); ?>
                                        </a>
                                        <!-- Cart button ended-->
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <script>
                                $(document).ready(function(){
                                    $('#latest_course_<?php echo $latest_course['id']; ?>').webuiPopover({
                                        url:'#latest_course_feature_<?php echo $latest_course['id']; ?>',
                                        trigger:'hover',
                                        animation:'pop',
                                        cache:false,
                                        multi:true,
                                        direction:'rtl', 
                                        placement:'horizontal',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!---------- Latest courses Section End --------------->
<!---------- Banner Section End --------------
<section class="courses grid-view-body">
<div class="container">-->

    
<!-- Start Upcoming Courses -->
<?php $upcoming_courses = $this->db->order_by('id', 'desc')->limit(6)->get_where('course', ['status' => 'upcoming']); ?>
<?php if($upcoming_courses->num_rows() > 0): ?>
    <section class="pt-110 mt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="title-one pb-20">
              <p class="subtitle text-uppercase"><?php echo get_phrase('Upcoming'); ?></p>
              <h4 class="title"><?php echo get_phrase('Upcoming courses'); ?></h4>
              <div class="bar"></div>
            </div>
            <p class="fz_15_m_24"><?php echo get_phrase('Discover a world of learning opportunities through our upcoming courses, where industry experts and thought leaders will guide you in acquiring new expertise, expanding your horizons, and reaching your full potential.') ?></p>
          </div>
          <div class="col-lg-8">
            <!-- Items -->
            <div class="row g-3">
              <?php
                foreach($upcoming_courses->result_array() as $upcoming_course):
                ?>
                <div class="col-lg-4">
                  <a href="#" class="course-item-one">
                    <div class="img-rating">
                      <div class="img"><img src="<?php echo $this->crud_model->get_course_thumbnail_url($upcoming_course['id']); ?>" alt="" /></div>
                      <!-- <p class="date">Sep<span>12</span></p> -->
                    </div>
                    <div class="content">
                      <h4 class="title"><?php echo $upcoming_course['title']; ?></h4>
                      <p class="info ellipsis-line-2 fw-400"><?php echo $upcoming_course['short_description']; ?></p>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php endif; ?>
<!-- End Upcoming Courses -->






<!-------- Services_offered end ------------->
<section class="courses grid-view-body pb-4">
    <div class="container">
        <h1 class="text-center"><span><?php echo site_phrase('Our') . '  ' . site_phrase('latest_Services'); ?></span></h1>
        <p class="text-center eeee"><?php echo site_phrase('These_are_the_most_latest_serivces_among_Listed')?></p>
        <div class="">
  <div class="row ">
      <div class="col-lg-4 col-sm-6 row3">
        <div class="service-item-one  ">
          <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/note_5406139.png" alt="" /></div>

            <?php
              $status_wise_courses = $this->crud_model->get_status_wise_courses_front();
              $number_of_courses = $status_wise_courses['active']->num_rows();
            ?>
            <h4 class="title"><?php echo $number_of_courses . ' ' . site_phrase('online_courses'); ?></h4>
            <p class="info"><?php echo site_phrase('Unlock Fresh Insights by Exploring Diverse.'); ?></p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 row3 ">
        <div class="service-item-one ">
          <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/increase_5028278.png" alt="" /></div>
          <h4 class="title"><?php echo get_phrase('Lifetime Fundamental Signals') ?></h4>
          <p class="info"><?php echo site_phrase('Access Lifelong Fundamental Signals - Uncover Opportunities.'); ?></p>
        </div>
      </div>
      
      <div class="col-lg-4 col-sm-6 row3">
        <div class="service-item-one">
          <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/time-management_4270104.png" alt="" /></div>
          <h4 class="title"><?php echo get_phrase('Lifetime Mentoring') ?></h4>
          <p class="info"><?php echo site_phrase('Receive Lifelong Mentoring - Navigate Your Journey.'); ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="col-lg-4 col-sm-6 row3">
        <div class="service-item-one">
          <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/clock_3237035.png" alt="" /></div>
          <h4 class="title"><?php echo site_phrase('One Minute strategy'); ?></h4>
          <p class="info"><?php echo site_phrase('Master the One-Minute Strategy - Elevate Performance.'); ?></p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 row3">
        <div class="service-item-one">
          <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/canvas_5955274.png" alt="" /></div>
          <h4 class="title"><?php echo site_phrase('Nasdaq Technical Signals'); ?></h4>
          <p class="info"><?php echo site_phrase('Decode Nasdaq Technical Signals - Maximize Potential.'); ?></p>
        </div>
      </div>
      
       <div class="col-lg-4 col-sm-6 row3">
        <div class="service-item-one">
          <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/switch_6308514.png" alt="" /></div>
          <h4 class="title"><?php echo site_phrase('US30 (Dow&Jones) signals'); ?></h4>
          <p class="info"><?php echo site_phrase('Navigate US30 (Dow & Jones) Signals - Optimize Decisions.'); ?></p>
        </div>
      </div>
    </div>
  </div>
  </div>
    </div>
</section>

<!-------- Services_offered end ------------->
<section class="courses grid-view-body22 pb-4">
    <div class="container">
        <h1 class="text-center"><span><?php echo site_phrase('') . '  ' . site_phrase("UNLOCKING THE MAGIC: HERE'S HOW IT WORKS"); ?></span></h1>
        <p class="text-center eeee"><?php echo site_phrase('Ready, set, trade! sign up and begin your forex journey')?></p>
        <div class="row2">
  <div class="row justify-content-center">
    <div class="col-lg-4 col-sm-6 row3">
      <div class="service-item-onee">
        <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/test4.png" alt="" /></div>
        <h4 class="title"><?php echo site_phrase('SIGN UP'); ?></h4>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 row3">
      <div class="service-item-onee">
        <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/test1.png" alt="" /></div>
        <h4 class="title"><?php echo site_phrase('LEARN'); ?></h4>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-4 col-sm-6 row3">
      <div class="service-item-onee">
        <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/test3.png" alt="" /></div>
        <h4 class="title"><?php echo site_phrase('SIGNALS'); ?></h4>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 row3">
      <div class="service-item-onee">
        <div class="icon"><img src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/test4.png" alt="" /></div>
        <h4 class="title"><?php echo site_phrase('TRADE'); ?></h4>
      </div>
    </div>
  </div>
</div>

  </div>
</section>








<?php $motivational_speechs = json_decode(get_frontend_settings('motivational_speech'), true); ?>
<?php if(count($motivational_speechs) > 0): ?>
<!---------  Motivetional Speech Start ---------------->
<section class="expert-instructor top-categories pb-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <h1 class="text-center mt-4"><?php echo get_phrase('Think more clearly'); ?></h1>
        <p class="text-center mt-4 mb-4"><?php echo get_phrase('Gather your thoughts, and make your decisions clearly') ?></p>
      </div>
      <div class="col-lg-3"></div>
    </div>
    <ul class="speech-items">
        <?php $counter = 0; ?>
        <?php foreach($motivational_speechs as $key => $motivational_speech): ?>
        <?php $counter = $counter+1; ?>
        <li>
            <div class="speech-item">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5">
                        <div class="speech-item-img">
                            <img src="<?php echo site_url('uploads/system/motivations/'.$motivational_speech['image']) ?>" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="speech-item-content">
                            <p class="no"><?php echo $counter; ?></p>
                            <div class="inner">
                                <h4 class="title">
                                    <?php echo $motivational_speech['title']; ?>
                                </h4>
                                <p class="info">
                                    <?php echo nl2br($motivational_speech['description']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
  </div>
</section>
<!---------  Motivetional Speech end ---------------->
<?php endif; ?>

<?php $website_faqs = json_decode(get_frontend_settings('website_faqs'), true); ?>
<?php if(count($website_faqs) > 0): ?>
<!---------- Questions Section Start  -------------->
<section class="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <h1 class="text-center mt-4"><?php echo get_phrase('Frequently Asked Questions') ?></h1>
                <p class="text-center mt-4 mb-5"><?php echo get_phrase('Have something to know?') ?> <?php echo get_phrase('Check here if you have any questions about us.') ?></p>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="faq-accrodion mb-0">
                    <div class="accordion" id="accordionFaq">
                        <?php foreach($website_faqs as $key => $faq): ?>
                            <?php if($key > 4) break; ?>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="<?php echo 'faqItemHeading'.$key; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel'.$key; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel'.$key; ?>">
                                    <?php echo $faq['question']; ?>
                                </button>
                              </h2>
                              <div id="<?php echo 'faqItempanel'.$key; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading'.$key; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br($faq['answer']); ?></p>
                                </div>
                              </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if(count($website_faqs) > 5): ?>
                        <a href="<?php echo site_url('home/faq') ?>" class="btn btn-primary mt-5"><?php echo get_phrase('See More'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------- Questions Section End  -------------->
<?php endif; ?>


<!------------- Blog Section Start ------------>
<?php $latest_blogs = $this->crud_model->get_latest_blogs(3); ?>
<?php if(get_frontend_settings('blog_visibility_on_the_home_page') && $latest_blogs->num_rows() > 0): ?>
<section class="courses blog">
    <div class="container">
        <h1 class="text-center"><span><?php echo site_phrase('Visit our latest blogs')?></span></h1>
        <p class="text-center"><?php echo site_phrase('Visit our valuable articles to get more information.')?>
        <div class="courses-card">
            <div class="row">
               <?php foreach($latest_blogs->result_array() as $latest_blog):
                $user_details = $this->user_model->get_all_user($latest_blog['user_id'])->row_array();
                $blog_category = $this->crud_model->get_blog_categories($latest_blog['blog_category_id'])->row_array(); ?>  
                <div class="col-lg-4 col-md-6 mb-3">
                    <a href="<?php echo site_url('blog/details/'.slugify($latest_blog['title']).'/'.$latest_blog['blog_id']); ?>" class="courses-card-body">
                        <div class="courses-card-image">
                            <?php $blog_thumbnail = 'uploads/blog/thumbnail/'.$latest_blog['thumbnail'];
                               if(!file_exists($blog_thumbnail) || !is_file($blog_thumbnail)):
                                   $blog_thumbnail = base_url('uploads/blog/thumbnail/placeholder.png');
                              endif; ?>
                            <div class="courses-card-image">
                             <img src="<?php echo $blog_thumbnail; ?>">
                            </div>
                            <div class="courses-card-image-text">
                                <h3><?php echo $blog_category['title']; ?></h3>
                            </div> 
                        </div>
                        <div class="courses-text">
                            <h5><?php echo $latest_blog['title']; ?></h5>
                            <p class="ellipsis-line-2"><?php echo ellipsis(strip_tags(htmlspecialchars_decode_($latest_blog['description'])), 100); ?></p>
                            <div class="courses-price-border">
                                <div class="courses-price">
                                    <div class="courses-price-left">
                                        <img class="rounded-circle" src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>">
                                        <h5><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></h5>
                                    </div>
                                    <div class="courses-price-right ">
                                        <p><?php echo get_past_time($latest_blog['added_date']); ?></p>
                                    </div>
                                </div>
                            </div>
                           </div>
                     </a>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

    <div class="tradingview-widget-container">
        <div class="tradingview-widget-container__widget"></div>
        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow"
                target="_blank"></a></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
            async>
        {
            "symbols": [{
                    "proName": "FOREXCOM:SPXUSD",
                    "title": "S&P 500"
                },
                {
                    "proName": "FOREXCOM:NSXUSD",
                    "title": "US 100"
                },
                {
                    "proName": "FX_IDC:EURUSD",
                    "title": "EUR to USD"
                },
                {
                    "proName": "BITSTAMP:BTCUSD",
                    "title": "Bitcoin"
                },
                {
                    "proName": "BITSTAMP:ETHUSD",
                    "title": "Ethereum"
                }
            ],
            "showSymbolLogo": true,
            "colorTheme": "light",
            "isTransparent": false,
            "displayMode": "adaptive",
            "locale": "en"
        }
        </script>
    </div>
<!------------- Market Overview ---------> 
<center>
<section class="grizzly" id="grizzly">






 
<div class="container ">
    <div class="makert">
    <div class="student-body-1-9">  
         <div class="student-body-1">
         <div class="Click-here">News Feed</div>        
<div class="custom-model-main">
    <div class="custom-model-inner">        
    <div class="close-btn">Close</div>
        <div class="custom-model-wrap">
            <div class="pop-up-content-wrap">
                <div class="stock">
         <h1 class="text-center mt-4"><?php echo site_phrase('News Feed'); ?></h1>
        <div class="item1">

<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://fbkmarkets.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on FBK market</span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
  {
  "feedMode": "all_symbols",
  "colorTheme": "dark",
  "isTransparent": true,
  "displayMode": "regular",
  "width": "100%",
  "height": "400",
  "locale": "en"
}
  </script>
</div>
<!-- TradingView Widget END -->
</div>
            </div>
        </div>  
    </div>  
   


</div>
</div>
</div>
</div>

</section>
</center>


<style>
    .custom-background {
    background-image: url('../assets/frontend/default-new/image/zzz.png');
    background-size: cover; /* Adjust as needed */
    background-repeat: no-repeat; /* Adjust as needed */
  }
.center-right {
    display: flex;
    justify-content: flex-end;
    font-family: Arial, sans-sarif;
    color:#fff
}

.iframe-container {
    width: 100%;
    height: 660px;
    margin: 0 auto;
	font-family: Arial, sans-serif;
            background-color: transparent;
            margin: 0;
            padding: 0;
}

.poweredBy {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #333333;
    text-align: right;
    margin-top: 5px;
}


.carousel-inner .item img {
      width: 100%;
      max-height: 900px; /* Adjust the max height as needed */
      object-fit: cover; /* Preserve aspect ratio and cover the container */
    }
    .carousel-inner {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

.medium-image{

}
     .mySlides{
      text-align: center;
      margin: 20px;
      background-color: #fff;
      border-radius: 20px;
      padding: 20px;
      box-shadow: 10px 10px 20px rgba(163, 177, 198, 0.7),
        -10px -10px 20px rgba(255, 255, 255, 0.5);
      transition: all 0.3s ease-in-out;
    }
    .makert {
    display: flex;
    flex-direction:column;
    justify-content: center;
    align-items: center;
    align-content :center;
    margin: 0;
    padding: 0;
   
    background-color: transparent;
  }
.stock{
    display: inline-block;
    justify-content: space-between;
    align-items: center;
    margin: 0;
    padding: 0;
    background-color: transparent;
  }
  /*for 2nd button*/
  .stock1{
    display: inline-block;
    justify-content: space-between;
    align-items: center;
    margin: 0;
    padding: 0;
    background-color: transparent;
  }
  .student-body-1-9 {
    display: flex;
    flex-direction:row;
    justify-content: center;
    align-items: center;
    align-content :center;
    width: 49%; /* Adjust the width as needed */
    padding: 20px;
    height: 100%;
  }
  .student-body-1{
 margin-top: -16px;
  border-radius: 7px;
   display: flex;
    flex-direction:row;
    justify-content: center;
    align-items: center;
    align-content :center;
}
  .item {
    text-align: center;
    margin: 20px;
    background-color: #DDF8F7;
    border-radius: 20px;
    width: 350px; /* Adjust the width as needed */
    padding: 10px;
    height:'400px';
    box-shadow: 10px 10px 20px rgba(163, 177, 198, 0.7),
                -10px -10px 20px rgba(255, 255, 255, 0.5);
    transition: all 0.3s ease-in-out;
  }
  .item3 {
    text-align: center;
    margin: 20px;
    background-color: #DDF8F7;
    border-radius: 20px;
    width: 850px; /* Adjust the width as needed */
    padding: 10px;
    height:'200px';
    box-shadow: 10px 10px 20px rgba(163, 177, 198, 0.7),
                -10px -10px 20px rgba(255, 255, 255, 0.5);
    transition: all 0.3s ease-in-out;
  }
  .item1 {
    text-align: center;
    margin: 20px;
    background-color: #282c34;
    border-radius:20px;
    width: 850px; /* Adjust the width as needed */
    padding: 10px;
    height:'300px';
    box-shadow: 10px 10px 20px rgba(163, 177, 198, 0.7),
                -10px -10px 20px rgba(255, 255, 255, 0.5);
    transition: all 0.3s ease-in-out;
  }
  .image-slider-track{
    gap:px;
  }

  /* Media query for smaller screens */
  @media (max-width: 768px) {
    .makert {
      flex-direction: column;
      align-items:center;
      
    }
   
    .stock {
      flex-direction: column;
      align-items:center;

    }
    .thee-vid{
        width:310px;
        
    }
.item{
    width:280px;
}
.item3{
    width:280px;
}
.item1{
    width:310px;
}
    .student-body-1-9 {
      width: auto;
    }

    .item {
      margin: 20px 0;
    }
    
    .item1 {
      margin: 20px 0;
    }
  }
    .itemh{
    text-align: center;
      margin: 20px;
      background-color: linear-gradient(to top,rgba(255, 255, 255, 0.553) 0%, ##089c9c 70%);
      border-radius: 20px;
      padding: 10px;
      box-shadow: 10px 10px 20px rgba(163, 177, 198, 0.7),
        -10px -10px 20px rgba(255, 255, 255, 0.5);
      transition: all 0.3s ease-in-out;}
    .item6{
    
    }
    .item,.mySlides:hover {
      transform: translate(0, -5px);
      box-shadow: 5px 5px 15px rgba(163, 177, 198, 0.7),
        -5px -5px 15px rgba(255, 255, 255, 0.5);
    }
    .item {
      transform: translate(0, -5px);
      box-shadow: 5px 5px 15px rgba(163, 177, 198, 0.7),
        -5px -5px 15px rgba(255, 255, 255, 0.5);
    }
    


    
/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}


/* Add your CSS styles for slideshow-container, mySlides, fade, prev, and next here */

.fade {
  animation-name: fade;
  animation-duration: 1s;
}

@keyframes fade {
  from {
    opacity: 0;
    transform: translateX(-50%);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.Click-here {
  cursor: pointer;
  background-color:#fff;
  color: #089c9c;
  width: 180px;
  border: 3px solid #089c9c;
  border-radius:15px;
  text-align: center;
  font-size:18px;
  padding: 10px 20px;
  font-weight: bold;
  margin: 0 auto;
  font-family: Tahoma, sans-serif;
  transition:background-image 3s ease-in-out;
}
.Click-here:hover{
  transition:background-image 3s ease-in-out;
  background-color: #089c9c;
  color:#fff;
}
.custom-model-main {
  text-align: center;
  overflow: hidden;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0; /* z-index: 1050; */
  -webkit-overflow-scrolling: touch;
  outline: 0;
  opacity: 0;
  -webkit-transition: opacity 0.15s linear, z-index 0.15;
  -o-transition: opacity 0.15s linear, z-index 0.15;
  transition: opacity 0.15s linear, z-index 0.15;
  z-index: -1;
  overflow-x: hidden;
  overflow-y: auto;
  background-color:rgba(0, 0, 0, 0.9);
  padding-top: 10px;
  align-items: center;
}

.model-open {
  z-index: 99999;
  opacity: 1;
  overflow: hidden;
}
.custom-model-inner {
  -webkit-transform: translate(0, -25%);
  -ms-transform: translate(0, -25%);
  transform: translate(0, -25%);
  -webkit-transition: -webkit-transform 0.3s ease-out;
  -o-transition: -o-transform 0.3s ease-out;
  transition: -webkit-transform 0.3s ease-out;
  -o-transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
  display: inline-block;
  vertical-align: middle;
  width: 950px;
  height :800px;
  margin: 30px auto;
  max-width: 97%;
}
.custom-model-wrap {
  display: block;
  width: 100%;
  position: relative;
  background-color: #fff;
  border: 1px solid #999;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 6px;
  -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  background-clip: padding-box;
  outline: 0;
  align-items: center;
  padding: 20px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  max-height: calc(100vh - 70px);
	overflow-y: auto;
}
.model-open .custom-model-inner {
  -webkit-transform: translate(0, 0);
  -ms-transform: translate(0, 0);
  transform: translate(0, 0);
  position: relative;
  z-index: 999;
}
.model-open .bg-overlay {
  background: rgba(0, 0, 0, 0.6);
  z-index: 99;
}


/* Vendor-specific prefixes for browser compatibility */
.bg-overla1y {
  -webkit-transition: background 0.15s linear;
  -o-transition: background 0.15s linear;
}

.close-btn {
  position: absolute;
  right: 0;
  top: -30px;
  cursor: pointer;
  z-index: 99;
  font-size: 30px;
  color: #fff;
 font-size: 20px;
  
}

.pop-up-content-wrap{
  display:block;
  flex-direction: row;
  align-items:center;
  justify-content: center;
  align-content: center;
}

@media screen and (min-width:800px){
	.custom-model-main:before {
	  content: "";
	  display: inline-block;
	  height: auto;
	  vertical-align: middle;
	  margin-right: -0px;
	  height: 100%;
	}
  .pop-up-content-wrap{

  flex-direction: column;
  align-items:center;
  justify-content: center;
}
}

@media screen and (max-width:799px){
  .custom-model-inner{margin-top: 45px;}
  .pop-up-content-wrap{
 
  flex-direction: column;
  align-items:center;
  justify-content: center;
  width:90px;
  margin-top:
}
}
/*2nd button*/

.Max {
  cursor: pointer;
  background-color:#fff;
  color: #089c9c;
  width: 180px;
  border: 3px solid #089c9c;
  border-radius:15px;
  text-align: center;
  font-size:18px;
  padding: 10px 20px;
  font-weight: bold;
  margin: 0 auto;
  font-family: Tahoma, sans-serif;
  transition:background-image 3s ease-in-out;
}
.Max:hover{
  transition:background-image 3s ease-in-out;
  background-color: #089c9c;
  color:#fff;
}
.custom-model-main1 {
  text-align: center;
  overflow: hidden;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0; /* z-index: 1050; */
  -webkit-overflow-scrolling: touch;
  outline: 0;
  opacity: 0;
  -webkit-transition: opacity 0.15s linear, z-index 0.15;
  -o-transition: opacity 0.15s linear, z-index 0.15;
  transition: opacity 0.15s linear, z-index 0.15;
  z-index: -1;
  overflow-x: hidden;
  overflow-y: auto;
  width:
}

.model-open1 {
  z-index: 99999;
  opacity: 1;
  overflow: hidden;
}
.custom-model-inner1 {
  -webkit-transform: translate(0, -25%);
  -ms-transform: translate(0, -25%);
  transform: translate(0, -25%);
  -webkit-transition: -webkit-transform 0.3s ease-out;
  -o-transition: -o-transform 0.3s ease-out;
  transition: -webkit-transform 0.3s ease-out;
  -o-transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
  display: inline-block;
  vertical-align: middle;
  width: 950px;
  height :800px;
  margin: 30px auto;
  max-width: 97%;
}
.custom-model-wrap1 {
  display: block;
  width: 100%;
  position: relative;
  background-color: #fff;
  border: 1px solid #999;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 6px;
  -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  background-clip: padding-box;
  outline: 0;
  align-items: center;
  padding: 20px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  max-height: calc(100vh - 70px);
	overflow-y: auto;
}
.model-open1 .custom-model-inner1 {
  -webkit-transform: translate(0, 0);
  -ms-transform: translate(0, 0);
  transform: translate(0, 0);
  position: relative;
  z-index: 999;
}
.model-open1 .bg-overlay1 {
  background: rgba(0, 0, 0, 0.6);
  z-index: 99;
}


/* Vendor-specific prefixes for browser compatibility */
.bg-overla1y {
  -webkit-transition: background 0.15s linear;
  -o-transition: background 0.15s linear;
}

.close-btn1 {
  position: absolute;
  right: 0;
  top: -30px;
  cursor: pointer;
  z-index: 99;
  font-size: 30px;
  color: #000;
}
.pop-up-content-wrap1{
  display:block;
  flex-direction: row;
  align-items:center;
  justify-content: center;
  align-content: center;
}

@media screen and (min-width:800px){
	.custom-model-main1:before {
	  content: "";
	  display: inline-block;
	  height: auto;
	  vertical-align: middle;
	  margin-right: -0px;
	  height: 100%;
	}
  .pop-up-content-wrap1{

  flex-direction: column;
  align-items:center;
  justify-content: center;
}
}

@media screen and (max-width:799px){
  .custom-model-inner1{margin-top: 45px;}
  .pop-up-content-wrap1{
 
  flex-direction: column;
  align-items:center;
  justify-content: center;
}
}



.Marko {
  cursor: pointer;
  background-color:#fff;
  color: #089c9c;
  width: 180px;
  border: 3px solid #089c9c;
  border-radius:15px;
  text-align: center;
  font-size:18px;
  padding: 10px 20px;
  font-weight: bold;
  margin: 0 auto;
  font-family: Tahoma, sans-serif;
  transition:background-image 3s ease-in-out;
}
.Marko:hover{
  transition:background-image 3s ease-in-out;
  background-color: #089c9c;
  color:#fff;
}
.custom-model-main4 {
  text-align: center;
  overflow: hidden;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0; /* z-index: 1050; */
  -webkit-overflow-scrolling: touch;
  outline: 0;
  opacity: 0;
  -webkit-transition: opacity 0.15s linear, z-index 0.15;
  -o-transition: opacity 0.15s linear, z-index 0.15;
  transition: opacity 0.15s linear, z-index 0.15;
  z-index: -1;
  overflow-x: hidden;
  overflow-y: auto;
}

.model-open4 {
  z-index: 99999;
  opacity: 1;
  overflow: hidden;
}
.custom-model-inner4 {
  -webkit-transform: translate(0, -25%);
  -ms-transform: translate(0, -25%);
  transform: translate(0, -25%);
  -webkit-transition: -webkit-transform 0.3s ease-out;
  -o-transition: -o-transform 0.3s ease-out;
  transition: -webkit-transform 0.3s ease-out;
  -o-transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
  display: inline-block;
  vertical-align: middle;
  width: 950px;
  height :800px
  margin: 30px auto;
  max-width: 97%;
}
.custom-model-wrap4 {
  display: block;
  width: 100%;
  position: relative;
  background-color: #fff;
  border: 1px solid #999;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 6px;
  -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  background-clip: padding-box;
  outline: 0;
  align-items: center;
  padding: 20px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  max-height: calc(100vh - 70px);
	overflow-y: auto;
}
.model-open4 .custom-model-inner4 {
  -webkit-transform: translate(0, 0);
  -ms-transform: translate(0, 0);
  transform: translate(0, 0);
  position: relative;
  z-index: 999;
}
.model-open4 .bg-overlay4 {
  background: rgba(0, 0, 0, 0.6);
  z-index: 99;
}


/* Vendor-specific prefixes for browser compatibility */
.bg-overla1y {
  -webkit-transition: background 0.15s linear;
  -o-transition: background 0.15s linear;
}

.close-btn4 {
  position: absolute;
  right: 0;
  top: -30px;
  cursor: pointer;
  z-index: 99;
  font-size: 30px;
  color: #000;
}
.pop-up-content-wrap4{
  display:block;
  flex-direction: row;
  align-items:center;
  justify-content: center;
  align-content: center;
}

@media screen and (min-width:800px){
	.custom-model-main4:before {
	  content: "";
	  display: inline-block;
	  height: auto;
	  vertical-align: middle;
	  margin-right: -0px;
	  height: 100%;
	}
  .pop-up-content-wrap4{

  flex-direction: column;
  align-items:center;
  justify-content: center;
}
}

@media screen and (max-width:799px){
  .custom-model-inner4{margin-top: 45px;}
  .pop-up-content-wrap4{
 
  flex-direction: column;
  align-items:center;
  justify-content: center;
}
}


  </style>
  
  <script type="text/javascript">

$(".Click-here").on('click', function() {
  $(".custom-model-main").addClass('model-open');
}); 
$(".close-btn, .bg-overlay").click(function(){
  $(".custom-model-main").removeClass('model-open');
});

$(".Max").on('click', function() {
  $(".custom-model-main1").addClass('model-open1');
}); 
$(".close-btn1, .bg-overlay1").click(function(){
  $(".custom-model-main1").removeClass('model-open1');
});

$(".Marko").on('click', function() {
  $(".custom-model-main4").addClass('model-open4');
}); 
$(".close-btn4, .bg-overlay4").click(function(){
  $(".custom-model-main4").removeClass('model-open4');
});


</script>

<script>


</script>
                        </section>
<style>
	#whatsapp-image {
		width: 40px;
		height: 40px;
		position: fixed;
		bottom: 10px;
		right: 10px;
		cursor: pointer;
		transition: transform 0.3s;
	}
	 /* Create a floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Apply the floating animation */
        #whatsapp-image:hover {
            animation: float 1s infinite;
        }

    .download-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: transparent;
            border: 2px solid #089c9c; /* White border */
            border-radius: 5px;
              color:#089c9c;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Style the download button on hover */
        .download-button:hover {
            background-color: #089c9c;  
           color: #fff;
        }
.download-button:hover i.rotate-arrow {
  transform: rotate(90deg); /* Rotate the arrow on hover */
}

        /* Style the container div */
        .download-container {
            text-align: center;
            margin-top: 20px; /* Adjust as needed */
        }
</style>

	<div id="whatsapp-image">
		<a href="https://wa.me/+27780591801">
			<img src="assets/frontend/default-new/image/whatsapp.png" alt="WhatsApp" style="width: 100%; height: 100%;" />
		</a>
	</div>
<script>
        // Get the WhatsApp image element
        const whatsappImage = document.getElementById('whatsapp-image');

        // Function to handle scroll events and screen width
        function handleScrollAndWidth() {
            // Get the current scroll position
            const scrollY = window.scrollY || window.pageYOffset;

            // Get the current screen width
            const screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

            // Adjust the image position based on the scroll position and screen width
            if (scrollY > 100 || screenWidth <= 768) { // Change values as needed
                whatsappImage.style.transform = 'translateY(0)';
            } else {
                whatsappImage.style.transform = 'translateY(100px)';
            }
        }

        // Attach the scroll event listener and screen width listener
        window.addEventListener('scroll', handleScrollAndWidth);
        window.addEventListener('resize', handleScrollAndWidth);

        // Initial check to show/hide the image based on scroll position and screen width
        handleScrollAndWidth();
    </script>
                        
         
