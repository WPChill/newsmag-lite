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
		'label'       => 'Slider layouts',
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
    <table class="free-pro-table">
        <thead>
        <tr>
            <th></th>
            <th>Newsmag</th>
            <th>Newsmag PRO</th>
        </tr>
        </thead>
        <tbody>
		<?php foreach ( $features as $feature ): ?>
            <tr>
                <td class="feature">
                    <h3>
						<?php echo $feature['label']; ?>
                    </h3>
                </td>
                <td class="newsmag-feature">
					<?php echo $feature['newsmag']; ?>
                </td>
                <td class="newsmag-pro-feature">
					<?php echo $feature['newsmag-pro']; ?>
                </td>
            </tr>
		<?php endforeach; ?>
        <tr>
            <td></td>
            <td colspan="2" class="text-right"><a href="https://www.machothemes.com/theme/newsmag-pro/?utm_source=worg&utm_medium=about-page&utm_campaign=upsell" target="_blank"
                               class="button button-primary button-hero"><span class="dashicons dashicons-cart"></span> Get Newsmag Pro!</a></td>
        </tr>
        </tbody>
    </table>
</div>