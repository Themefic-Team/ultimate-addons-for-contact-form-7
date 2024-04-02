<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UACF7_FORM_GENERATOR {

	/*
	 * Construct function
	 */
	public function __construct() {
		//
		define( 'UACF7_FORM_AI_PATH', UACF7_PATH . '/addons/form-generator-ai' );
		// admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );


		// add Popup Contact form 7 admin footer
		add_action( 'wpcf7_admin_footer', array( $this, 'uacf7_form_admin_footer_popup' ) );

		// Ai form generator Ajax Function
		add_action( 'wp_ajax_uacf7_form_generator_ai', array( $this, 'uacf7_form_generator_ai' ) );

		// Ai form Get Tag Ajax Function
		add_action( 'wp_ajax_uacf7_form_generator_ai_get_tag', array( $this, 'uacf7_form_generator_ai_get_tag' ) );
	}


	// Add Admin Scripts
	public function admin_scripts() {
		wp_enqueue_script( 'uacf7-form-generator-ai-choices-js', UACF7_ADDONS . '/form-generator-ai/assets/js/choices.min.js', array(), null, true );
		wp_enqueue_script( 'uacf7-form-generator-ai-admin-js', UACF7_ADDONS . '/form-generator-ai/assets/js/admin-form-generator-ai.js', array( 'jquery' ), null, true );
		// wp_enqueue_style( 'uacf7-form-generator-ai-choices-css', UACF7_ADDONS . '/form-generator-ai/assets/css/choices.css' ); 
		wp_enqueue_style( 'uacf7-form-generator-ai-admin-css', UACF7_ADDONS . '/form-generator-ai/assets/css/admin-form-generator-ai.css' );


		//Form Default Styles
		
		wp_enqueue_style( 'uacf7-form-ai-generator-form-style', UACF7_ADDONS . '/form-generator-ai/assets/css/form-style.css' );
		wp_localize_script( 'uacf7-form-generator-ai-admin-js', 'uacf7_form_ai',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'uacf7-form-generator-ai-nonce' ),
				'loader' => UACF7_ADDONS . '/form-generator-ai/assets/images/pre-loader.svg',
			)
		);
	}




	// Add Popup Contact form 7 admin footer
	public function uacf7_form_admin_footer_popup() {
		ob_start();
		?>
		<div class="uacf7-form-ai-popup">
			<div class="uacf7-form-ai-wrap">
				<div class="uacf7-form-ai-inner">
					<div class="close" title="Exit Full Screen">╳</div>

					<div class="uacf7-ai-form-column">
						<div class="uacf7-form-input-wrap">

							<h4>
								<?php echo esc_html_e( 'Create a', 'ultimate-addons-cf7' ); ?>
							</h4>
							<div class="uacf7-form-input-inner">
								<select class="form-control uacf7-choices" data-trigger name="uacf7-form-generator-ai"
									id="uacf7-form-generator-ai" placeholder="This is a placeholder" multiple>
								</select>
								<button class="uacf7_ai_search_button">
									<?php echo esc_html_e( 'Generate With AI', 'ultimate-addons-cf7' ); ?>
								</button>
							</div>

						</div>
						<div class="uacf7-doc-notice">
						<?php
							echo sprintf(
								// Translators: %1$s is replaced with the link to documentation.
								esc_html__( 'Not sure how to use this? Check our step by step %1s.', 'ultimate-addons-cf7' ),
								'<a href="https://themefic.com/docs/uacf7/free-addons/ai-form-generator/" target="_blank">documentation</a>'
							);
							?>

						</div>
					</div>
					<div class="uacf7-ai-form-column">
						<div class="uacf7-ai-codeblock">
							<div class="uacf7-ai-navigation">
								<span class="uacf7-ai-code-reset">
									<?php echo esc_html_e( 'Reset', 'ultimate-addons-cf7' ); ?>
								</span>
								<span class="uacf7-ai-code-copy">
									<?php echo esc_html_e( 'Copy', 'ultimate-addons-cf7' ); ?>
								</span>
								<span class="uacf7-ai-code-insert">
									<?php echo esc_html_e( 'Insert', 'ultimate-addons-cf7' ); ?>
								</span>
							</div>
							<textarea name="uacf7_ai_code_content" id="uacf7_ai_code_content"></textarea>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php
		echo ob_get_clean();
	}

	public function uacf7_form_generator_ai_get_tag() {
		if ( ! wp_verify_nonce( $_POST['ajax_nonce'], 'uacf7-form-generator-ai-nonce' ) ) {
			exit( esc_html__( "Security error", 'ultimate-addons-cf7' ) );
		}
		$tag_generator = WPCF7_TagGenerator::get_instance( 'panel', true );

		$reflector = new ReflectionClass( 'WPCF7_TagGenerator' );
		$property = $reflector->getProperty( 'panels' );
		$property->setAccessible( true );

		$panels = $property->getValue( $tag_generator );
		$tag_data = [];
		foreach ( $panels as $key => $value ) {
			if ( $key !== 'uacf7_conversational_start' && $key != 'uacf7_conversational_end' && $key != 'uacf7_step_start' && $key != 'uacf7_step_end' && $key != 'conditional' && $key != 'repeater' ) {
				$tag_value['value'] = $key;
				$tag_value['label'] = $value['title'];
				$tag_data[] = $tag_value;
			}

		}
		// $form_booking =  apply_filters('uacf7_booking_ai_form_dropdown', ["value" => "booking", "label" => "Booking (Pro)", "disabled" => "false"]);

		$secend_option_form = [ 
			[ "value" => "basis-contact-form", "label" => "Basis Contact Form" ],
			[ "value" => "polling", "label" => "Polling Form" ],
			[ "value" => "survey-form", "label" => "Client Satisfaction Survey Form" ],
			[ "value" => "complaint-form", "label" => "Customer Complaint Form" ],
			[ "value" => "service-order", "label" => "Service Order Form" ],
			[ "value" => "proposal", "label" => "Conference Proposal" ],
			[ "value" => "donation-form", "label" => "Donation Form" ],
			[ "value" => "volunteer-sign-up-form", "label" => "Volunteer sign up form" ],
			[ "value" => "multistep", "label" => "Multistep" ],
			apply_filters( 'uacf7_booking_ai_form_dropdown', [ "value" => "booking", "label" => "Booking (Pro)" ] ),
			[ "value" => "conditional", "label" => "Conditional" ],
			[ "value" => "subscription", "label" => "Subscription" ],
			[ "value" => "blog-newsletter", "label" => "Blog Newsletter" ],
			apply_filters( 'uacf7_repeater_ai_form_dropdown', [ "value" => "repeater", "label" => "Repeater (Pro)" ] ),
			apply_filters( 'uacf7_blog_submission_ai_form_dropdown', [ "value" => "blog", "label" => "Blog Submission (Pro)" ] ),
			[ "value" => "feedback", "label" => "Feedback" ],
			[ "value" => "support-form", "label" => "Support Form" ],
			[ "value" => "application", "label" => "Application" ],
			[ "value" => "inquiry", "label" => "Inquiry" ],
			[ "value" => "survey", "label" => "Survey" ],
			[ "value" => "address", "label" => "Address" ],
			[ "value" => "event", "label" => "Event Registration" ],
			[ "value" => "newsletter", "label" => "Newsletter" ],
			[ "value" => "newslettertow", "label" => "Newsletter Style 2" ],
			[ "value" => "donation", "label" => "Donation" ],
			[ "value" => "blood-donation", "label" => "Blood Donation" ],
			[ "value" => "charity-dinner", "label" => "Charity Dinner" ],
			[ "value" => "volunteer-application", "label" => "Volunteer Application" ],
			[ "value" => "graphic-designer-contact-form", "label" => "Graphic Designer Contact Form" ],
			[ "value" => "hardware-request-form", "label" => "Hardware Request Form" ],
			[ "value" => "it-service-req", "label" => "IT Service Request" ],
			[ "value" => "request-for-quote", "label" => "Request for Quote" ],
			[ "value" => "report-a-bug", "label" => "Report a Bug" ],
			[ "value" => "check-request", "label" => "Check Request" ],
			[ "value" => "vendor-contact", "label" => "Vendor Contact" ],
			[ "value" => "request-a-leave", "label" => "Request a Leave" ],
			[ "value" => "event-registration", "label" => "Event Registration" ],
			[ "value" => "event-registration", "label" => "Event Registration" ],
			[ "value" => "tell-a-friend", "label" => "Tell a Friend Form" ],
			[ "value" => "accident-report-form", "label" => "Accident Report Form" ],
			[ "value" => "complaint-form-2", "label" => "Complaint Form" ],
			[ "value" => "directory-information", "label" => "Directory Information" ],
			[ "value" => "patient-intake-form", "label" => "Patient Intake Form" ],
			[ "value" => "market-research-survey", "label" => "Market Research Survey" ],
			[ "value" => "database-management", "label" => "Database Management" ],
			[ "value" => "pricing-survey", "label" => "Pricing Survey" ],
			[ "value" => "workshop-registration", "label" => "Workshop Registration" ],
			[ "value" => "product-order-form", "label" => "Product Order Form" ],
			[ "value" => "donation-form-2", "label" => "Donate Now" ],
			[ "value" => "order-bump-form", "label" => "Order Bump Form" ],
			[ "value" => "student-survey", "label" => "Student Survey Form" ],
			[ "value" => "classroom-observation", "label" => "Class Room Observation" ],
			[ "value" => "course-evalution", "label" => "Course Evalution" ],
			[ "value" => "admission-form", "label" => "Student Admission Form" ],
			[ "value" => "multiple-file-upload", "label" => "Multiple File Upload" ],
			[ "value" => "software-survey", "label" => "Software Survey" ],
			[ "value" => "university-enrollment", "label" => "University Enrollment" ],
			[ "value" => "website-feedback", "label" => "Website Feedback" ],
			[ "value" => "partnership-application", "label" => "Partnership Application" ],
			[ "value" => "finance-application", "label" => "Finance Application" ],
			[ "value" => "high-school-transcript", "label" => "High School Transcript" ],
			[ "value" => "book-a-room", "label" => "Book a Room" ],
			[ "value" => "qoute-request", "label" => "Qoute Request" ],
			[ "value" => "loan-application", "label" => "Loan Application" ],
			[ "value" => "personal-loan", "label" => "Personal Loan" ],
			[ "value" => "sponsor-request", "label" => "Sponsor Request" ],
			[ "value" => "job-listing", "label" => "Job Listing" ],
			[ "value" => "party-invite", "label" => "Party Invite" ],
			[ "value" => "birthday-party", "label" => "Birthday Party" ],
			[ "value" => "vehicle-inspection", "label" => "Vehicle Inspection" ],
			[ "value" => "social-service", "label" => "social Service Home Visit" ],
			[ "value" => "handicap-parking-request", "label" => "Handicap Parking Request" ],
			[ "value" => "employee-evaluation", "label" => "Employee Evaluation" ],
			[ "value" => "confidential-morbidity", "label" => "Confidential Morbidity"],
			[ "value" => "swimming-competition-enrollment", "label" => "Swimming Competition Enrollment"],
			[ "value" => "functional-behavioral-assesment", "label" => "Functional Behavioral Assessment" ],
			apply_filters( 'uacf7_service_booking_form_dropdown', [ "value" => "service-booking", "label" => "Service Booking (Pro)" ] ),
			apply_filters( 'uacf7_appointment_form_dropdown', [ "value" => "appointment-form", "label" => "Appointment (Pro)" ] ),
			apply_filters( 'uacf7_conversational_appointment_form_dropdown', [ "value" => "conversational-appointment-form", "label" => "Conversational Appointment Booking  (Pro)" ] ),
			apply_filters( 'uacf7_conversational_interview_form_dropdown', [ "value" => "conversational-interview-form", "label" => "Conversational Interview Process (Pro)" ] ),
			[ "value" => "rating", "label" => "Rating" ],
		];

		$data = [ 
			'status' => 'success',
			'value_tag' => $tag_data,
			'value_form' => $secend_option_form,
		];

		wp_send_json( $data );
		die();

	}

	// Ai form Get Tag Ajax Function
	public function uacf7_form_generator_ai() {
		if ( ! wp_verify_nonce( $_POST['ajax_nonce'], 'uacf7-form-generator-ai-nonce' ) ) {
			exit( esc_html__( "Security error", 'ultimate-addons-cf7' ) );
		}
		$vaue = '';
		$uacf7_default = $_POST['searchValue'];

		if ( count( $uacf7_default ) > 0 && $uacf7_default[0] == 'form' ) {
			$value = require_once apply_filters( 'uacf7_ai_form_generator_template', UACF7_FORM_AI_PATH . '/templates/uacf7-forms.php' );
		} elseif ( count( $uacf7_default ) > 0 && $uacf7_default[0] == 'tag' ) {
			$value = require_once apply_filters( 'uacf7_ai_form_generator_template', UACF7_FORM_AI_PATH . '/templates/uacf7-tags.php' );
		}
		$data = [ 
			'status' => 'success',
			'value' => $value,
		];
			wp_send_json( $data );
		die();
	}
}

new UACF7_FORM_GENERATOR();


?>