<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package wptemplate-gios-v1
 */

// TODO move this
$mimeTypes = array(
	'4gp'       => 'video/3gp',
	'avi'       => 'video/x-msvideo',
	'asf'       => 'video/x-ms-asf',
	'asr'       => 'video/x-ms-asf',
	'asx'       => 'video/x-ms-asf',
	'lsf'       => 'video/x-la-asf',
	'lsx'       => 'video/x-la-asf',
	'mov'       => 'video/quicktime',
  'movie'     => 'video/x-sgi-movie',
  'mp2'       => 'video/mpeg',
  'mp4'       => 'video/mp4',
  'mpa'       => 'video/mpeg',
  'mpe'       => 'video/mpeg',
  'mpeg'      => 'video/mpeg',
  'mpg'       => 'video/mpeg',
  'mpv2'      => 'video/mpeg',
  'ogv'       => 'video/ogg',
  'qt'        => 'video/quicktime',
  'webm'      => 'video/webm',
);

get_header(); 

$customFields = get_post_custom();
?>
<div id="main-wrapper" class="clearfix"><div id="main" class="clearfix">
  <div class="page clearfix">
  	<div class="content">
 		</div>
	</div>

	<?php
    if ( array_key_exists( 'page_feature_title', $customFields ) )
      $title = $customFields['page_feature_title'][0];

    if ( array_key_exists( 'page_feature_image', $customFields ) ) {
    	$count = count( $customFields['page_feature_image'] );

    	if ( $count == 0 ) {
     	  $image = $customFields['page_feature_image'][0];
    	} else {
    		$index = rand( 0, $count - 1 );
    		$image = $customFields['page_feature_image'][$index];
    	}
    }
    if ( array_key_exists( 'page_feature_video', $customFields ) ) {
    	$video = [];
    	foreach ( $customFields['page_feature_video'] as $_ => $value ) {
    		$video[] = $value;
    	}
    }
    if ( array_key_exists( 'page_feature_description', $customFields ) )
      $description = $customFields['page_feature_description'][0];

    if ( isset( $title ) || 
         isset( $image ) || 
         isset( $video ) || 
         isset( $description ) ):
  ?>
	<div id="content" class="column ">
    <div class="region region-content">
    	<div id="block-system-main" class="block block-system">
				<div class="content">
    			<div class="panel-display fdt-home clearfix  " id="page-page">
    				<?php
    					$sectionStart = '<section class="hero hero-bg-img hero-action-call section %2$s" style="%1$s">';

    					// Add the video class if we have it
    					if ( isset( $video ) ) {
    						$sectionStart = sprintf( $sectionStart, '%1$s', 'hero-video' );
    					} else {
    						$sectionStart = sprintf( $sectionStart, '%1$s', '' );
    					}

    					if ( isset( $image ) ) {
    						$sectionStart = sprintf( $sectionStart, 'background-image:url(' . $image . ')' );
    					} else {
    						$sectionStart = sprintf( $sectionStart, '' );
    					}

    					
    					echo $sectionStart;
    				?>
							<?php
								if ( isset($video) ) {
									$videoContainer = '<video width="100%2$s" height="auto" autoplay muted="true" loop>%1$s</video>';
									$videoPart = '<source src="%1$s" type="%2$s"/>';
									$parts = '';

									foreach ( $video as $_ => $value ) {
										$info     = pathinfo( $value );
										$ext      = $info['extension'];
										$mimeType = isset( $mimeTypes[$ext] ) ? $mimeTypes[$ext] : 'application/octet-stream';
							
										$parts .= sprintf( $videoPart, $value, $mimeType );
									}

									echo sprintf( $videoContainer, $parts, '%' );
								}
							?>						
    					<div class="container">
					      <div class="fdt-home-container fdt-home-column-content clearfix  panel-panel row-fluid container">
				          <div class="fdt-home-column-content-region fdt-home-row panel-panel span12">
			              <div class="panel-pane pane-fieldable-panels-pane pane-fpid-12 pane-bundle-text">
       						 		<?php
       						 			if ( isset ( $title ) ) :
       						 		?>
       						 		<h2 class="pane-title"><?php echo $title; ?></h2>
    									<?php
    										endif;
    									?>

    									<?php
    									  if ( isset ( $description ) ) :
    									?>
											<div class="pane-content">
  											<div class="fieldable-panels-pane">
  												<div class="field field-name-field-basic-text-text field-type-text-long field-label-hidden">
  													<div class="field-items">
  														<div class="field-item even">
  															<p><?php echo $description; ?></p>
															</div>
														</div>
													</div>
												</div>
											</div><!-- /.pane-content -->

											<?php
												endif;
											?>

										</div>
    							</div>
      					</div>
      				</div>
      			</section>
      		</div>
      	</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>


<div id="content" class="site-content">
	<main id="main" class="site-main" role="main">
    <?php 
      while ( have_posts() ) {
        the_post();
        get_template_part( 'content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
      } // end of the loop. 
    ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php 
  get_footer();
