<?php

// Exit if accessed directly
\defined('ABSPATH') || exit;

/**
 * Register custom post types and related meta.
 */

add_action('init', 'bootscore_register_service_post_type');
/**
 * Registers the "Богослужение" custom post type.
 *
 * @return void
 */
function bootscore_register_service_post_type() {
    $labels = [
        'name'                  => __('Богослужения', 'bootscore'),
        'singular_name'         => __('Богослужение', 'bootscore'),
        'menu_name'             => __('Богослужения', 'bootscore'),
        'name_admin_bar'        => __('Богослужение', 'bootscore'),
        'add_new'               => __('Добавить новое', 'bootscore'),
        'add_new_item'          => __('Добавить богослужение', 'bootscore'),
        'new_item'              => __('Новое богослужение', 'bootscore'),
        'edit_item'             => __('Редактировать богослужение', 'bootscore'),
        'view_item'             => __('Просмотреть богослужение', 'bootscore'),
        'all_items'             => __('Все богослужения', 'bootscore'),
        'search_items'          => __('Искать богослужения', 'bootscore'),
        'parent_item_colon'     => __('Родительское богослужение:', 'bootscore'),
        'not_found'             => __('Богослужений не найдено.', 'bootscore'),
        'not_found_in_trash'    => __('В корзине богослужений не найдено.', 'bootscore'),
        'featured_image'        => __('Изображение богослужения', 'bootscore'),
        'set_featured_image'    => __('Задать изображение богослужения', 'bootscore'),
        'remove_featured_image' => __('Удалить изображение богослужения', 'bootscore'),
        'use_featured_image'    => __('Использовать как изображение богослужения', 'bootscore'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_in_rest'       => true,
        'rewrite'            => [
            'slug'       => 'bogosluzhenie',
            'with_front' => false,
        ],
        'menu_icon'          => 'dashicons-groups',
        'supports'           => ['title', 'editor', 'excerpt', 'thumbnail'],
    ];

    register_post_type('service', $args);
}

add_action('init', 'bootscore_register_service_meta');
/**
 * Registers date and time meta fields for богослужение posts.
 *
 * @return void
 */
function bootscore_register_service_meta() {
    $meta_args = [
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'bootscore_service_meta_cap_check',
    ];

    register_post_meta('service', 'service_date', $meta_args);
    register_post_meta('service', 'service_time', $meta_args);
}

/**
 * Limits meta update capability to users who can edit the post.
 *
 * @param bool   $allowed Whether the user can modify the meta.
 * @param string $meta_key Meta key.
 * @param int    $post_id Post ID.
 *
 * @return bool
 */
function bootscore_service_meta_cap_check($allowed, $meta_key, $post_id, $user_id = 0, $cap = '', $caps = []) {
    return current_user_can('edit_post', $post_id);
}

add_action('add_meta_boxes', 'bootscore_service_add_meta_boxes');
/**
 * Adds meta boxes for the богослужение post type.
 *
 * @return void
 */
function bootscore_service_add_meta_boxes() {
    add_meta_box(
        'bootscore-service-datetime',
        __('Дата и время богослужения', 'bootscore'),
        'bootscore_service_datetime_metabox',
        'service',
        'side'
    );
}

/**
 * Renders the богослужение date and time meta box.
 *
 * @param WP_Post $post Current post object.
 *
 * @return void
 */
function bootscore_service_datetime_metabox($post) {
    wp_nonce_field('bootscore_service_datetime_nonce', 'bootscore_service_datetime_nonce_field');

    $date_value = get_post_meta($post->ID, 'service_date', true);
    $time_value = get_post_meta($post->ID, 'service_time', true);
    ?>
    <p>
        <label for="bootscore-service-date"><?php esc_html_e('Дата', 'bootscore'); ?></label>
        <input type="date" id="bootscore-service-date" name="bootscore_service_date" value="<?php echo esc_attr($date_value); ?>" class="widefat" />
    </p>
    <p>
        <label for="bootscore-service-time"><?php esc_html_e('Время', 'bootscore'); ?></label>
        <input type="time" id="bootscore-service-time" name="bootscore_service_time" value="<?php echo esc_attr($time_value); ?>" class="widefat" />
    </p>
    <?php
}

add_action('save_post_service', 'bootscore_service_save_meta', 10, 2);
/**
 * Handles saving the богослужение meta box fields.
 *
 * @param int     $post_id Saved post ID.
 * @param WP_Post $post Post object.
 *
 * @return void
 */
function bootscore_service_save_meta($post_id, $post) {
    if (!isset($_POST['bootscore_service_datetime_nonce_field']) ||
        !wp_verify_nonce($_POST['bootscore_service_datetime_nonce_field'], 'bootscore_service_datetime_nonce')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['bootscore_service_date'])) {
        update_post_meta($post_id, 'service_date', sanitize_text_field($_POST['bootscore_service_date']));
    }

    if (isset($_POST['bootscore_service_time'])) {
        update_post_meta($post_id, 'service_time', sanitize_text_field($_POST['bootscore_service_time']));
    }
}
