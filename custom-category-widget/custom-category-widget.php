<?php
/*
Plugin Name: Custom Category Widget
Description: Displays latest posts from a selected category with editable title, category, and number of posts.
Version: 1.1
Author: Mayank Padhi
*/


// Ensure Widgets menu appears (even in block-based themes)
add_filter('use_widgets_block_editor', '__return_false');

// Register a custom sidebar to use in Appearance > Widgets
add_action('widgets_init', function () {
    register_sidebar(array(
        'name'          => __('Custom Sidebar', 'ccw'),
        'id'            => 'ccw-sidebar',
        'description'   => __('Sidebar for custom category widget.', 'ccw'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
});




// Register the widget
add_action('widgets_init', function () {
    register_widget('CCW_Latest_Posts_Widget');
});

// Widget Class
class CCW_Latest_Posts_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'ccw_latest_posts_widget',
            __('Latest Posts from Category', 'ccw'),
            ['description' => __('Displays latest posts from a selected category.', 'ccw')]
        );
    }

    public function widget($args, $instance) {
        $title     = apply_filters('widget_title', $instance['title'] ?? 'Latest Posts');
        $category  = sanitize_text_field($instance['category'] ?? '');
        $num_posts = absint($instance['number_of_posts'] ?? 5);

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        $query = new WP_Query([
            'category_name'  => $category,
            'posts_per_page' => $num_posts,
            'post_status'    => 'publish'
        ]);

        if ($query->have_posts()) {
            echo '<ul>';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<li><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo '<p>No posts found.</p>';
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title     = $instance['title'] ?? 'Latest Posts';
        $category  = $instance['category'] ?? '';
        $num_posts = $instance['number_of_posts'] ?? 5;

        $categories = get_categories(['hide_empty' => false]);
        ?>
        <p>
            <label for="<?= esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" id="<?= esc_attr($this->get_field_id('title')); ?>"
                   name="<?= esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?= esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?= esc_attr($this->get_field_id('number_of_posts')); ?>">Number of Posts:</label>
            <input class="widefat" id="<?= esc_attr($this->get_field_id('number_of_posts')); ?>"
                   name="<?= esc_attr($this->get_field_name('number_of_posts')); ?>" type="number"
                   value="<?= esc_attr($num_posts); ?>">
        </p>
        <p>
            <label for="<?= esc_attr($this->get_field_id('category')); ?>">Select Category:</label>
            <select class="widefat" id="<?= esc_attr($this->get_field_id('category')); ?>"
                    name="<?= esc_attr($this->get_field_name('category')); ?>">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= esc_attr($cat->slug); ?>"
                            <?= selected($category, $cat->slug, false); ?>>
                        <?= esc_html($cat->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        return [
            'title'            => sanitize_text_field($new_instance['title']),
            'number_of_posts'  => absint($new_instance['number_of_posts']),
            'category'         => sanitize_text_field($new_instance['category']),
        ];
    }
}
