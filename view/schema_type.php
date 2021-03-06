<?php                                                                               
	add_action( 'add_meta_boxes', 'saswp_schema_type_add_meta_box' ) ;
	add_action( 'save_post', 'saswp_schema_type_add_meta_box_save' ) ;
	
        function saswp_schema_type_add_meta_box() {
	add_meta_box(
		'schema_type',
		esc_html__( 'Schema Type', 'ads-for-wp' ),
		'saswp_schema_type_meta_box_callback',
		'saswp',
		'advanced',
		'high'
	);
        }
        function saswp_schema_type_get_meta( $value ) {
            global $post;
            
            $field = get_post_meta( $post->ID, $value, true );
           
            if ( ! empty( $field ) ) {
                    return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
            } else {
                    return false;
            }
      }
        function saswp_schema_type_meta_box_callback( $post) {
                wp_nonce_field( 'saswp_schema_type_nonce', 'saswp_schema_type_nonce' );  
                $style_business_type ='';
                $style_business_name =''; 
                $style_service_name =''; 
                $style_review_name =''; 
                $business_name ='';
                $schema_type ='';
                $business_type ='';
                $business_details ='';
                $custom_logo_id ='';
                $logo = array();
                $service_details = array();
                $review_details = array();
                $product_details = array();
                if($post){
                $schema_type      = esc_sql ( get_post_meta($post->ID, 'schema_type', true)  );                  
                $business_type    = esc_sql ( get_post_meta($post->ID, 'saswp_business_type', true)  ); 
                $business_name    = esc_sql ( get_post_meta($post->ID, 'saswp_business_name', true)  ); 
                $business_details = esc_sql ( get_post_meta($post->ID, 'saswp_local_business_details', true)  ); 
                $service_details  = esc_sql ( get_post_meta($post->ID, 'saswp_service_schema_details', true)  );
                $review_details   = esc_sql ( get_post_meta($post->ID, 'saswp_review_schema_details', true)  );
                $product_details  = esc_sql ( get_post_meta($post->ID, 'saswp_product_schema_details', true)  );
                $audio_details    = esc_sql ( get_post_meta($post->ID, 'saswp_audio_schema_details', true)  );
                $dayoftheweek = get_post_meta($post->ID, 'saswp_dayofweek', true); 
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                if($custom_logo_id){
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );    
                }
                
                if($schema_type != 'local_business'){
                 $style_business_type = 'style="display:none"';
                 $style_business_name = 'style="display:none"';
                }                            
                }   
                        
                                $provider_type = array(
                                     'Airline'                      => 'Airline',
                                     'Corporation'                  => 'Corporation',
                                     'EducationalOrganization'      => 'Educational Organization',
                                     'GovernmentOrganization'       => 'Government Organization',
                                     'LocalBusiness'                => 'Local Business',
                                     'MedicalOrganization'          => 'Medical Organization',  
                                     'NGO'                          => 'NGO', 
                                     'PerformingGroup'              => 'Performing Group', 
                                     'SportsOrganization'           => 'Sports Organization',  
                                );
                                
                                $availability = array(
                                     'InStock'           => 'In Stock',
                                     'OutOfStock'        => 'Out Of Stock',
                                     'Discontinued'      => 'Discontinued',
                                     'PreOrder'          => 'Pre Order',                                     
                                );
                                
                                $item_condition = array(
                                     'NewCondition'              => 'New',
                                     'UsedCondition'             => 'Used',
                                     'RefurbishedCondition'      => 'Refurbished',
                                     'DamagedCondition'          => 'Damaged',                                     
                                );
                                
                                $item_reviewed = array(
                                     'Article'               => 'Article',
                                     'adultentertainment'    => 'Adult Entertainment',
                                     'Blog'                  => 'Blog',
                                     'Book'                  => 'Book',
                                     'casino'                => 'Casino',   
                                     'Diet'                  => 'Diet',
                                     'Episode'               => 'Episode',
                                     'ExercisePlan'          => 'Exercise Plan',  
                                     'Game'                  => 'Game', 
                                     'Movie'                 => 'Movie', 
                                     'MusicPlaylist'         => 'Music Playlist',                                      
                                     'MusicRecording'        => 'MusicRecording',
                                     'Photograph'            => 'Photograph',
                                     'Recipe'                => 'Recipe',
                                     'Restaurant'            => 'Restaurant', 
                                     'Series'                => 'Series',
                                     'SoftwareApplication'   => 'Software Application',
                                     'VisualArtwork'         => 'Visual Artwork',  
                                     'Webpage'               => 'Webpage', 
                                     'WebSite'               => 'WebSite',                                                                                                                                                   
                                );                                                             
                
                                $all_schema_array = array(
                                     'Article'     => 'Article',
                                     'AudioObject' => 'AudioObject',
                                     'Blogposting' => 'Blogposting',
                                     'local_business' => 'Local Business',
                                     'NewsArticle' => 'NewsArticle',
                                     'Product'     => 'Product',
                                     'qanda'       => 'Q&A',   
                                     'Review'      => 'Review',                                     
                                     'Recipe'      => 'Recipe',                                     
                                     'Service'     => 'Service',                                     
                                     'VideoObject' => 'VideoObject',
                                     'WebPage'     => 'WebPage'                                                                
                                 );
                                 $all_business_type = array(
                                    'animalshelter' => 'Animal Shelter',
                                    'automotivebusiness' => 'Automotive Business',
                                    'childcare' => 'ChildCare',
                                    'dentist' => 'Dentist',
                                    'drycleaningorlaundry' => 'Dry Cleaning Or Laundry',
                                    'emergencyservice' => 'Emergency Service',
                                    'employmentagency' => 'Employment Agency',
                                    'entertainmentbusiness' => 'Entertainment Business',
                                    'financialservice' => 'Financial Service',
                                    'foodestablishment' => 'Food Establishment',
                                    'governmentoffice' => 'Government Office',
                                    'healthandbeautybusiness' => 'Health And Beauty Business',
                                    'homeandconstructionbusiness' => 'Home And Construction Business',
                                    'internetcafe' => 'Internet Cafe',
                                    'legalservice' => 'Legal Service',
                                    'library' => 'Library',
                                    'lodgingbusiness' => 'Lodging Business',
                                    'professionalservice' => 'Professional Service',
                                    'radiostation' => 'Radio Station',
                                    'realestateagent' => 'Real Estate Agent',
                                    'recyclingcenter' => 'Recycling Center',
                                    'selfstorage' => 'Self Storage',
                                    'shoppingcenter' => 'Shopping Center',
                                    'sportsactivitylocation' => 'Sports Activity Location',
                                    'store' => 'Store',
                                    'televisionstation' => 'Television Station',
                                    'touristinformationcenter' => 'Tourist Information Center',
                                    'travelagency' => 'Travel Agency',
                                 );
                
                                  $all_automotive_array = array(
                                     'autobodyshop' => 'Auto Body Shop',
                                     'autodealer' => 'Auto Dealer',
                                     'autopartsstore'     => 'Auto Parts Store',
                                     'autorental'     => 'Auto Rental',
                                     'autorepair'      => 'Auto Repair',
                                     'autowash'     => 'Auto Wash',
                                     'gasstation' => 'Gas Station',
                                     'motorcycledealer' => 'Motorcycle Dealer',
                                     'motorcyclerepair' => 'Motorcycle Repair'
                                 );
                                  
                                  $all_emergency_array = array(
                                     'firestation' => 'Fire Station',
                                     'hospital' => 'Hospital',
                                     'policestation'     => 'Police Station',                                    
                                 );
                                  $all_entertainment_array = array(
                                      'adultentertainment' => 'Adult Entertainment',
                                      'amusementpark' => 'Amusement Park',
                                      'artgallery'     => 'Art Gallery',
                                      'casino'     => 'Casino',
                                      'comedyclub'     => 'Comedy Club',
                                      'movietheater'     => 'Movie Theater',
                                      'nightclub'     => 'Night Club',
                                      
                                 );
                                  $all_financial_array = array(
                                      'accountingservice' => 'Accounting Service',
                                      'automatedteller' => 'Automated Teller',
                                      'bankorcredit_union'     => 'Bank Or Credit Union',
                                      'insuranceagency'     => 'Insurance Agency',                                      
                                      
                                 );
                                  
                                  $all_food_establishment_array = array(
                                      'bakery' => 'Bakery',
                                      'barorpub' => 'Bar Or Pub',
                                      'brewery'     => 'Brewery',
                                      'cafeorcoffee_shop'     => 'Cafe Or Coffee Shop', 
                                      'fastfoodrestaurant' => 'Fast Food Restaurant',
                                      'icecreamshop' => 'Ice Cream Shop',
                                      'restaurant'     => 'Restaurant',
                                      'winery'     => 'Winery', 
                                      
                                 );
                                  $all_health_and_beauty_array = array(
                                      'beautysalon' => 'Beauty Salon',
                                      'dayspa' => 'DaySpa',
                                      'hairsalon'     => 'Hair Salon',
                                      'healthclub'     => 'Health Club', 
                                      'nailsalon' => 'Nail Salon',
                                      'tattooparlor' => 'Tattoo Parlor',                                                                          
                                 );
                                  
                                  $all_home_and_construction_array = array(
                                      'electrician' => 'Electrician',
                                      'generalcontractor' => 'General Contractor',
                                      'hvacbusiness'     => 'HVAC Business',
                                      'locksmith'     => 'Locksmith', 
                                      'movingcompany' => 'Moving Company',
                                      'plumber' => 'Plumber',       
                                      'roofingcontractor' => 'Roofing Contractor',       
                                 );
                                  
                                  $all_legal_service_array = array(
                                      'attorney' => 'Attorney',
                                      'notary' => 'Notary',                                            
                                 );
                                  
                                  $all_lodging_array = array(
                                      'bedandbreakfast' => 'Bed And Breakfast',
                                      'campground' => 'Campground',
                                      'hostel' => 'Hostel',
                                      'hotel' => 'Hotel',
                                      'motel' => 'Motel',
                                      'resort' => 'Resort',
                                 );
                                  
                                  $all_sports_activity_location = array(
                                      'bowlingalley' => 'Bowling Alley',
                                      'exercisegym' => 'Exercise Gym',
                                      'golfcourse' => 'Golf Course',
                                      'healthclub' => 'Health Club',
                                      'publicswimming_pool' => 'Public Swimming Pool',
                                      'skiresort' => 'Ski Resort',
                                      'sportsclub' => 'Sports Club',
                                      'stadiumorarena' => 'Stadium Or Arena',
                                      'tenniscomplex' => 'Tennis Complex'
                                 );
                                  $all_store = array(
                                        'autopartsstore'=>'Auto Parts Store',
                                        'bikestore'=>'Bike Store',
                                        'bookstore'=>'Book Store',
                                        'clothingstore'=>'Clothing Store',
                                        'computerstore'=>'Computer Store',
                                        'conveniencestore'=>'Convenience Store',
                                        'departmentstore'=>'Department Store',
                                        'electronicsstore'=>'Electronics Store',
                                        'florist'=>'Florist',
                                        'furniturestore'=>'Furniture Store',
                                        'gardenstore'=>'Garden Store',
                                        'grocerystore'=>'Grocery Store',
                                        'hardwarestore'=>'Hardware Store',
                                        'hobbyshop'=>'Hobby Shop',
                                        'homegoodsstore'=>'HomeGoods Store',
                                        'jewelrystore'=>'Jewelry Store',
                                        'liquorstore'=>'Liquor Store',
                                        'mensclothingstore'=>'Mens Clothing Store',
                                        'mobilephonestore'=>'Mobile Phone Store',
                                        'movierentalstore'=>'Movie Rental Store',
                                        'musicstore'=>'Music Store',
                                        'officeequipmentstore'=>'Office Equipment Store',
                                        'outletstore'=>'Outlet Store',
                                        'pawnshop'=>'Pawn Shop',
                                        'petstore'=>'Pet Store',
                                        'shoestore'=>'Shoe Store',
                                        'sportinggoodsstore'=>'Sporting Goods Store',
                                        'tireshop'=>'Tire Shop',
                                        'toystore'=>'Toy Store',
                                        'wholesalestore'=>'Wholesale Store'
                                 );
                ?>                                               
                <div class="misc-pub-section">
                    <table class="option-table-class saswp-option-table-class">
                        <tr>
                           <td><label for="schema_type"><?php echo esc_html__( 'Schema Type' ,'schema-and-structured-data-for-wp');?></label></td>
                           <td><select class="saswp-schame-type-select" id="schema_type" name="schema_type">
                                <?php
                                  
                                  foreach ($all_schema_array as $key => $value) {
                                    $sel = '';
                                    if($schema_type==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                               <?php if($schema_type == 'qanda') { ?>
                               <span class="saswp-schem-type-note">Note: Currently supported with DW Question & Answer <a target="_blank" href="https://wordpress.org/plugins/dw-question-answer/">Link</a></span>
                               <?php }else{ ?>
                               <span class="saswp-schem-type-note saswp_hide">Note: Currently supported with DW Question & Answer <a target="_blank" href="https://wordpress.org/plugins/dw-question-answer/">Link</a></span>
                               <?php } ?>
                               
                           </td>
                        </tr>    
                        <tr class="saswp-business-type-tr" <?php echo $style_business_type; ?>>
                            <td>
                            <?php echo esc_html__('Business Type', 'schema-and-structured-data-for-wp' ); ?>    
                            </td>
                            <td>
                              <select id="saswp_business_type" name="saswp_business_type">
                                <?php

                                  
                                  foreach ($all_business_type as $key => $value) {
                                    $sel = '';
                                    if($business_type==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>  
                            </td>
                        </tr>
                        <tr class="saswp-automotivebusiness-tr" <?php if(!array_key_exists($business_name, $all_automotive_array)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                            <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                                <select id="saswp_automotive" name="saswp_business_name">
                                <?php

                                  foreach ($all_automotive_array as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                            </td>
                            
                        </tr>
                        <tr class="saswp-emergencyservice-tr" <?php if(!array_key_exists($business_name, $all_emergency_array)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>    
                        <td>
                            <select id="saswp_emergency_service" name="saswp_business_name">
                                <?php

                                  foreach ($all_emergency_array as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>
                        <tr class="saswp-entertainmentbusiness-tr" <?php if(!array_key_exists($business_name, $all_entertainment_array)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>    
                        <td>
                            <select id="saswp_entertainment" name="saswp_business_name">
                                <?php

                                  
                                  foreach ($all_entertainment_array as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>
                        <tr class="saswp-financialservice-tr" <?php if(!array_key_exists($business_name, $all_financial_array)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>    
                        <td>
                            <select id="saswp_financial_service" name="saswp_business_name">
                                <?php

                                  
                                  foreach ($all_financial_array as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>                        
                        <tr class="saswp-foodestablishment-tr" <?php if(!array_key_exists($business_name, $all_food_establishment_array)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>  
                        <td>
                            <select id="saswp_food_establishment" name="saswp_business_name">
                                <?php

                                  foreach ($all_food_establishment_array as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>
                        <tr class="saswp-healthandbeautybusiness-tr" <?php if(!array_key_exists($business_name, $all_health_and_beauty_array)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>   
                        <td>
                            <select id="saswp_health_and_beauty" name="saswp_business_name">
                                <?php

                                  
                                  foreach ($all_health_and_beauty_array as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>                        
                        <tr class="saswp-homeandconstructionbusiness-tr" <?php if(!array_key_exists($business_name, $all_home_and_construction_array)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>
                        <td>
                            <select id="saswp_home_and_construction" name="saswp_business_name">
                                <?php

                                  foreach ($all_home_and_construction_array as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>
                        <tr class="saswp-legalservice-tr" <?php if(!array_key_exists($business_name, $all_legal_service_array)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>
                        <td>
                            <select id="saswp_legal_service" name="saswp_business_name">
                                <?php

                                  foreach ($all_legal_service_array as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>
                        <tr class="saswp-lodgingbusiness-tr" <?php if(!array_key_exists($business_name, $all_lodging_array)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>
                        <td>
                            <select id="saswp_lodging" name="saswp_business_name">
                                <?php

                                  foreach ($all_lodging_array as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>
                        <tr class="saswp-sportsactivitylocation-tr" <?php if(!array_key_exists($business_name, $all_sports_activity_location)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>
                        <td>
                            <select id="saswp_sports_activity_location" name="saswp_business_name">
                                <?php

                                  foreach ($all_sports_activity_location as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>
                        <tr class="saswp-store-tr" <?php if(!array_key_exists($business_name, $all_store)){ echo 'style="display:none;"';}else{ echo $style_business_name;} ?>>
                        <td><?php echo esc_html__('Sub Business Type', 'schema-and-structured-data-for-wp' ); ?></td>    
                        <td>
                            <select id="saswp_store" name="saswp_business_name">
                                <?php

                                  
                                  foreach ($all_store as $key => $value) {
                                    $sel = '';
                                    if($business_name==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                        </td>    
                        </tr>
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Business Name', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input value="<?php if(isset($business_details['local_business_name'])) { echo esc_attr($business_details['local_business_name']); }  ?>" type="text" name="local_business_name" placeholder="<?php echo esc_html__('Business Name', 'schema-and-structured-data-for-wp' ); ?>"></td>
                        </tr>
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Street Address', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input value="<?php if(isset($business_details['local_street_address'])) { echo esc_attr($business_details['local_street_address']); } ?>" type="text" name="local_street_address" placeholder="<?php echo esc_html__('Street Address', 'schema-and-structured-data-for-wp' ); ?>"></td>
                        </tr>
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('City', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input value="<?php if(isset($business_details['local_city'])){ echo esc_attr($business_details['local_city']);} ?>" type="text" name="local_city" placeholder="<?php echo esc_html__('City', 'schema-and-structured-data-for-wp' ); ?>"></td>
                        </tr>
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('State', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input value="<?php if(isset($business_details['local_state'])){echo esc_attr($business_details['local_state']);} ?>" type="text" name="local_state" placeholder="<?php echo esc_html__('State', 'schema-and-structured-data-for-wp' ); ?>"></td>
                        </tr>
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Postal Code', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input value="<?php if(isset($business_details['local_postal_code'])) {echo esc_attr($business_details['local_postal_code']); } ?>" type="text" name="local_postal_code" placeholder="<?php echo esc_html__('Postal Code', 'schema-and-structured-data-for-wp' ); ?>"></td>
                        </tr>
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Phone', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input value="<?php if(isset($business_details['local_phone'])){echo esc_attr($business_details['local_phone']); } ?>" type="text" name="local_phone" placeholder="<?php echo esc_html__('Phone', 'schema-and-structured-data-for-wp' ); ?>"></td>
                        </tr>
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Website', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input value="<?php if(isset($business_details['local_website'])){echo esc_attr($business_details['local_website']); }else{ echo site_url();} ?>" type="text" name="local_website" placeholder="<?php echo esc_html__('Website', 'schema-and-structured-data-for-wp' ); ?>"></td>
                        </tr>
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Image', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td style="display: flex; width: 97%">
                                <input value="<?php if(isset($business_details['local_business_logo'])) { echo esc_url($business_details['local_business_logo']['url']);} else { echo esc_url(saswp_remove_warnings($logo, 0, 'saswp_string')); } ?>" id="local_business_logo" type="text" name="local_business_logo[url]" placeholder="<?php echo esc_html__('Logo', 'schema-and-structured-data-for-wp' ); ?>" readonly="readonly" style="background: #FFF;">
                                <input value="<?php if(isset($business_details['local_business_logo'])) { echo esc_attr($business_details['local_business_logo']['id']);} else { echo esc_attr($custom_logo_id); }?>" data-id="local_business_logo_id" type="hidden" name="local_business_logo[id]">
                                <input value="<?php if(isset($business_details['local_business_logo'])) { echo esc_attr($business_details['local_business_logo']['width']);} else { echo esc_attr(saswp_remove_warnings($logo, 1, 'saswp_string')); } ?>" data-id="local_business_logo_width" type="hidden" name="local_business_logo[width]">
                                <input value="<?php if(isset($business_details['local_business_logo'])) { echo esc_attr($business_details['local_business_logo']['height']);} else { echo esc_attr(saswp_remove_warnings($logo, 2, 'saswp_string')); } ?>" data-id="local_business_logo_height" type="hidden" name="local_business_logo[height]">
                                <input data-id="media" class="button" id="local_business_logo_button" type="button" value="Upload"></td>
                        </tr>
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Operation Days', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>                                
                                <textarea id="saswp_dayofweek" placeholder="Mo-Sa 11:00-14:30 <?="\n"?>Mo-Th 17:00-21:30 <?="\n"?>Fr-Sa 17:00-22:00" rows="5" cols="70" name="saswp_dayofweek"><?php if(isset($dayoftheweek)){echo $dayoftheweek; } ?></textarea>
                                <p>Note: Enter days and time in given format.</p>
                            </td>
                        </tr>
                       
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Price Range', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($business_details['local_price_range'])){echo esc_attr($business_details['local_price_range']); } ?>" type="text" name="local_price_range" placeholder="<?php echo esc_html__('$10-$50 or $$$ ', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        
                        <tr class="saswp-business-text-field-tr" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Aggregate Rating', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                                <input class="saswp-enable-rating-review-local_business" type="checkbox" name="local_enable_rating" value="1" <?php if(isset($business_details['local_enable_rating'])){echo 'checked'; }else{ echo ''; } ?>>
                            </td>
                        </tr>                        
                        <tr class="saswp-business-text-field-tr saswp-rating-review-local_business">
                            <td><?php echo esc_html__('Rating', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($business_details['local_rating'])){echo esc_attr($business_details['local_rating']); } ?>" type="text" name="local_rating" placeholder="<?php echo esc_html__('5.0', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-business-text-field-tr saswp-rating-review-local_business" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Number of Reviews', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($business_details['local_review_count'])){echo esc_attr($business_details['local_review_count']); } ?>" type="text" name="local_review_count" placeholder="<?php echo esc_html__('10', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        <!-- Service Schema type starts here -->
                        
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Name', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($service_details['saswp_service_schema_name'])){echo esc_attr($service_details['saswp_service_schema_name']); } ?>" type="text" name="saswp_service_schema_name" placeholder="<?php echo esc_html__('Name', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Service Type', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                              <input  value="<?php if(isset($service_details['saswp_service_schema_type'])){echo esc_attr($service_details['saswp_service_schema_type']); } ?>" type="text" name="saswp_service_schema_type" placeholder="<?php echo esc_html__('Service Type', 'schema-and-structured-data-for-wp' ); ?>" >
                              <p><?php echo esc_html__('The type of service being offered, e.g. veterans benefits, emergency relief, etc.', 'schema-and-structured-data-for-wp' ); ?></p>
                            </td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Provider Name', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($service_details['saswp_service_schema_provider_name'])){echo esc_attr($service_details['saswp_service_schema_provider_name']); } ?>" type="text" name="saswp_service_schema_provider_name" placeholder="<?php echo esc_html__('Provider Name', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Provider Type', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                            <select name="saswp_service_schema_provider_type">
                                <?php
                                  
                                  foreach ($provider_type as $key => $value) {
                                    $sel = '';
                                    if(saswp_remove_warnings($service_details, 'saswp_service_schema_provider_type', 'saswp_string')==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                                
                            </td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Image', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td style="display: flex; width: 97%">
                                <input value="<?php if(isset($service_details['saswp_service_schema_image'])) { echo esc_url($service_details['saswp_service_schema_image']['url']);} else { echo esc_url(saswp_remove_warnings($logo, 0, 'saswp_string')); } ?>" id="saswp_service_schema_image" type="text" name="saswp_service_schema_image[url]" placeholder="<?php echo esc_html__('Image', 'schema-and-structured-data-for-wp' ); ?>" readonly="readonly" style="background: #FFF;">
                                <input value="<?php if(isset($service_details['saswp_service_schema_image'])) { echo esc_attr($service_details['saswp_service_schema_image']['id']);} else { echo esc_attr($custom_logo_id); }?>" data-id="saswp_service_schema_image_id" type="hidden" name="saswp_service_schema_image[id]">
                                <input value="<?php if(isset($service_details['saswp_service_schema_image'])) { echo esc_attr($service_details['saswp_service_schema_image']['width']);} else { echo esc_attr(saswp_remove_warnings($logo, 1, 'saswp_string')); } ?>" data-id="saswp_service_schema_image_width" type="hidden" name="saswp_service_schema_image[width]">
                                <input value="<?php if(isset($service_details['saswp_service_schema_image'])) { echo esc_attr($service_details['saswp_service_schema_image']['height']);} else { echo esc_attr(saswp_remove_warnings($logo, 2, 'saswp_string')); } ?>" data-id="saswp_service_schema_image_height" type="hidden" name="saswp_service_schema_image[height]">
                                <input data-id="media" class="button" id="saswp_service_schema_image_button" type="button" value="Upload"></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Locality', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($service_details['saswp_service_schema_locality'])){echo esc_attr($service_details['saswp_service_schema_locality']); } ?>" type="text" name="saswp_service_schema_locality" placeholder="<?php echo esc_html__('Locality', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('PostalCode', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($service_details['saswp_service_schema_postal_code'])){echo esc_attr($service_details['saswp_service_schema_postal_code']); } ?>" type="text" name="saswp_service_schema_postal_code" placeholder="<?php echo esc_html__('Postal Code', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Telephone', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($service_details['saswp_service_schema_telephone'])){echo esc_attr($service_details['saswp_service_schema_telephone']); } ?>" type="text" name="saswp_service_schema_telephone" placeholder="<?php echo esc_html__('Telephone', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Price Range', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($service_details['saswp_service_schema_price_range'])){echo esc_attr($service_details['saswp_service_schema_price_range']); } ?>" type="text" name="saswp_service_schema_price_range" placeholder="<?php echo esc_html__('$10-$50 or $$$ ', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Description', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><textarea placeholder="Description" rows="3" cols="70" name="saswp_service_schema_description"><?php if(isset($service_details['saswp_service_schema_description'])){echo esc_attr($service_details['saswp_service_schema_description']); } ?></textarea></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Area Served (City)', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><textarea placeholder="New York, Los Angeles" rows="3" cols="70" name="saswp_service_schema_area_served"><?php if(isset($service_details['saswp_service_schema_area_served'])){echo esc_attr($service_details['saswp_service_schema_area_served']); } ?></textarea><p>Note: Enter all the City name in comma separated</p></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Service Offer', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><textarea placeholder="Apartment light cleaning, Carpet cleaning" rows="3" cols="70" name="saswp_service_schema_service_offer"><?php if(isset($service_details['saswp_service_schema_service_offer'])){echo esc_attr($service_details['saswp_service_schema_service_offer']); } ?></textarea><p>Note: Enter all the service offer in comma separated</p></td>
                        </tr>
                        
                        
                        
                        <tr class="saswp-service-text-field-tr" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Aggregate Rating', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                                <input class="saswp-enable-rating-review-service" type="checkbox" name="saswp_service_schema_enable_rating" value="1" <?php if(isset($service_details['saswp_service_schema_enable_rating'])){echo 'checked'; }else{ echo ''; } ?>>
                            </td>
                        </tr>
                        
                        <tr class="saswp-service-text-field-tr saswp-rating-review-service" <?php echo $style_service_name; ?>>
                            <td><?php echo esc_html__('Rating', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($service_details['saswp_service_schema_rating'])){echo esc_attr($service_details['saswp_service_schema_rating']); } ?>" type="text" name="saswp_service_schema_rating" placeholder="<?php echo esc_html__('5.0', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-service-text-field-tr saswp-rating-review-service" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Number of Reviews', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($service_details['saswp_service_schema_review_count'])){echo esc_attr($service_details['saswp_service_schema_review_count']); } ?>" type="text" name="saswp_service_schema_review_count" placeholder="<?php echo esc_html__('10', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        
                        <!-- Service Schema type ends here -->
                        
                        <!-- Review Schema type starts here -->
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Item Reviewed Type', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                                
                            <select name="saswp_review_schema_item_type">
                                <?php                                  
                                  foreach ($item_reviewed as $key => $value) {
                                    $sel = '';
                                    if(saswp_remove_warnings($review_details, 'saswp_review_schema_item_type', 'saswp_string')==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>                                                                
                            </td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Name', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_name'])){echo esc_attr($review_details['saswp_review_schema_name']); } ?>" type="text" name="saswp_review_schema_name" placeholder="<?php echo esc_html__('Name', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Review Body', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><textarea placeholder="Review Body" rows="3" cols="70" name="saswp_review_schema_description"><?php if(isset($review_details['saswp_review_schema_description'])){echo esc_attr($review_details['saswp_review_schema_description']); } ?></textarea></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Image', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td style="display: flex; width: 97%">
                                <input value="<?php if(isset($review_details['saswp_review_schema_image'])) { echo esc_url($review_details['saswp_review_schema_image']['url']);} else { echo esc_url(saswp_remove_warnings($logo, 0, 'saswp_string')); } ?>" id="saswp_review_schema_image" type="text" name="saswp_review_schema_image[url]" placeholder="<?php echo esc_html__('Image', 'schema-and-structured-data-for-wp' ); ?>" readonly="readonly" style="background: #FFF;">
                                <input value="<?php if(isset($review_details['saswp_review_schema_image'])) { echo esc_attr($review_details['saswp_review_schema_image']['id']);} else { echo esc_attr($custom_logo_id); }?>" data-id="saswp_review_schema_image_id" type="hidden" name="saswp_review_schema_image[id]">
                                <input value="<?php if(isset($review_details['saswp_review_schema_image'])) { echo esc_attr($review_details['saswp_review_schema_image']['width']);} else { echo esc_attr(saswp_remove_warnings($logo, 1, 'saswp_string')); } ?>" data-id="saswp_review_schema_image_width" type="hidden" name="saswp_review_schema_image[width]">
                                <input value="<?php if(isset($review_details['saswp_review_schema_image'])) { echo esc_attr($review_details['saswp_review_schema_image']['height']);} else { echo esc_attr(saswp_remove_warnings($logo, 2, 'saswp_string')); } ?>" data-id="saswp_review_schema_image_height" type="hidden" name="saswp_review_schema_image[height]">
                                <input data-id="media" class="button" id="saswp_review_schema_image_button" type="button" value="Upload"></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Author', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_author'])){echo esc_attr($review_details['saswp_review_schema_author']); } ?>" type="text" name="saswp_review_schema_author" placeholder="<?php echo esc_html__('Author', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>                        
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Price Range', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_price_range'])){echo esc_attr($review_details['saswp_review_schema_price_range']); } ?>" type="text" name="saswp_review_schema_price_range" placeholder="<?php echo esc_html__('Price Range', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Street Address', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_street_address'])){echo esc_attr($review_details['saswp_review_schema_street_address']); } ?>" type="text" name="saswp_review_schema_street_address" placeholder="<?php echo esc_html__('Street Address', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Address Locality', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_locality'])){echo esc_attr($review_details['saswp_review_schema_locality']); } ?>" type="text" name="saswp_review_schema_locality" placeholder="<?php echo esc_html__('Address Locality', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Address Region', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_region'])){echo esc_attr($review_details['saswp_review_schema_region']); } ?>" type="text" name="saswp_review_schema_region" placeholder="<?php echo esc_html__('Address Region', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Postal Code', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_postal_code'])){echo esc_attr($review_details['saswp_review_schema_postal_code']); } ?>" type="text" name="saswp_review_schema_postal_code" placeholder="<?php echo esc_html__('Postal Code', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Address Country', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_country'])){echo esc_attr($review_details['saswp_review_schema_country']); } ?>" type="text" name="saswp_review_schema_country" placeholder="<?php echo esc_html__('Address Country', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Telephone', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_telephone'])){echo esc_attr($review_details['saswp_review_schema_telephone']); } ?>" type="text" name="saswp_review_schema_telephone" placeholder="<?php echo esc_html__('Telephone', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        
                        
                        <tr class="saswp-review-text-field-tr" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Review Rating', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                                <input class="saswp-enable-rating-review-review" type="checkbox" name="saswp_review_schema_enable_rating" value="1" <?php if(isset($review_details['saswp_review_schema_enable_rating'])){echo 'checked'; }else{ echo ''; } ?>>
                            </td>
                        </tr>
                        <tr class="saswp-review-text-field-tr saswp-rating-review-review" <?php echo $style_review_name; ?>>
                            <td><?php echo esc_html__('Rating Value', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_rating'])){echo esc_attr($review_details['saswp_review_schema_rating']); } ?>" type="text" name="saswp_review_schema_rating" placeholder="<?php echo esc_html__('5.0', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-review-text-field-tr saswp-rating-review-review" <?php echo $style_business_type; ?>>
                            <td><?php echo esc_html__('Best Rating', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($review_details['saswp_review_schema_review_count'])){echo esc_attr($review_details['saswp_review_schema_review_count']); } ?>" type="text" name="saswp_review_schema_review_count" placeholder="<?php echo esc_html__('5.0', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        
                        <!-- Review Schema type ends here -->
                        
                        <!-- Product Schema type starts here -->
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Name', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_name'])){echo esc_attr($product_details['saswp_product_schema_name']); } ?>" type="text" name="saswp_product_schema_name" placeholder="<?php echo esc_html__('Name', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Description', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><textarea placeholder="Description" rows="3" cols="70" name="saswp_product_schema_description"><?php if(isset($product_details['saswp_product_schema_description'])){echo esc_attr($product_details['saswp_product_schema_description']); } ?></textarea></td>
                        </tr>
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Image', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td style="display: flex; width: 97%">
                                <input value="<?php if(isset($product_details['saswp_product_schema_image'])) { echo esc_url($product_details['saswp_product_schema_image']['url']);} else { echo esc_url(saswp_remove_warnings($logo, 0, 'saswp_string')); } ?>" id="saswp_product_schema_image" type="text" name="saswp_product_schema_image[url]" placeholder="<?php echo esc_html__('Image', 'schema-and-structured-data-for-wp' ); ?>" readonly="readonly" style="background: #FFF;">
                                <input value="<?php if(isset($product_details['saswp_product_schema_image'])) { echo esc_attr($product_details['saswp_product_schema_image']['id']);} else { echo esc_attr($custom_logo_id); }?>" data-id="saswp_product_schema_image_id" type="hidden" name="saswp_product_schema_image[id]">
                                <input value="<?php if(isset($product_details['saswp_product_schema_image'])) { echo esc_attr($product_details['saswp_product_schema_image']['width']);} else { echo esc_attr(saswp_remove_warnings($logo, 1, 'saswp_string')); } ?>" data-id="saswp_product_schema_image_width" type="hidden" name="saswp_product_schema_image[width]">
                                <input value="<?php if(isset($product_details['saswp_product_schema_image'])) { echo esc_attr($product_details['saswp_product_schema_image']['height']);} else { echo esc_attr(saswp_remove_warnings($logo, 2, 'saswp_string')); } ?>" data-id="saswp_product_schema_image_height" type="hidden" name="saswp_product_schema_image[height]">
                                <input data-id="media" class="button" id="saswp_product_schema_image_button" type="button" value="Upload">
                            </td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Brand Name', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_brand_name'])){echo esc_attr($product_details['saswp_product_schema_brand_name']); } ?>" type="text" name="saswp_product_schema_brand_name" placeholder="<?php echo esc_html__('Brand Name', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Price', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_price'])){echo esc_attr($product_details['saswp_product_schema_price']); } ?>" type="text" name="saswp_product_schema_price" placeholder="<?php echo esc_html__('Eg. 95.00', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Price Valid Until', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input class="saswp-local-schema-datepicker-picker"  value="<?php if(isset($product_details['saswp_product_schema_priceValidUntil'])){echo esc_attr($product_details['saswp_product_schema_priceValidUntil']); } ?>" type="text" name="saswp_product_schema_priceValidUntil"></td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Currency', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_currency'])){echo esc_attr($product_details['saswp_product_schema_currency']); } ?>" type="text" name="saswp_product_schema_currency" placeholder="<?php echo esc_html__('Eg: GBP, RMB, USD', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Availability', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                                <select name="saswp_product_schema_availability">
                                <?php
                                  
                                  foreach ($availability as $key => $value) {
                                    $sel = '';
                                    if(saswp_remove_warnings($product_details, 'saswp_product_schema_availability', 'saswp_string')==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                            </select>
                            </td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Item Condition', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                                <select name="saswp_product_schema_condition">
                                <?php
                                  
                                  foreach ($item_condition as $key => $value) {
                                    $sel = '';
                                    if(saswp_remove_warnings($product_details, 'saswp_product_schema_condition', 'saswp_string')==$key){
                                      $sel = 'selected';
                                    }
                                    echo "<option value='".esc_attr($key)."' ".esc_attr($sel).">".esc_html__($value, 'schema-and-structured-data-for-wp' )."</option>";
                                  }
                                ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('SKU', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_sku'])){echo esc_attr($product_details['saswp_product_schema_sku']); } ?>" type="text" name="saswp_product_schema_sku" ></td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('MPN', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_mpn'])){echo esc_attr($product_details['saswp_product_schema_mpn']); } ?>" type="text" name="saswp_product_schema_mpn" >
                                <span>OR</span>  
                            </td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('ISBN', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_isbn'])){echo esc_attr($product_details['saswp_product_schema_isbn']); } ?>" type="text" name="saswp_product_schema_isbn" >
                                <span>OR</span>  
                            </td>
                        </tr>
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('GTIN8', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_gtin8'])){echo esc_attr($product_details['saswp_product_schema_gtin8']); } ?>" type="text" name="saswp_product_schema_gtin8" >                                
                            </td>
                        </tr>    
                        
                        
                        
                        <tr class="saswp-product-text-field-tr">
                            <td><?php echo esc_html__('Aggregate Rating', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>
                                <input class="saswp-enable-rating-review-product" type="checkbox" name="saswp_product_schema_enable_rating" value="1" <?php if(isset($product_details['saswp_product_schema_enable_rating'])){echo 'checked'; }else{ echo ''; } ?>>
                            </td>
                        </tr>
                        
                        <tr class="saswp-product-text-field-tr saswp-rating-review-product">
                            <td><?php echo esc_html__('Rating', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_rating'])){echo esc_attr($product_details['saswp_product_schema_rating']); } ?>" type="text" name="saswp_product_schema_rating" placeholder="<?php echo esc_html__('5.0', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        <tr class="saswp-product-text-field-tr saswp-rating-review-product">
                            <td><?php echo esc_html__('Number of Reviews', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($product_details['saswp_product_schema_review_count'])){echo esc_attr($product_details['saswp_product_schema_review_count']); } ?>" type="text" name="saswp_product_schema_review_count" placeholder="<?php echo esc_html__('10', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        <!-- Product Schema type ends here -->
                        
                        <!-- AudioObject Schema type starts here -->
                        
                        <tr class="saswp-audio-text-field-tr">
                            <td><?php echo esc_html__('Name', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($audio_details['saswp_audio_schema_name'])){echo esc_attr($audio_details['saswp_audio_schema_name']); } ?>" type="text" name="saswp_audio_schema_name" placeholder="<?php echo esc_html__('Name', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        <tr class="saswp-audio-text-field-tr">
                            <td><?php echo esc_html__('Description', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td>                               
                                <textarea  placeholder="Description" rows="5" cols="70" name="saswp_audio_schema_description"><?php if(isset($audio_details['saswp_audio_schema_description'])){echo $audio_details['saswp_audio_schema_description']; } ?></textarea>
                            </td>
                        </tr>
                        
                        <tr class="saswp-audio-text-field-tr">
                            <td><?php echo esc_html__('Content Url', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($audio_details['saswp_audio_schema_contenturl'])){echo esc_attr($audio_details['saswp_audio_schema_contenturl']); } ?>" type="text" name="saswp_audio_schema_contenturl" placeholder="<?php echo esc_html__('Content Url', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        <tr class="saswp-audio-text-field-tr">
                            <td><?php echo esc_html__('Duration', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($audio_details['saswp_audio_schema_duration'])){echo esc_attr($audio_details['saswp_audio_schema_duration']); } ?>" type="text" name="saswp_audio_schema_duration" placeholder="<?php echo esc_html__('T0M15S', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        <tr class="saswp-audio-text-field-tr">
                            <td><?php echo esc_html__('Encoding Format', 'schema-and-structured-data-for-wp' ); ?></td>
                            <td><input  value="<?php if(isset($audio_details['saswp_audio_schema_encoding_format'])){echo esc_attr($audio_details['saswp_audio_schema_encoding_format']); } ?>" type="text" name="saswp_audio_schema_encoding_format" placeholder="<?php echo esc_html__('audio/mpeg', 'schema-and-structured-data-for-wp' ); ?>" ></td>
                        </tr>
                        
                        <!-- AudioObject Schema type ends here -->
                                                
                        
                    </table>  
                   
                </div>
                    <?php
        }
   
        function saswp_schema_type_add_meta_box_save( $post_id ) {     
            
                if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
                if ( ! isset( $_POST['saswp_schema_type_nonce'] ) || ! wp_verify_nonce( $_POST['saswp_schema_type_nonce'], 'saswp_schema_type_nonce' ) ) return;
                if ( ! current_user_can( 'edit_post', $post_id ) ) return;
                                
                if ( isset( $_POST['schema_type'] ) ){
                        update_post_meta( $post_id, 'schema_type', esc_attr( $_POST['schema_type'] ) );
                }
                                
                if ( isset( $_POST['saswp_business_type'] ) ){
                        update_post_meta( $post_id, 'saswp_business_type', esc_attr( $_POST['saswp_business_type'] ) );
                }else{
                        update_post_meta( $post_id, 'saswp_business_type', '' );
                }
                
                if ( isset( $_POST['saswp_business_name'] ) ){
                        update_post_meta( $post_id, 'saswp_business_name', esc_attr( $_POST['saswp_business_name'] ) );
                }else{
                       update_post_meta( $post_id, 'saswp_business_name', '' );
                }
                
                $local_business_details = array();
                if ( isset( $_POST['local_business_name'] ) ){
                $local_business_details['local_business_name'] = sanitize_text_field($_POST['local_business_name']);        
                }
                if ( isset( $_POST['local_street_address'] ) ){
                $local_business_details['local_street_address'] = sanitize_text_field($_POST['local_street_address']);        
                }
                if ( isset( $_POST['local_city'] ) ){
                $local_business_details['local_city'] = sanitize_text_field($_POST['local_city']);        
                }
                if ( isset( $_POST['local_state'] ) ){
                $local_business_details['local_state'] = sanitize_text_field($_POST['local_state']);        
                }
                if ( isset( $_POST['local_postal_code'] ) ){
                $local_business_details['local_postal_code'] = sanitize_text_field($_POST['local_postal_code']);        
                }
                if ( isset( $_POST['local_phone'] ) ){
                $local_business_details['local_phone'] = sanitize_text_field($_POST['local_phone']);        
                }
                if ( isset( $_POST['local_website'] ) ){
                $local_business_details['local_website'] = esc_url_raw($_POST['local_website']);        
                }
                if ( isset( $_POST['local_business_logo'] ) ){
                 
                $local_business_details['local_business_logo']['id'] = sanitize_text_field($_POST['local_business_logo']['id']);    
                $local_business_details['local_business_logo']['url'] = sanitize_text_field($_POST['local_business_logo']['url']);
                $local_business_details['local_business_logo']['width'] = sanitize_text_field($_POST['local_business_logo']['width']);
                $local_business_details['local_business_logo']['height'] = sanitize_text_field($_POST['local_business_logo']['height']);
                }
                
                if ( isset( $_POST['saswp_dayofweek'] ) ){
                update_post_meta( $post_id, 'saswp_dayofweek', esc_textarea( stripslashes($_POST['saswp_dayofweek'])) );                
                }
                if ( isset( $_POST['local_price_range'] ) ){
                $local_business_details['local_price_range'] = sanitize_text_field($_POST['local_price_range']);        
                }
                
                if ( isset( $_POST['local_enable_rating'] ) ){
                $local_business_details['local_enable_rating'] = sanitize_text_field($_POST['local_enable_rating']);        
                }
                if ( isset( $_POST['local_rating'] ) ){
                $local_business_details['local_rating'] = sanitize_text_field($_POST['local_rating']);        
                }
                if ( isset( $_POST['local_review_count'] ) ){
                $local_business_details['local_review_count'] = sanitize_text_field($_POST['local_review_count']);        
                }
                
                              
                update_post_meta( $post_id, 'saswp_local_business_details', $local_business_details );
                
                //Service schema details starts here
                $service_schema_details = array();
                $review_schema_details = array();
                $product_schema_details = array();
                $audio_schema_details = array();
                $schema_type = sanitize_text_field($_POST['schema_type']);               
               
                if($schema_type =='Service'){
                    if ( isset( $_POST['saswp_service_schema_name'] ) ){
                     $service_schema_details['saswp_service_schema_name'] = sanitize_text_field($_POST['saswp_service_schema_name']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_type'] ) ){
                     $service_schema_details['saswp_service_schema_type'] = sanitize_text_field($_POST['saswp_service_schema_type']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_provider_name'] ) ){
                     $service_schema_details['saswp_service_schema_provider_name'] = sanitize_text_field($_POST['saswp_service_schema_provider_name']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_provider_type'] ) ){
                     $service_schema_details['saswp_service_schema_provider_type'] = sanitize_text_field($_POST['saswp_service_schema_provider_type']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_image'] ) ){
                    $service_schema_details['saswp_service_schema_image']['id'] = sanitize_text_field($_POST['saswp_service_schema_image']['id']);    
                    $service_schema_details['saswp_service_schema_image']['url'] = esc_url_raw($_POST['saswp_service_schema_image']['url']);
                    $service_schema_details['saswp_service_schema_image']['width'] = sanitize_text_field($_POST['saswp_service_schema_image']['width']);
                    $service_schema_details['saswp_service_schema_image']['height'] = sanitize_text_field($_POST['saswp_service_schema_image']['height']);
                   }
                   if ( isset( $_POST['saswp_service_schema_locality'] ) ){
                     $service_schema_details['saswp_service_schema_locality'] = sanitize_text_field($_POST['saswp_service_schema_locality']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_postal_code'] ) ){
                     $service_schema_details['saswp_service_schema_postal_code'] = sanitize_text_field($_POST['saswp_service_schema_postal_code']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_telephone'] ) ){
                     $service_schema_details['saswp_service_schema_telephone'] = sanitize_text_field($_POST['saswp_service_schema_telephone']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_price_range'] ) ){
                     $service_schema_details['saswp_service_schema_price_range'] = sanitize_text_field($_POST['saswp_service_schema_price_range']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_description'] ) ){
                     $service_schema_details['saswp_service_schema_description'] = sanitize_textarea_field($_POST['saswp_service_schema_description']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_area_served'] ) ){
                     $service_schema_details['saswp_service_schema_area_served'] = sanitize_textarea_field($_POST['saswp_service_schema_area_served']);        
                   }
                   if ( isset( $_POST['saswp_service_schema_service_offer'] ) ){
                     $service_schema_details['saswp_service_schema_service_offer'] = sanitize_textarea_field($_POST['saswp_service_schema_service_offer']);        
                   } 
                   
                   if ( isset( $_POST['saswp_service_schema_enable_rating'] ) ){
                    $service_schema_details['saswp_service_schema_enable_rating'] = sanitize_text_field($_POST['saswp_service_schema_enable_rating']);        
                    }
                    if ( isset( $_POST['saswp_service_schema_rating'] ) ){
                    $service_schema_details['saswp_service_schema_rating'] = sanitize_text_field($_POST['saswp_service_schema_rating']);        
                    }
                    if ( isset( $_POST['saswp_service_schema_review_count'] ) ){
                    $service_schema_details['saswp_service_schema_review_count'] = sanitize_text_field($_POST['saswp_service_schema_review_count']);        
                    }                                      
                    update_post_meta( $post_id, 'saswp_service_schema_details', $service_schema_details );
                  }
                
                
                if($schema_type =='Review'){
                    if ( isset( $_POST['saswp_review_schema_item_type'] ) ){
                     $review_schema_details['saswp_review_schema_item_type'] = sanitize_text_field($_POST['saswp_review_schema_item_type']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_name'] ) ){
                     $review_schema_details['saswp_review_schema_name'] = sanitize_text_field($_POST['saswp_review_schema_name']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_description'] ) ){
                     $review_schema_details['saswp_review_schema_description'] = sanitize_textarea_field($_POST['saswp_review_schema_description']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_image'] ) ){
                    $review_schema_details['saswp_review_schema_image']['id'] = sanitize_text_field($_POST['saswp_review_schema_image']['id']);    
                    $review_schema_details['saswp_review_schema_image']['url'] = esc_url_raw($_POST['saswp_review_schema_image']['url']);
                    $review_schema_details['saswp_review_schema_image']['width'] = sanitize_text_field($_POST['saswp_review_schema_image']['width']);
                    $review_schema_details['saswp_review_schema_image']['height'] = sanitize_text_field($_POST['saswp_review_schema_image']['height']);
                   }
                   if ( isset( $_POST['saswp_review_schema_author'] ) ){
                     $review_schema_details['saswp_review_schema_author'] = sanitize_text_field($_POST['saswp_review_schema_author']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_price_range'] ) ){
                     $review_schema_details['saswp_review_schema_price_range'] = sanitize_text_field($_POST['saswp_review_schema_price_range']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_street_address'] ) ){
                     $review_schema_details['saswp_review_schema_street_address'] = sanitize_text_field($_POST['saswp_review_schema_street_address']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_locality'] ) ){
                     $review_schema_details['saswp_review_schema_locality'] = sanitize_text_field($_POST['saswp_review_schema_locality']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_region'] ) ){
                     $review_schema_details['saswp_review_schema_region'] = sanitize_text_field($_POST['saswp_review_schema_region']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_postal_code'] ) ){
                     $review_schema_details['saswp_review_schema_postal_code'] = sanitize_text_field($_POST['saswp_review_schema_postal_code']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_country'] ) ){
                     $review_schema_details['saswp_review_schema_country'] = sanitize_text_field($_POST['saswp_review_schema_country']);        
                   }
                   if ( isset( $_POST['saswp_review_schema_telephone'] ) ){
                     $review_schema_details['saswp_review_schema_telephone'] = sanitize_text_field($_POST['saswp_review_schema_telephone']);        
                   }   
                   
                   if ( isset( $_POST['saswp_review_schema_enable_rating'] ) ){
                    $review_schema_details['saswp_review_schema_enable_rating'] = sanitize_text_field($_POST['saswp_review_schema_enable_rating']);        
                    }
                    if ( isset( $_POST['saswp_review_schema_rating'] ) ){
                    $review_schema_details['saswp_review_schema_rating'] = sanitize_text_field($_POST['saswp_review_schema_rating']);        
                    }
                    if ( isset( $_POST['saswp_review_schema_review_count'] ) ){
                    $review_schema_details['saswp_review_schema_review_count'] = sanitize_text_field($_POST['saswp_review_schema_review_count']);        
                    }
                   
                   update_post_meta( $post_id, 'saswp_review_schema_details', $review_schema_details );
                }

                if($schema_type =='Product'){
                    
                   if ( isset( $_POST['saswp_product_schema_name'] ) ){
                     $product_schema_details['saswp_product_schema_name'] = sanitize_text_field($_POST['saswp_product_schema_name']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_description'] ) ){
                     $product_schema_details['saswp_product_schema_description'] = sanitize_textarea_field($_POST['saswp_product_schema_description']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_image'] ) ){
                    $product_schema_details['saswp_product_schema_image']['id'] = sanitize_text_field($_POST['saswp_product_schema_image']['id']);    
                    $product_schema_details['saswp_product_schema_image']['url'] = esc_url_raw($_POST['saswp_product_schema_image']['url']);
                    $product_schema_details['saswp_product_schema_image']['width'] = sanitize_text_field($_POST['saswp_product_schema_image']['width']);
                    $product_schema_details['saswp_product_schema_image']['height'] = sanitize_text_field($_POST['saswp_product_schema_image']['height']);
                   }
                   
                   if ( isset( $_POST['saswp_product_schema_brand_name'] ) ){
                     $product_schema_details['saswp_product_schema_brand_name'] = sanitize_text_field($_POST['saswp_product_schema_brand_name']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_price'] ) ){
                     $product_schema_details['saswp_product_schema_price'] = sanitize_text_field($_POST['saswp_product_schema_price']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_currency'] ) ){
                     $product_schema_details['saswp_product_schema_currency'] = sanitize_text_field($_POST['saswp_product_schema_currency']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_availability'] ) ){
                     $product_schema_details['saswp_product_schema_availability'] = sanitize_text_field($_POST['saswp_product_schema_availability']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_condition'] ) ){
                     $product_schema_details['saswp_product_schema_condition'] = sanitize_text_field($_POST['saswp_product_schema_condition']);        
                   }
                   
                   
                   if ( isset( $_POST['saswp_product_schema_sku'] ) ){
                     $product_schema_details['saswp_product_schema_sku'] = sanitize_text_field($_POST['saswp_product_schema_sku']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_mpn'] ) ){
                     $product_schema_details['saswp_product_schema_mpn'] = sanitize_text_field($_POST['saswp_product_schema_mpn']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_isbn'] ) ){
                     $product_schema_details['saswp_product_schema_isbn'] = sanitize_text_field($_POST['saswp_product_schema_isbn']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_gtin8'] ) ){
                     $product_schema_details['saswp_product_schema_gtin8'] = sanitize_text_field($_POST['saswp_product_schema_gtin8']);        
                   }
                   if ( isset( $_POST['saswp_product_schema_priceValidUntil'] ) ){
                     $product_schema_details['saswp_product_schema_priceValidUntil'] = sanitize_text_field($_POST['saswp_product_schema_priceValidUntil']);        
                   }
                   
                    if ( isset( $_POST['saswp_product_schema_enable_rating'] ) ){
                    $product_schema_details['saswp_product_schema_enable_rating'] = sanitize_text_field($_POST['saswp_product_schema_enable_rating']);        
                    }
                    if ( isset( $_POST['saswp_product_schema_rating'] ) ){
                    $product_schema_details['saswp_product_schema_rating'] = sanitize_text_field($_POST['saswp_product_schema_rating']);        
                    }
                    if ( isset( $_POST['saswp_product_schema_review_count'] ) ){
                    $product_schema_details['saswp_product_schema_review_count'] = sanitize_text_field($_POST['saswp_product_schema_review_count']);        
                    }
                   
                   update_post_meta( $post_id, 'saswp_product_schema_details', $product_schema_details );
                }
                
                if($schema_type =='AudioObject'){
                    
                     if ( isset( $_POST['saswp_audio_schema_name'] ) ){
                      $audio_schema_details['saswp_audio_schema_name'] = sanitize_text_field($_POST['saswp_audio_schema_name']);        
                    }
                    if ( isset( $_POST['saswp_audio_schema_description'] ) ){
                      $audio_schema_details['saswp_audio_schema_description'] = sanitize_textarea_field($_POST['saswp_audio_schema_description']);        
                    }
                    if ( isset( $_POST['saswp_audio_schema_contenturl'] ) ){
                      $audio_schema_details['saswp_audio_schema_contenturl'] = esc_url_raw($_POST['saswp_audio_schema_contenturl']);        
                    }
                    if ( isset( $_POST['saswp_audio_schema_duration'] ) ){
                      $audio_schema_details['saswp_audio_schema_duration'] = sanitize_text_field($_POST['saswp_audio_schema_duration']);        
                    }
                    if ( isset( $_POST['saswp_audio_schema_encoding_format'] ) ){
                      $audio_schema_details['saswp_audio_schema_encoding_format'] = sanitize_text_field($_POST['saswp_audio_schema_encoding_format']);        
                    }
                   
                   update_post_meta( $post_id, 'saswp_audio_schema_details', $audio_schema_details );
                    
                    
                }
                //Service schema details ends here
                
                              
        }           


