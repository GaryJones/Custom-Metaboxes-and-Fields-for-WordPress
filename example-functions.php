<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	$meta_boxes[] = array(
		'id'         => 'test_metabox',
		'title'      => 'Test Metabox',
		'pages'      => array( 'page', 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Test Text',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_text',
				'type' => 'text',
			),
			array(
				'name' => 'Test Text Small',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_textsmall',
				'type' => 'text_small',
			),
			array(
				'name' => 'Test Text Medium',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_textmedium',
				'type' => 'text_medium',
			),
			array(
				'name'        => 'Test Date Picker',
				'desc'        => 'Field description (optional)',
				'id'          => $prefix . 'test_textdate',
				'type'        => 'text_date',
				'data-format' => 'yy-mm-dd',
			),
			array(
				'name' => 'Test Date Picker (UNIX timestamp)',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_textdate_timestamp',
				'type' => 'text_date_timestamp',
			),
			array(
				'name' => 'Test Date/Time Picker Combo (UNIX timestamp)',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_datetime_timestamp',
				'type' => 'text_datetime',
			),
			array(
	            'name' => 'Test Time',
	            'desc' => 'Field description (optional)',
	            'id'   => $prefix . 'test_time',
	            'type' => 'text_time',
	        ),
			array(
				'name'   => 'Test Money',
				'desc'   => 'Field description (optional)',
				'id'     => $prefix . 'test_text_money',
				'type'   => 'text_money',
				'before' => '£ ',
			),
			array(
				'name'       => 'Test HTML5 Type (Area)',
				'desc'       => 'Field description (optional)',
				'id'         => $prefix . 'test_area',
				'type'       => 'text_small',
				'input_type' => 'number',
				'after'      => 'm<sup>2</sup> ',
			),
			array(
	            'name' => 'Test Color Picker',
	            'desc' => 'Field description (optional)',
	            'id'   => $prefix . 'test_colorpicker',
	            'type' => 'colorpicker',
				'std'  => '#ffffff',
	        ),
			array(
				'name' => 'Test Textarea',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_textarea',
				'type' => 'textarea',
			),
			array(
				'name' => 'Test Textarea Small',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_textarea_small',
				'type' => 'textarea_small',
			),
			array(
				'name' => 'Test Textarea Code',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_textarea_code',
				'type' => 'textarea_code',
			),
			array(
				'name' => 'Test Title Weeeee',
				'desc' => 'This is a title description (optional)',
				'id'   => $prefix . 'test_title',
				'type' => 'title',
			),
			array(
				'name'    => 'Test Select',
				'desc'    => 'Field description (optional)',
				'id'      => $prefix . 'test_select',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Option One', 'value' => 'standard', ),
					array( 'name' => 'Option Two', 'value' => 'custom', ),
					array( 'name' => 'Option Three', 'value' => 'none', ),
				),
			),
			array(
				'name'    => 'Test Radio',
				'desc'    => 'Field description (optional)',
				'id'      => $prefix . 'test_radio',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Option One', 'value' => 'standard', ),
					array( 'name' => 'Option Two', 'value' => 'custom', ),
					array( 'name' => 'Option Three', 'value' => 'none', ),
				),
			),
			array(
				'name'    => 'Test Radio inline',
				'desc'    => 'Field description (optional)',
				'id'      => $prefix . 'test_radio_inline',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Option One', 'value' => 'standard', ),
					array( 'name' => 'Option Two', 'value' => 'custom', ),
					array( 'name' => 'Option Three', 'value' => 'none', ),
				),
			),
			array(
				'name' => 'Test Checkbox',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_checkbox',
				'type' => 'checkbox',
			),
			array(
				'name'    => 'Test Multi Checkbox',
				'desc'    => 'Field description (optional)',
				'id'      => $prefix . 'test_multicheckbox',
				'type'    => 'multicheck',
				'options' => array(
					array( 'name' => 'Check One', 'value' => 'check1', ),
					array( 'name' => 'Check Two', 'value' => 'check2', ),
					array( 'name' => 'Check Three', 'value' => 'check3', ),
				),
			),
			array(
				'name'    => 'Test Multi Checkbox Inline',
				'desc'    => 'Field description (optional)',
				'id'      => $prefix . 'test_multicheckbox_inline',
				'type'    => 'multicheck_inline',
				'options' => array(
					array( 'name' => 'Check One', 'value' => 'check1', ),
					array( 'name' => 'Check Two', 'value' => 'check2', ),
					array( 'name' => 'Check Three', 'value' => 'check3', ),
				),
			),
			array(
				'name'     => 'Test Taxonomy Select',
				'desc'     => 'Field description (optional)',
				'id'       => $prefix . 'test_taxonomy_select',
				'type'     => 'taxonomy_select',
				'taxonomy' => 'category', // Taxonomy Slug
			),
			array(
				'name'     => 'Test Taxonomy Radio',
				'desc'     => 'Field description (optional)',
				'id'       => $prefix . 'test_taxonomy_radio',
				'type'     => 'taxonomy_radio',
				'taxonomy' => 'category', // Taxonomy Slug
			),
			array(
				'name'     => 'Test Taxonomy Radio Inline',
				'desc'     => 'Field description (optional)',
				'id'       => $prefix . 'test_taxonomy_radio',
				'type'     => 'taxonomy_radio_inline',
				'taxonomy' => 'category', // Taxonomy Slug
			),
			array(
				'name'     => 'Test Taxonomy Checkboxes',
				'desc'     => 'Field description (optional)',
				'id'       => $prefix . 'test_taxonomy_checkbox',
				'type'     => 'taxonomy_checkbox',
				'taxonomy' => 'post_tag', // Taxonomy Slug
			),
			array(
				'name'     => 'Test Taxonomy Checkboxes Inline',
				'desc'     => 'Field description (optional)',
				'id'       => $prefix . 'test_taxonomy_checkbox_inline',
				'type'     => 'taxonomy_checkbox_inline',
				'taxonomy' => 'post_tag', // Taxonomy Slug
			),
			array(
				'name' => 'Test Post Type Select',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_post_type_select',
				'type' => 'post_type_select',
			),
			array(
				'name' => 'Test Post Type Radio',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_post_type_radio',
				'type' => 'post_type_radio',
			),
			array(
				'name' => 'Test Post Type Radio Inline',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_post_type_radio',
				'type' => 'post_type_radio_inline',
			),
			array(
				'name' => 'Test Post Type Checkboxes',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_post_type_checkbox',
				'type' => 'post_type_checkbox',
			),
			array(
				'name' => 'Test Post Type Checkboxes Inline',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_post_type_checkbox_inline',
				'type' => 'post_type_checkbox_inline',
			),
			array(
				'name' => 'Test wysiwyg',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_wysiwyg',
				'type' => 'wysiwyg',
				'args' => array( 'textarea_rows' => 5, ),
			),
//			array(
//				'name' => 'Test Image',
//				'desc' => 'Upload an image or enter an URL.',
//				'id'   => $prefix . 'test_image',
//				'type' => 'file',
//			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'about_page_metabox',
		'title'      => 'About Page Metabox',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
				'name' => 'Test Text',
				'desc' => 'Field description (optional)',
				'id'   => $prefix . 'test_text_about',
				'type' => 'text',
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'tabs_metabox',
		'title'      => 'Tabs Metabox',
		'pages'      => array( 'page', ), // Post type
		'show_names' => true, // Show field names on the left
		'tabs'       => array(
			'tab-1-id' => array(
				'title' => 'Tab 1',
				'fields'=> array(
					array(
						'name' => 'Test Text',
						'desc' => 'Field description (optional)',
						'id'   => $prefix . 'test_text_tab2',
						'type' => 'text',
					),
					array(
						'name'    => 'Test Select',
						'desc'    => 'Field description (optional)',
						'id'      => $prefix . 'test_select_tab1',
						'type'    => 'select',
						'options' => array(
							array( 'name' => 'Option One', 'value' => 'standard', ),
							array( 'name' => 'Option Two', 'value' => 'custom', ),
							array( 'name' => 'Option Three', 'value' => 'none', ),
						),
					),
				),
			),
			'tab-2-id' => array(
				'title' => 'Tab 2',
				'fields'=> array(
					array(
						'name'    => 'Test Select',
						'desc'    => 'Field description (optional)',
						'id'      => $prefix . 'test_select_tab2',
						'type'    => 'select',
						'options' => array(
							array( 'name' => 'Option One', 'value' => 'standard', ),
							array( 'name' => 'Option Two', 'value' => 'custom', ),
							array( 'name' => 'Option Three', 'value' => 'none', ),
						),
					),
					array(
						'name' => 'Test Text',
						'desc' => 'Field description (optional)',
						'id'   => $prefix . 'test_text_tab2',
						'type' => 'text',
					),
				),
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}