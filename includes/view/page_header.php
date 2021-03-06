<?php
    global $cl_redata;

    $id = codeless_get_post_id();
    $replaced = array();
    if((int) $id != 0)
        $replaced = redux_post_meta('cl_redata',(int) $id);
    if(!empty($replaced))
        foreach($replaced as $key => $value){
            $cl_redata[$key] = $value;
        }

    $title = get_the_title($id);
    if(is_search())
        $title = __('Search Result');
    if(is_404())
        $title = __('404 Not Found');
    $page_parents = codeless_page_parents();
    $extra_class = '';

    if($cl_redata['page_header_bool']):   
        $extra_class .= $cl_redata['page_header_style'];

    if(isset($cl_redata['page_header_background']['background-image']) && $cl_redata['page_header_background']['background-image'] != '')
        $extra_class .= ' without_shadow';

    if(isset($cl_redata['page_header_background']['background-attachment']) && $cl_redata['page_header_background']['background-attachment'] != 'fixed')
        $extra_class .= ' no_parallax'; 

    if($cl_redata['subtitle_bool'])
        $extra_class .= ' with_subtitle'; 

    if($cl_redata['page_header_design_style'] == 'padd')
        $extra_class .= ' with_padding_style';
    ?>

    <!-- Page Head -->
    <div class="header_page <?php echo esc_attr($extra_class) ?>">
             <?php if(isset($cl_redata['page_header_background']['background-image']) && $cl_redata['page_header_background']['background-image'] != '' && isset($cl_redata['page_header_background']['background-color']) && $cl_redata['page_header_background']['background-color'] != ''): ?>
                <?php $rgb_color = codeless_hexToRgb($cl_redata['page_header_background']['background-color']);  ?>
                <div class="overlay" style="background:rgba(<?php echo $rgb_color['r'] ?>, <?php echo $rgb_color['g'] ?>, <?php echo $rgb_color['b'] ?>, 0.75"></div>
             <?php endif; ?> 
             <div class="container">
                    
                    <?php if($cl_redata['subtitle_bool']): ?>
                    <div class="titles">
                    <?php endif; ?>

                        <h1><?php echo esc_html($title)?></h1> 
                        <span class="divider"></span>

                        <?php if($cl_redata['subtitle_bool']): ?>
                            <h3><?php echo esc_html($cl_redata['subtitle']) ?></h3>
                        <?php endif; ?>

                    <?php if($cl_redata['subtitle_bool']): ?>
                    </div>
                    <?php endif; ?>

                    <?php if($cl_redata['page_header_style'] == 'normal'): ?>
                    <div class="breadcrumbss">
                        
                        <ul class="page_parents pull-right">
							<li><?php echo _e('You are here'); ?>: </li>
							<?php 
							$the_id 	= get_the_ID();	
							$item_categories = get_the_terms( $the_id, 'portfolio_entries' );
							if($item_categories){								
								$currect_cate = "";
								foreach ($item_categories as $value){
									$currect_cate=$value->name;
								}
								?>
								<li class="home"><a href="<?php echo esc_url( home_url( '/products' ) ); ?>"><?php echo $currect_cate; ?></a></li>
								<li class="active"><a href="<?php echo esc_url(get_permalink()) ?>"><?php echo esc_html($title) ?></a></li>
							<?php } 
							else {
							?>                            
								<li class="home"><a href="<?php echo esc_url(home_url()) ?>"><?php echo __('Home'); ?></a></li>
								
								<?php for($i = count($page_parents) - 1; $i >= 0; $i-- ){ ?>

								<li><a href="<?php echo esc_url(get_permalink($page_parents[$i])) ?>"><?php echo esc_html(get_the_title($page_parents[$i])) ?> </a></li>

								<?php }  ?>
								<li class="active"><a href="<?php echo esc_url(get_permalink()) ?>"><?php echo esc_html($title) ?></a></li>
							<?php } ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            
    </div> 
   
    
    <?php endif; ?>