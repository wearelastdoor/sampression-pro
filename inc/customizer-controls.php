<?php

/**
 * Contains methods for custom controls for Sampression Theme
 * 
 * @since Sampression 2.0
 */

if( class_exists( 'WP_Customize_Control' ) ) :

    class Sampression_Responsive_Control extends WP_Customize_Control {

        protected function render_content() {
            ?>
            <fieldset>
                <legend>iPhone</legend>
                <ul>
                    <li><a href="#" class="responsive-view" data-width="480px">iPhone 4 - Landscape</a></li>
                    <li><a href="#" class="responsive-view" data-width="320px">iPhone 4 - Portrait</a></li>
                    <li><a href="#" class="responsive-view" data-width="568px">iPhone 5 - Landscape</a></li>
                    <li><a href="#" class="responsive-view" data-width="320px">iPhone 5 - Portrait</a></li>
                    <li><a href="#" class="responsive-view" data-width="667px">iPhone 6 - Landscape</a></li>
                    <li><a href="#" class="responsive-view" data-width="375px">iPhone 6 - Portrait</a></li>
                </ul>
            </fieldset>
            <fieldset>
                <legend>iPad</legend>
                <ul>
                    <li><a href="#" class="responsive-view" data-width="1336px">iPad Pro - Landscape</a></li>
                    <li><a href="#" class="responsive-view" data-width="1024px">iPad Pro - Portrait</a></li>
                    <li><a href="#" class="responsive-view" data-width="1024px">iPad - Landscape</a></li>
                    <li><a href="#" class="responsive-view" data-width="768px">iPad - Portrait</a></li>
                </ul>
            </fieldset>
            <fieldset>
                <legend>Android Phones</legend>
                <ul>
                    <li><a href="#" class="responsive-view" data-width="640px">Landscape</a></li>
                    <li><a href="#" class="responsive-view" data-width="360px">Portrait</a></li>
                </ul>
            </fieldset>
            <fieldset>
                <legend>Android Tablets</legend>
                <ul>
                    <li><a href="#" class="responsive-view" data-width="960px">Landscape</a></li>
                    <li><a href="#" class="responsive-view" data-width="600px">Portrait</a></li>
                </ul>
            </fieldset>

            <fieldset>
                <legend>Desktops</legend>
                <ul>
                    <li><a href="#" class="responsive-view" data-width="1440px">Desktop HD</a></li>
                    <li><a href="#" class="responsive-view" data-width="1024px">Desktop</a></li>
                    <li><a href="#" class="responsive-view" data-width="100%">Full</a></li>
                </ul>
            </fieldset>
            <?php
        }
    }

    class Sampression_CSS_Control extends WP_Customize_Control {

        public $type = 'customcss';

        protected function render_content() {

            ?>
            <label>
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif;
                if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <?php endif; ?>
                <textarea rows="25" <?php $this->link(); ?> style="width: 100%"><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
            <?php
        }
    }

    class Sampression_Categories_Control extends WP_Customize_Control {

        public $type = 'categories';

        protected function render_content() {
            $data = array();
            ?>
            <div class="sampression-cat-lists">
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif;
                if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <?php endif; ?>
                <ul>
                    <?php
                    wp_list_categories(
                        array(
                            'title_li' => '',
                            'walker' => new Sampression_Categories_Walk//( $this->value() )
                        )
                    );
                    ?>
                </ul>
                <?php /* <textarea class="sampression-control-cat" style="width:100%;" <?php $this->link(); ?> rows="20"><?php echo $this->value(); ?></textarea> */ ?>
                <input class="sampression-control-cat" type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
            </div>
            <?php
        }
    }

    class Sampression_Categories_Walk extends Walker_Category {

        public $cats;

        // function __construct( $val ) {
        //     $this->cats = $val;
        // }

        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $depth++;
            $indent = str_repeat("-", $depth);
            $output .= "";//"$indent";
        }

        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $depth++;
            $indent = str_repeat("-", $depth);
            $output .= "";//"$indent";
        }

        public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
            if( $value = get_theme_mod( 'categories_post_display' ) ) {
                parse_str($value[0], $cat_display_count);
                $count_value = $cat_display_count[$category->slug];
            } else {
                $count_value = $category->count;
            }
            $output .= "<li>";
            $indent = str_repeat("- ", $depth);
            $output .= '<input class="cat-checked" id="cat-'.$category->slug.'" type="checkbox" value="'.esc_attr( $category->slug ).'"'.checked( $count_value, 0, false ).'>';
            $output .= '<label for="cat-'.$category->slug.'">'.$indent.esc_html( $category->name ).'</label>';
            $output .= '<input type="number" value="'.$count_value.'" name="'.$category->slug.'" class="sam-number-input" max="'.$category->count.'" min="-1">';
            //$output .= '<input type="number" value="'.$category->count.'" name="'.$category->slug.'" class="sam-number-input" max="'.$category->count.'" min="-1">';
        }

        public function end_el( &$output, $page, $depth = 0, $args = array() ) {
            $output .= "</li>";
        }

    }

    class Sampression_Checkboxes_Control extends WP_Customize_Control {

        public $type = 'checkboxes';

        protected function render_content() {
            if ( empty( $this->choices ) )
                return;

            $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
            ?>
            <div>
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif;
                if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <?php endif; ?>
                <ul>
                    <?php foreach( $this->choices as $value => $label ) { ?>
                        <li>
                            <label>
                                <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?>>
                                <?php echo esc_html( $label ); ?>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
                <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
            </div>
            <?php
        }
    }

    class Sampression_Fontsize_Control extends WP_Customize_Control {
        public $type = 'range';

        public function render_content() {
        ?>
        <label>
            <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif;
            if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>
            <input type="<?php echo esc_attr( $this->type ); ?>" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> data-reset_value="<?php echo esc_attr( $this->setting->default ); ?>" />
            <input type="number" <?php $this->input_attrs(); ?> class="et-pb-range-input" value="<?php echo esc_attr( $this->value() ); ?>" />
            <span class="et_divi_reset_slider"></span>
        </label>
        <?php
        }
    }

endif;