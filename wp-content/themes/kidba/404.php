<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package kidba
 */

get_header();
?>
<section class="error__area pt-200 pb-200">
   <div class="container">
      <div class="row">
         <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                        <div class="error__item text-center">
               <div class="error__thumb mb-45">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/error.png" alt="Error 404">
               </div>
               <div class="error__content">
                  <h3 class="error__title">Page not found</h3>
                  <p>Oops! The page you are looking for does not exist. It might have been moved or deleted.</p>
                  <a href="<?php echo site_url('/'); ?>" class="def-btn border-0">Back To Home</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
get_footer();
