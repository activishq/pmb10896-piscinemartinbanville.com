<?php

global $cl_redata;
do_action('codeless_excecute_query_var_action','loop-single_portfolio_bottom');

?>

<div class="container">
    

    <?php if($cl_redata['single_portfolio_content_position_container'] != 'bottom'): ?>
    <div class="row-fluid">
            
        <?php if($cl_redata['single_portfolio_content_position_container'] == 'left'): ?>
            <div class="span3">
                <div class="description">
                    <h4><?php _e('Project Description', 'codeless') ?></h4>
                    <?php the_content(); ?>
                </div>
                <div class="details">
                    <h4><?php _e('Project Details', 'codeless') ?></h4>

                    <ul class="info">
                        <?php if(!empty($cl_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($cl_redata['single_portfolio_custom_params']); $i++): ?>
                            <?php if(isset($cl_redata['single_portfolio_custom_fields'][$i]) && !empty($cl_redata['single_portfolio_custom_fields'][$i]) ): ?>
                                <li><span class="title"><?php echo esc_attr($cl_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($cl_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
                            <?php endif; ?>
                        <?php endfor;  endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?> 

        <div class="span9">
            <div class="media">
                
                <?php if($cl_redata['single_portfolio_media'] == 'featured'): ?>
                    <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>" alt="">
                <?php endif; ?>
                <?php 
                    if($cl_redata['single_portfolio_media'] == 'slideshow'): 
                        $slider = new codeless_slideshow(get_the_ID(), 'flexslider');
                            $slider->slides = $cl_redata['single_portfolio_gallery'];
                            $slider->slide_number = count($cl_redata['single_portfolio_gallery']);
                            if($slider && $slider->slide_number > 0){  
                                $slider->img_size = '';
                                $sliderHtml = $slider->render_slideshow();
                                echo $sliderHtml;
                            }
                    endif; 
                ?>
                <?php 
                    if($cl_redata['single_portfolio_media'] == 'video'){
                            $video = ""; 

                            if(codeless_backend_is_file( $cl_redata['single_portfolio_video'], 'html5video')){

                                $video = codeless_html5_video_embed($cl_redata['single_portfolio_video']);

                            }
                            else if(strpos($cl_redata['single_portfolio_video'],'<iframe') !== false)
                            {
                                $video = $cl_redata['single_portfolio_video'];
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($cl_redata['single_portfolio_video'])."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url($cl_redata['single_portfolio_video']).'"></iframe>';
                            } 

                            echo $video;               
                    }
                ?>
            </div>
        </div>

        <?php if($cl_redata['single_portfolio_content_position_container'] == 'right'): ?>
            <div class="span3">
				<?php 
				$getPortCateArr = get_the_terms( get_the_ID(), 'portfolio_entries' );
				$catName = '';	
				foreach ($getPortCateArr as $value){
					$catName = $value->slug;
				}
				if($catName == "thermopompes" || $catName == "systeme-au-sel" || $catName == "water-heat-pumps" || $catName == "salt-purification-system"){ ?>	
				
					<div class="description">
						<h4><?php echo __('Project Details') ?></h4>
						<?php the_content(); ?>
					</div>
								
				<?php } 
				else { ?>
				
					<div class="description">
						<h4><?php _e('Project Details', 'codeless') ?></h4>
						<?php the_content(); ?>
					</div>
					<div class="details">
						<!-- <h4><?php _e('Détails du produit', 'codeless') ?></h4>					 -->
						<ul class="info">
							<?php if(!empty($cl_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($cl_redata['single_portfolio_custom_params']); $i++): ?>
								<?php if(isset($cl_redata['single_portfolio_custom_fields'][$i]) && !empty($cl_redata['single_portfolio_custom_fields'][$i]) ): ?>
									<li><span class="title"><?php echo esc_attr($cl_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($cl_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
								<?php endif; ?>
							<?php endfor;  endif; ?>
						</ul>
					</div>
				
				<?php } ?>               
            </div>
        <?php endif; ?> 
    </div>
    <?php endif; ?>

    <?php if($cl_redata['single_portfolio_content_position_container'] == 'bottom'): ?>
    <div class="media">
        <?php if($cl_redata['single_portfolio_media'] == 'featured'): ?>
            <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>" alt="">
        <?php endif; ?>
        <?php 
            if($cl_redata['single_portfolio_media'] == 'slideshow'): 
                $slider = new codeless_slideshow(get_the_ID(), 'flexslider');
                    $slider->slides = $cl_redata['single_portfolio_gallery'];
                    $slider->slide_number = count($cl_redata['single_portfolio_gallery']);
                    if($slider && $slider->slide_number > 0){  
                        $slider->img_size = 'blog';
                        $sliderHtml = $slider->render_slideshow();
                        echo $sliderHtml;
                    }
            endif; 
        ?>
        <?php 
                    if($cl_redata['single_portfolio_media'] == 'video'){
                            $video = ""; 

                            if(codeless_backend_is_file( $cl_redata['single_portfolio_video'], 'html5video')){

                                $video = codeless_html5_video_embed($cl_redata['single_portfolio_video']);

                            }
                            else if(strpos($cl_redata['single_portfolio_video'],'<iframe') !== false)
                            {
                                $video = $cl_redata['single_portfolio_video'];
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($cl_redata['single_portfolio_video'])."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url($cl_redata['single_portfolio_video']).'"></iframe>';
                            } 

                            echo $video;               
                    }
        ?>

    </div>
    <div class="row-fluid content"> 
        <div class="span9">
            <h4><?php _e('Project Description', 'codeless') ?></h4>
            <?php the_content(); ?>
        </div>
        <div class="span3">
            <h4><?php _e('Project Details', 'codeless') ?></h4>

            <ul class="info">
                <?php if(!empty($cl_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($cl_redata['single_portfolio_custom_params']); $i++): ?>
                    <?php if(isset($cl_redata['single_portfolio_custom_fields'][$i]) && !empty($cl_redata['single_portfolio_custom_fields'][$i]) ): ?>
                        <li><span class="title"><?php echo esc_attr($cl_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($cl_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
                    <?php endif; ?>
                <?php endfor;  endif; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>