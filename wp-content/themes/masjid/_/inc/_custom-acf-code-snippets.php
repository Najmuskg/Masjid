<?php
// ACF Options

if( function_exists('acf_add_options_page') ) {


		acf_add_options_page(array(
			'page_title' 	=> 'Site Settings',
			'menu_title'	=> 'Site Settings',
			'menu_slug' 	=> 'site-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));



}

// the ACF fields

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_562fb3f3bc547',
	'title' => 'Code snippets: Body',
	'fields' => array(
		array(
			'key' => 'field_562fb3f3bfa7f',
			'label' => 'Code Snippets',
			'name' => 'code_snippets__body',
			'type' => 'repeater',
			'instructions' => 'Add code that belongs before the closing &lt;body&gt; tag',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => 0,
			'max' => 0,
			'layout' => 'row',
			'button_label' => '+ Add Snippet',
			'sub_fields' => array(
				array(
					'key' => 'field_562fb3f3c14f9',
					'label' => 'Code',
					'name' => 'code',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			'collapsed' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-body-tag',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_562f9de4e4fbb',
	'title' => 'Code snippets: Head',
	'fields' => array(
		array(
			'key' => 'field_562f9deba8199',
			'label' => 'Code Snippets',
			'name' => 'code_snippets__head',
			'type' => 'repeater',
			'instructions' => 'Add code that belongs inside &lt;head&gt; tags',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => 0,
			'max' => 0,
			'layout' => 'row',
			'button_label' => '+ Add Snippet',
			'sub_fields' => array(
				array(
					'key' => 'field_562f9df9a819a',
					'label' => 'Code',
					'name' => 'code',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			'collapsed' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-head-tag',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5a57b204b40b9',
	'title' => 'Code snippets: After head',
	'fields' => array(
		array(
			'key' => 'field_5a57b204b9ca0',
			'label' => 'Code Snippets',
			'name' => 'code_snippets__head_after',
			'type' => 'repeater',
			'instructions' => 'Add code that belongs immediately after the &lt;/head&gt; tag',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'row',
			'button_label' => '+ Add Snippet',
			'sub_fields' => array(
				array(
					'key' => 'field_5a57b204bcd22',
					'label' => 'Code',
					'name' => 'code',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-head-tag',
			),
		),
	),
	'menu_order' => 5,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;
