<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Features
 */
$newsmag = wp_get_theme( 'newsmag' );

$features = array(
	'post-formats'     => array(
		'label'       => 'Post formats',
		'newsmag'     => 'limited',
		'newsmag-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'slider-layouts'   => array(
		'label'       => 'Slide layouts',
		'newsmag'     => '1',
		'newsmag-pro' => '4'
	),
	'news-ticker'      => array(
		'label'       => 'News ticker',
		'newsmag'     => '<span class="dashicons dashicons-no-alt"></span>',
		'newsmag-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'banner-ads'       => array(
		'label'       => 'Dedicated banner ad widgets',
		'newsmag'     => '<span class="dashicons dashicons-no-alt"></span>',
		'newsmag-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'video-widgets'    => array(
		'label'       => 'Video widgets',
		'newsmag'     => '<span class="dashicons dashicons-no-alt"></span>',
		'newsmag-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'color-schemes'    => array(
		'label'       => 'Color schemes',
		'newsmag'     => '<span class="dashicons dashicons-no-alt"></span>',
		'newsmag-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'typography'       => array(
		'label'       => 'Typography',
		'newsmag'     => '<span class="dashicons dashicons-no-alt"></span>',
		'newsmag-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'custom-widgets'   => array(
		'label'       => 'Custom widgets',
		'newsmag'     => '3',
		'newsmag-pro' => '10'
	),
	'multiple-layouts' => array(
		'label'       => 'Multiple blog layouts',
		'newsmag'     => '<span class="dashicons dashicons-no-alt"></span>',
		'newsmag-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'priority-support' => array(
		'label'       => 'Priority support',
		'newsmag'     => '<span class="dashicons dashicons-no-alt"></span>',
		'newsmag-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'security-updates' => array(
		'label'       => 'Security updates & feature releases',
		'newsmag'     => '<span class="dashicons dashicons-no-alt"></span>',
		'newsmag-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
);
?>
<div class="featured-section features">
    <div class="row">
        <div class="feature">
            Features
        </div>

        <div class="newsmag-feature">
            <strong>Newsmag</strong>
        </div>
        <div class="newsmag-pro-features">
            <strong>Newsmag Pro</strong>
        </div>
    </div>
	<?php foreach ( $features as $feature ): ?>
        <div class="row">
            <div class="feature">
				<?php echo $feature['label']; ?>
            </div>
            <div class="newsmag-feature">
				<?php echo $feature['newsmag']; ?>
            </div>
            <div class="newsmag-pro-feature">
				<?php echo $feature['newsmag-pro']; ?>
            </div>
        </div>
	<?php endforeach; ?>
</div>