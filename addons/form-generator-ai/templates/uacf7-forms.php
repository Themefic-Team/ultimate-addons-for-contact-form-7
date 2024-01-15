<?php
defined( 'ABSPATH' ) || exit;

/**
 * Template for the Form Generator AI Form.
 *
 * @package   UACF7
 * @subpackage Form Generator AI
 * @since     1.0.0
 * @Author:  Sydur Rahman, M Hemel Hasan
 */

switch ( $uacf7_default[1] ) {
	// Start Form from MHemelHasan
	case 'basis-contact-form':
		$form =
			'<div class="uacf7-wrapper-default">
    [uacf7-row]
        [uacf7-col col:6]
            <label> First Name *
                [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
            <label> Last Name *
                [text* your-last-name autocomplete:name placeholder "Last Name"] </label>  [/uacf7-col]
    [/uacf7-row]
    <label> Email *
        [email* your-email autocomplete:email placeholder "Email Address"] </label>
    <label> Subject *
        [text* your-subject placeholder "Subject"] </label>
    <label> Your Message *
        [textarea* your-message placeholder "Your Message"] </label>
    [submit "Submit Form"]
</div>';
		break;

	case 'newslettertow':
		$form = '<div class="uacf7-wrapper-default">
    <h3 style="text-align: center;">Subscribe to our newsletter</h3>
    <p style="text-align: center;">Welcome to our Newsletter Subscription Center. Sign up in the newsletter form below to receive the latest news and updates from our company.</p>
    <hr>
    [uacf7-row]
        [uacf7-col col:6]
            <label> First Name
                [text* first-name autocomplete:name] </label>  [/uacf7-col]
        [uacf7-col col:6]
            <label> Last Name
                [text* last-name autocomplete:name] </label>  [/uacf7-col]
    [/uacf7-row]
    <label> Email
        [email* your-email autocomplete:email] </label>
    <div class="uacf7-submint end fill">
        [submit "Subscribe"]
    </div>
</div>';
		break;

	case 'blog-newsletter':
		$form = '<div class="uacf7-wrapper-default">
    [uacf7-row]
        [uacf7-col col:6]
            <span>
                [email* email-address placeholder "Your Mail Address"] </span> 
        [/uacf7-col]
        [uacf7-col col:6]
            <div class="uacf7-submint fill full-width">
                [submit "Subscribe"]
            </div>
        [/uacf7-col]
    [/uacf7-row]
</div>';
		break;

	case 'support-form':
		$form = '<div class="uacf7-wrapper-default">
    [uacf7-row]
        [uacf7-col col:6]
            <label> First Name *
                [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
            <label> Last Name *
                [text* your-last-name autocomplete:name placeholder "Last Name"] </label>  [/uacf7-col]
    [/uacf7-row]
    <label> Email *
        [email* your-email autocomplete:email placeholder "Email Address"] </label>
    <label> Department *
    [select* department "Web Design" "Web Development" "WordPress Development" "WordPress Plugin"] </label>
    <label> Subject *
        [text* your-subject placeholder "Subject"] </label>
    <label> Description *
        [textarea* your-message placeholder "Your Message"] </label>
    <div class="uacf7-submint">
        [submit "Subscribe"]
    </div>
</div>';
		break;

	case 'polling':
		$form = '<div class="uacf7-wrapper-default">
    <label> Full Name *
        [text* full-name autocomplete:name placeholder "Full Name"] </label>
    <label> Email *
        [email* your-email autocomplete:email placeholder "Email Address"] </label>
    <label> Which game you want to play?*
        [checkbox* question-1 class:uacf7-checkbox "Football" "Cricket" "Hocky"]</label>
    <label> Time of the match?
        [radio question-2 class:uacf7-radio default:1 "Morning" "Afternoon" "Any time"]</label>
    <label> Put your suggestion  (optional)
        [textarea your-suggestion] </label>
    <div class="uacf7-submint">
        [submit "Submit Your opinion"]
    </div>
</div>';
		break;

	// End Form from -MHemelHasan

	case "multistep":
		$form = '<div class="uacf7-wrapper-default">
    [uacf7_step_start uacf7_step_start-901 "Step One"]
    <label> Your name
        [text* your-name] </label> 
    <label> Your email
        [email* your-email] </label>
    [uacf7_step_end]
    [uacf7_step_start uacf7_step_start-902 "Step Two"]
    <label> Subject
        [text* your-subject] </label> 
    <label> Do you need an appointment?
        [select* menu-663 include_blank "Yes" "No"] </label> 
    [uacf7_step_end]
    [uacf7_step_start uacf7_step_start-903 "Step Three"]
    <label> Your message (optional)
        [textarea your-message] </label> 
    [submit "Submit"]
    [uacf7_step_end]
</div>';
		break;

	case "conditional":
		$form = '<h4>Condition for Field Type: <strong>Text</strong></h4>
Write name <strong>"John Doe"</strong> or <strong>"Abul Mia"</strong> to test it out 
<label> Your Name </label> 
[conditional namefield]
<label> Is your Father name Jonathan Doe?
    [select menu-655 include_blank "Yes" "No"] </label>
<div class="clear"></div>
[/conditional] 
<hr /> 
<h4>Condition for Field Type: <strong>Dropdown</strong></h4>
Select <strong>"Yes"</strong> or <strong>"No"</strong> to test it out 
<label> Do you have any Physical Address?
    [select* menu-654 include_blank "Yes" "No"] </label> 
[conditional address]
<label> Insert Your Address </label>
<div class="clear"></div>
[/conditional] 
[conditional email]
<label> Insert Your Alternate E-mail
    [email your-email] </label>
<div class="clear"></div>
[/conditional] 
<hr /> 
<h4>Condition for Field Type: <strong>Radio Buttons</strong></h4>
Select <strong>"Option Two"</strong> or <strong>"Option Three"</strong> to test it out 
<label>Choose your preference</label>
    [radio radio-269 use_label_element default:1 "Option One" "Option Two" "Option Three"]
<div class="clear"></div>
[conditional radio]
<label> Why did you select option two? </label>
<div class="clear"></div>
[/conditional] 
[conditional radio-two]
<label> Why did you select option three? </label>
<div class="clear"></div>
[/conditional] 
<hr /> 
<h4>Condition for Field Type: <strong>Checkboxes</strong></h4>
Select <strong>"Option Two"</strong> or <strong>"Option Three"</strong> to test it out 
<label>Choose your preference</label>
[checkbox checkbox-266 use_label_element "Option One" "Option Two" "Option Three"]
<div class="clear"></div>
[conditional checkbox]
<label> Why did you select option two? </label>
<div class="clear"></div>
[/conditional] 
[conditional checkbox-two]
<label> Why did you select option three? </label>
<div class="clear"></div>
[/conditional] 
<hr /> 
<label> Insert Your E-mail
[email* your-email-two] </label> 
[submit "Submit"]';
		break;

	case "subscription":
		$form = '<label> First Name:
    [text* first-name placeholder "John"] </label> 
<label> Last Name:
    [text* last-name placeholder "Doe"] </label> 
<label> Email Address:
    [email* email-address placeholder "johndoe@example.com"] </label> 
<label> Phone Number:
    [tel tel-number placeholder "+1234567890"] </label> 
<label> Address:
    [textarea address placeholder "123 Main St, City, Country"] </label> 
<label> Subscription Plan:
    [select subscription-plan "Basic" "Premium" "Gold"] </label> 
<label> Terms and Conditions:
    [acceptance acceptance-terms] I accept the terms and conditions. [/acceptance] </label> 
[submit "Subscribe Now"]';
		break;

	case "blog":
		$form = apply_filters( 'uacf7_post_submission_form_ai_generator', esc_html( 'To generate this form, please download “Ultimate Post Submission Addon” from our client portal and activate' ), $uacf7_default );

		break;

	case "feedback":
		$form = '<label> Your Name
    [text* your-name]  </label> 
<label> Your Email
    [email* your-email]  </label> 
<label> Feedback Topic
    [select feedback-topic "Product" "Service" "Website" "Other"] </label> 
<label> Your Feedback
    [textarea* your-feedback]  </label> 
[submit "Submit Feedback"]';
		break;

	case "application":
		$form = '<label> Full Name
    [text* full-name]  </label> 
<label> Email Address
    [email* your-email]  </label> 
<label> Phone Number
    [tel tel-number] </label> 
<label> Position Applied For
    [select position "Software Developer" "Designer" "Marketing" "Sales" "Other"] </label> 
<label> Cover Letter
    [textarea cover-letter]  </label> 
<label> Upload Resume
    [file resume-file filetypes:pdf|doc|docx limit:2mb] </label> 
[submit "Submit Application"] ';
		break;

	case "inquiry":
		$form = '<label> Your Name (required)
    [text* your-name]  </label> 
<label> Your Email (required)
    [email* your-email]  </label> 
<label> Subject
    [text your-subject]  </label> 
<label> Your Inquiry
    [textarea your-inquiry]  </label> 
[submit "Send Inquiry"]';
		break;

	case "survey":
		$form = '<label> Your Name (required)
    [text* your-name]  </label> 
<label> Your Email (required)
    [email* your-email]  </label> 
<label> How did you hear about us?
    [radio hear-about-us "Search Engine" "Friend or Colleague" "Social Media" "Advertisement" "Other"] </label> 
<label> Rate our services (1 being poor, 5 being excellent)
    [uacf7_star_rating* rating selected:3 star1:1 star2:2 star3:3 star4:4 star5:5 "default"] </label> 
<label> What services or products are you most interested in?
    [checkbox services-use "Product A" "Service B" "Service C" "Product D" "None of the above"] </label> 
<label> Any suggestions for us to improve?
    [textarea suggestions]  </label> 
[submit "Submit Survey"]';
		break;

	case "address":
		$form = '<label> First Name
    [text* first-name placeholder "John"] </label> 
<label> Last Name
    [text* last-name placeholder "Doe"] </label> 
<label> Country
    [uacf7_country_dropdown* country] </label>  
<label> City
    [text* city placeholder "New York"] </label> 
<label> State/Province
    [text* state placeholder "NY"] </label> 
<label> Postal Code
    [text* postal-code placeholder "12345"] </label>  
<label> Street Address
    [text* street-address placeholder "123 Main St"] </label> 
<label> Phone Number
    [tel* phone-number placeholder "+1 234 567 8901"] </label> 
<label> Email Address
    [email* email-address placeholder "john.doe@example.com"] </label> 
[submit "Submit"]';
		break;

	case "event":
		$form = '<label> Full Name
    [text* full-name placeholder "John Doe"] </label> 
<label> Email Address
    [email* email-address placeholder "john.doe@example.com"] </label> 
<label> Phone Number
    [tel* phone-number placeholder "+1 234 567 8901"]
</label>  <label> Number of Attendees
    [number* number-of-attendees min:1 placeholder "1"] </label> 
<label> Event Date Preference
    [date* event-date] </label> 
<label> Dietary Preferences (if any)
    [textarea dietary-preferences] </label> 
<label> Any Special Requirements?
    [textarea special-requirements] </label> 
<label> Event Selection
    [select event-selection "Workshop A" "Workshop B" "Seminar X" "Seminar Y"] </label> 
[submit "Register"]';
		break;

	case "newsletter":
		$form = '<label> Full Name
    [text* full-name placeholder "John Doe"] </label> 
<label> Email Address
    [email* email-address placeholder "john.doe@example.com"]</label> 
[submit "Subscribe"]';
		break;

	case "donation":
		$form = '<label> Full Name
    [text* full-name placeholder "Jane Smith"] </label> 
<label> Email Address
    [email* email-address placeholder "jane.smith@example.com"] </label> 
<label> Phone Number (Optional)
    [tel tel-number placeholder "+1 234 567 8901"] </label> 
<label> Donation Amount
    [select donation-amount "Choose an amount" "10" "25" "50" "100" "Other"] </label> 
<label> Specify Other Amount (if selected above)
    [number other-amount placeholder "$"] </label> 
<label> Message (Optional)
    [textarea message placeholder "Your message or dedication..."] </label> 
[submit "Donate Now"]';
		break;

	case "product-review":
		$form = '<label> Your Name
    [text* your-name placeholder "Jane Smith"] </label> 
<label> Your Email
    [email* your-email placeholder "jane.smith@example.com"] </label> 
<label> Select Product
    [uacf7_product_dropdown* select-product] </label> 
<label> Purchase Date
    [date purchase-date] </label> 
<label> Overall Rating
    [uacf7_star_rating* rating selected:3 star1:1 star2:2 star3:3 star4:4 star5:5 "default"] </label> 
<label> Your Review Title
    [text review-title placeholder "A quick summary of your thoughts"] </label> 
<label> Detailed Review
    [textarea detailed-review placeholder "What did you like or dislike?"] </label> 
<label> Product Image 
    [file product-image filetypes:jpg|jpeg|png limit:2mb] </label> 
<label> Would you purchase this product again?
    [checkbox purchase-again "Yes"] </label> 
[submit "Submit Your Review"]';
		break;
	case "service-booking":
	case "appointment-form":
	case "booking":
		$form = apply_filters( 'uacf7_booking_form_ai_generator', esc_html( 'To generate this form, please download “Ultimate booking Addon” from our client portal and activate' ), $uacf7_default );

		break;

	case "rating":
		$form = '<label> Name
    [text* name placeholder "John Doe"] </label> 
<label> Email Address
    [email* email-address placeholder "john.doe@example.com"] </label> 
<label> Rate Our Service 
    [uacf7_star_rating* rating selected:3 star1:1 star2:2 star3:3 star4:4 star5:5 "default"]  </label> 
<label> Comments or Feedback
    [textarea feedback placeholder "Please share your feedback"] </label> 
[submit "Submit Rating"]';
		break;


	case "repeater":
		$form = apply_filters( 'uacf7_repeater_form_ai_generator', esc_html( 'To generate this form, please download “Ultimate Repeater Addon” from our client portal and activate  ultimate repeater Addon first' ), $uacf7_default );

		break;

	case "conversational-appointment-form":
	case "conversational-interview-form":
		$form = apply_filters( 'uacf7_conversational_form_ai_generator', esc_html( 'To generate this form, please download “ultimate Conversational Form Addon” from our client portal and activate ultimate repeater Addon first' ), $uacf7_default );

		break;


	default:
		$form = "Sorry, we couldn't find a matching form for the keyword " . $uacf7_default[1] . ". Please try another keyword or consult the Form Generator AI for assistance.";
		break;
}

ob_clean();
echo $form;
return ob_get_clean();
?>