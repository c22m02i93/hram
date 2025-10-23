<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 * @version 6.2.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">
  
  <!-- Skip Links -->
  <a class="skip-link visually-hidden-focusable" href="#primary"><?php esc_html_e( 'Skip to content', 'bootscore' ); ?></a>
  <a class="skip-link visually-hidden-focusable" href="#footer"><?php esc_html_e( 'Skip to footer', 'bootscore' ); ?></a>

  <!-- Top Bar Widget -->
  <?php if (is_active_sidebar('top-bar')) : ?>
    <?php dynamic_sidebar('top-bar'); ?>
  <?php endif; ?>
  
  <?php do_action( 'bootscore_before_masthead' ); ?>

  <header id="masthead" class="site-header hram-header">

    <?php do_action( 'bootscore_after_masthead_open' ); ?>

    <div class="hram-header__blessing">
      <span><?php esc_html_e('по благословению митрополита Симбирского и Новоспасского Лонгина', 'bootscore'); ?></span>
    </div>

    <div class="hram-header__mobile-bar container d-lg-none">
      <button class="hram-header__toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar" aria-label="<?php esc_attr_e( 'Toggle main menu', 'bootscore' ); ?>">
        <span class="hram-header__toggler-line"></span>
        <span class="hram-header__toggler-line"></span>
        <span class="hram-header__toggler-line"></span>
      </button>
      <a class="hram-header__mobile-logo" href="<?= esc_url(home_url()); ?>">
        <img src="<?= esc_url('https://nevsky-simbirsk.ru/wp-content/uploads/2025/10/hapka-1.svg'); ?>" alt="<?php bloginfo('name'); ?> Logo" loading="lazy">
      </a>
    </div>

    <div class="hram-header__main container d-none d-lg-flex">
      <div class="hram-header__contacts">
        <a href="https://vk.com" class="hram-header__contact" target="_blank" rel="noopener" aria-label="ВКонтакте">
          <i class="fa-brands fa-vk" aria-hidden="true"></i>
        </a>
        <a href="https://t.me" class="hram-header__contact" target="_blank" rel="noopener" aria-label="Telegram">
          <i class="fa-brands fa-telegram-plane" aria-hidden="true"></i>
        </a>
        <a href="mailto:info@nevsky-simbirsk.ru" class="hram-header__contact" aria-label="Email">
          <i class="fa-regular fa-envelope" aria-hidden="true"></i>
        </a>
        <a href="tel:+78422000000" class="hram-header__contact hram-header__contact--phone" aria-label="Позвонить">
          <i class="fa-solid fa-phone" aria-hidden="true"></i>
          <span>+7 (8422) 00-00-00</span>
        </a>
      </div>
      <a class="hram-header__logo" href="<?= esc_url(home_url()); ?>">
        <img src="<?= esc_url('https://nevsky-simbirsk.ru/wp-content/uploads/2025/10/hapka-1.svg'); ?>" alt="<?php bloginfo('name'); ?> Logo" loading="lazy">
      </a>
    </div>

    <div class="hram-header__divider container">
      <div class="hram-header__divider-line"></div>
      <img src="<?= esc_url('https://nevsky-simbirsk.ru/wp-content/uploads/2025/10/ikonka-1.svg'); ?>" alt="<?php esc_attr_e('Декоративный элемент', 'bootscore'); ?>" class="hram-header__divider-logo" loading="lazy">
      <div class="hram-header__divider-line"></div>
    </div>

    <div class="hram-header__menu container d-none d-lg-flex">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container'      => false,
        'menu_class'     => 'hram-header__menu-list',
        'fallback_cb'    => '__return_false',
        'depth'          => 2,
        'walker'         => new bootstrap_5_wp_nav_menu_walker(),
      ));
      ?>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-navbar">
      <div class="offcanvas-header">
        <span class="h5 offcanvas-title"><?= apply_filters('bootscore/offcanvas/navbar/title', __('Меню', 'bootscore')); ?></span>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="<?php esc_attr_e( 'Close', 'bootscore' ); ?>"></button>
      </div>
      <div class="offcanvas-body">
        <div class="hram-header__offcanvas-contacts d-lg-none">
          <a href="https://vk.com" class="hram-header__contact" target="_blank" rel="noopener" aria-label="ВКонтакте">
            <i class="fa-brands fa-vk" aria-hidden="true"></i>
          </a>
          <a href="https://t.me" class="hram-header__contact" target="_blank" rel="noopener" aria-label="Telegram">
            <i class="fa-brands fa-telegram-plane" aria-hidden="true"></i>
          </a>
          <a href="mailto:info@nevsky-simbirsk.ru" class="hram-header__contact" aria-label="Email">
            <i class="fa-regular fa-envelope" aria-hidden="true"></i>
          </a>
          <a href="tel:+78422000000" class="hram-header__contact hram-header__contact--phone" aria-label="Позвонить">
            <i class="fa-solid fa-phone" aria-hidden="true"></i>
            <span>+7 (8422) 00-00-00</span>
          </a>
        </div>

        <?php get_template_part('template-parts/header/main-menu'); ?>

        <?php if (is_active_sidebar('top-nav-2')) : ?>
          <?php dynamic_sidebar('top-nav-2'); ?>
        <?php endif; ?>
      </div>
    </div>

    <?php
    if (class_exists('WooCommerce')) :
      get_template_part('template-parts/header/collapse-search', 'woocommerce');
      get_template_part('template-parts/header/offcanvas', 'woocommerce');
    else :
      get_template_part('template-parts/header/collapse-search');
    endif;
    ?>

    <?php do_action( 'bootscore_before_masthead_close' ); ?>

  </header><!-- #masthead -->

  <?php do_action( 'bootscore_after_masthead' ); ?>
