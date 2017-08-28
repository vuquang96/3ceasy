<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'main' => array(
		'type'    => 'box',
		'title'   => '',
		'options' => array(
			'id'       => array(
				'type'  => 'unique',
			),
			'builder'  => array(
				'type'    => 'tab',
				'title'   => esc_html__( 'Form Fields', 'wplab-recover' ),
				'options' => array(
					'form' => array(
						'label' => false,
						'type'  => 'form-builder',
						'value' => array(
							'json' => apply_filters('fw:ext:forms:builder:load-item:form-header-title', true)
								? json_encode( array(
									array(
										'type'      => 'form-header-title',
										'shortcode' => 'form_header_title',
										'width'     => '',
										'options'   => array(
											'title'    => '',
											'subtitle' => '',
										)
									)
								) )
								: '[]'
						),
						'fixed_header' => true,
					),
				),
			),
			'settings' => array(
				'type'    => 'tab',
				'title'   => esc_html__( 'Settings', 'wplab-recover' ),
				'options' => array(
					'settings-options' => array(
						'title'   => esc_html__( 'Options', 'wplab-recover' ),
						'type'    => 'tab',
						'options' => array(
							'form_email_settings' => array(
								'type'    => 'group',
								'options' => array(
									'email_to' => array(
										'type'  => 'text',
										'label' => esc_html__( 'Email To', 'wplab-recover' ),
										'help' => esc_html__( 'We recommend you to use an email that you verify often', 'wplab-recover' ),
										'desc'  => esc_html__( 'The form will be sent to this email address.', 'wplab-recover' ),
									),
								),
							),
							'form_text_settings'  => array(
								'type'    => 'group',
								'options' => array(
									'subject-group' => array(
										'type' => 'group',
										'options' => array(
											'subject_message'    => array(
												'type'  => 'text',
												'label' => esc_html__( 'Subject Message', 'wplab-recover' ),
												'desc' => esc_html__( 'This text will be used as subject message for the email', 'wplab-recover' ),
												'value' => esc_html__( 'New message', 'wplab-recover' ),
											),
										)
									),
									'submit-button-group' => array(
										'type' => 'group',
										'options' => array(
											'submit_button_text' => array(
												'type'  => 'text',
												'label' => esc_html__( 'Submit Button', 'wplab-recover' ),
												'desc' => esc_html__( 'This text will appear in submit button', 'wplab-recover' ),
												'value' => esc_html__( 'Send', 'wplab-recover' ),
											),
										)
									),
									'success-group' => array(
										'type' => 'group',
										'options' => array(
											'success_message'    => array(
												'type'  => 'text',
												'label' => esc_html__( 'Success Message', 'wplab-recover' ),
												'desc' => esc_html__( 'This text will be displayed when the form will successfully send', 'wplab-recover' ),
												'value' => esc_html__( 'Message sent!', 'wplab-recover' ),
											),
										)
									),
									'failure_message'    => array(
										'type'  => 'text',
										'label' => esc_html__( 'Failure Message', 'wplab-recover' ),
										'desc' => esc_html__( 'This text will be displayed when the form will fail to be sent', 'wplab-recover' ),
										'value' => esc_html__( 'Oops something went wrong.', 'wplab-recover' ),
									),
								),
							),
						)
					),
					'mailer-options'   => array(
						'title'   => esc_html__( 'Mailer', 'wplab-recover' ),
						'type'    => 'tab',
						'options' => array(
							'mailer' => array(
								'label' => false,
								'type'  => 'mailer'
							)
						)
					)
				),
			),
			'redirect' => array(
				'type'    => 'tab',
				'title'   => esc_html__( 'Form redirect', 'wplab-recover' ),
				'options' => array(
				
					'redirect_on_success' => array(
						'type'  => 'text',
						'label' => esc_html__( 'Redirect on success', 'wplab-recover' ),
						'desc' => esc_html__( 'Type here any URL where user will be redirected after form submit, e.g. to the Thank You page.', 'wplab-recover' ),
					),
				
				)
			),
		),
	)
);