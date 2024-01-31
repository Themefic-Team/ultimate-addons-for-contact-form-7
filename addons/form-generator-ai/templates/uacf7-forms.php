<?php
defined( 'ABSPATH' ) || exit;

/**
 * Template for the Form Generator AI Form.
 *
 * @package   UACF7
 * @subpackage Form Generator AI
 * @since     1.0.0
 * @Author:  Sydur Rahman, M Hemel Hasan and Masum Billah
 */

switch ( $uacf7_default[1] ) {
	// Start Form from MHemelHasan
	case 'basis-contact-form':
		$form =
			'<div class="uacf7-wrapper-default">
    [uacf7-row]
        [uacf7-col col:6]
            <label> First Name *
                [text* your-first-name autocomplete:first-name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
            <label> Last Name *
                [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
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
                [text* last-name autocomplete:last-name] </label>  [/uacf7-col]
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
                [email* email-address autocomplete:email placeholder "Your Mail Address"] </span> 
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
                [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
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
        <label> Which game you want to play? *
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

	case 'survey-form':
		$form = '<div class="uacf7-wrapper-default">
    <h3>Client Satisfaction Survey</h3>
    <hr>
    <br>
    <label> Which product did you purchase? *
        [select* product-list class:uacf7-drop-down "Office Accessories" "Home appliance" "Digital Product" "Garage Hardware"] </label>
    <label> What was your primary reason for purchasing the product? *
        [textarea* primary-reason] </label>
    <label> What three features are most important to you? *
        [checkbox* question-1 class:uacf7-checkbox "Custom responses" "Custom integrations" "Expanded functionality" "Easy to navigate" "Offline capabilities"] </label>
    <label> How can we improve our products/services? *
        [textarea* improvements] </label>
    <label> Would you use our product / service in the future?
        [radio question-2 class:uacf7-radio default:1 "Definitely" "Probably" "Not Sure" "Probably Not"] </label>
    <div class="uacf7-submint">
        [submit "Submit Form"]
    </div>
</div>';
		break;
	case 'complaint-form':
		$form = '<div class="uacf7-wrapper-default">
    <h3>Customer Information</h3>
    <hr>
    <br>
    [uacf7-row]
        [uacf7-col col:6]
            <label> First Name *
                [text* your-first-name autocomplete:first-name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
            <label> Last Name *
                [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
    [/uacf7-row]

    <label> Product Name *
        [text* product-name] </label> 
    <label> Product ID *
        [text* product-id] </label> 

    [uacf7-row]
        [uacf7-col col:6]
            [uacf7-row]
                [uacf7-col col:6]    
                    <label> Address Line 1 *
                        [text* address-1] </label> [/uacf7-col]
                [uacf7-col col:6]
                    <label> Address Line 2 
                        [text address-1] </label> [/uacf7-col]
            [/uacf7-row]
        [/uacf7-col]
        [uacf7-col col:6]
            <label> Country
                [uacf7_country_dropdown uacf7_country_974] </label>
        [/uacf7-col]
    [/uacf7-row]

    [uacf7-row]
        [uacf7-col col:6]
            [uacf7-row]
                [uacf7-col col:6]    
                    <label> City *
                        [text* country_city] </label> [/uacf7-col]
                [uacf7-col col:6]
                    <label> State 
                        [text country_state] </label> [/uacf7-col]
            [/uacf7-row]
        [/uacf7-col]
        [uacf7-col col:6]
            <label> Zip Code *
                [number* zip-code] </label>
        [/uacf7-col]
    [/uacf7-row]

    [uacf7-row]
        [uacf7-col col:6] 
            <label> Phone *
                [tel* phone] </label> [/uacf7-col]
        [uacf7-col col:6]
            <label> Email *
                [email* your-email autocomplete:email placeholder "Email Address"] </label> [/uacf7-col]
    [/uacf7-row]

    <h3>Complaint Information</h3>
    <hr>
    <br>
    <label> Complaint Date *
        [date* complaint-date min:2019-01-16] </label>
    <label> Complaint Details:
        [textarea complaint-details] </label>
    <label> What action needs to be taken to resolve this issue?
        [textarea complaint-action] </label>
    <div class="uacf7-submint fill">
        [submit "Submit Form"]
    </div>
</div>';
		break;

	case 'service-order':
		$form = '<div class="uacf7-wrapper-default">
    [uacf7-row]
        [uacf7-col col:6]
            <label> First Name *
                [text* your-first-name autocomplete:first-name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
            <label> Last Name *
                [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
    [/uacf7-row]

        <label> Email *
            [email* your-email autocomplete:email placeholder "Email Address"] </label>

    [uacf7-row]
        [uacf7-col col:6]
            <label> Choose Service *
                [checkbox* question-1 class:uacf7-checkbox "Service Items 1 - $10/ Hour" "Service Items 2 - $15/ Hour" "Service Items 3 - $20/ Hour"] </label>
        [/uacf7-col]
        [uacf7-col col:6]
            <label> How many hours *
                [number* how-hours] </label>
        [/uacf7-col]
    [/uacf7-row]

    <div class="uacf7-submint fill end">
        [submit "Submit Order Form"]
    </div>
</div>';
		break;

	case 'proposal':
		$form = '<div class="uacf7-wrapper-default">
    [uacf7-row]
        [uacf7-col col:6]
            <label> First Name *
                [text* your-first-name autocomplete:first-name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
            <label> Last Name *
                [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
    [/uacf7-row]

    <label> Job Title *
        [text* job-title] </label>
    <label> Company Name *
        [text* company-name] </label>
    <label> Biography
        [textarea biography] </label>
    <label> Email *
        [email* your-email autocomplete:email] </label>
    <label> Proposal Title
        [text proposal-title] </label>
    <label> Short Description
        [textarea short-disc] </label>
    <label> Abstract
        [textarea abstract] </label>
    <label> Topics
        [radio topics class:uacf7-radio default:1 "Topics 1" "Topics 2" "Topics 3" "Topics 4"] </label>
    <label> Session Type
        [select session-type class:uacf7-drop-down "Panel" "Work shop" "Presentation" "Other"] </label>
    <label> Audience Level
        [select audience-level class:uacf7-drop-down "Novice" "Intermediate" "Expert"] </label>
    <label> Video URL
        [url* video-url] </label>
    <label> Additional Information
        [textarea dditional-info] </label>

    <div class="uacf7-submint fill end">
        [submit "Submit Order Form"]
    </div>

</div>';
		break;

	case 'volunteer-sign-up-form':
		$form = '<div class="uacf7-wrapper-default">
    <h3 style="text-align: center;">Volunteer Sign Up</h3>
    <p style="text-align: center;">Come with us and help out your local community!</p>
    <br>
    <hr>
    <br>

    <label> Where would you like to volunteer (Check any that apply) *
        [checkbox* question-1 class:uacf7-checkbox "Food bank" "Animal shelter" "Preschool" "City lawn care" "Community Service"] </label>

    <label> How many hours a week can you dedicate?
        [text how-many-week] </label>

    <label> When are you available to start?
        [text starting-time] </label>

    [uacf7-row]
        [uacf7-col col:6]
            <label> First Name *
                [text* first-name autocomplete:first-name] </label> [/uacf7-col]
        [uacf7-col col:6] 
            <label> Last Name *
                [text* last-name autocomplete:last-name] </label>  [/uacf7-col]
        [uacf7-col col:6] 
            <label> Permanent Address
                [text address] </label>  [/uacf7-col]
        [uacf7-col col:6] 
            <label> City
                [text city] </label>  [/uacf7-col]
        [uacf7-col col:6] 
            <label> Phone
                [tel phone] </label>  [/uacf7-col]
        [uacf7-col col:6] 
            <label> Email
                [email* email autocomplete:email] </label>  [/uacf7-col]
    [/uacf7-row]

    <div class="uacf7-submint">
        [submit "Submit Form"]
    </div>

</div>';
		break;

	case 'donation-form':
		$form = '<div class="uacf7-wrapper-default">
    <p style="text-align: center;"><strong>Fillup this form to add to our doner list. </strong></p>
    <hr>
    <br>

    [uacf7-row]
        [uacf7-col col:6]
            <label> First Name *
                [text* first-name autocomplete:first-name] </label> [/uacf7-col]
        [uacf7-col col:6] 
            <label> Last Name *
                [text* last-name autocomplete:last-name] </label>  [/uacf7-col]
        [uacf7-col col:6] 
            <label> Phone
                [tel phone] </label>  [/uacf7-col]
        [uacf7-col col:6] 
            <label> Email
                [email* email autocomplete:email] </label>  [/uacf7-col]
    [/uacf7-row]

    [uacf7-row]
        [uacf7-col col:6]
            [uacf7-row]
                [uacf7-col col:6]    
                    <label> Address Line 1 *
                        [text* address-1] </label> [/uacf7-col]
                [uacf7-col col:6]
                    <label> Address Line 2 
                        [text address-1] </label> [/uacf7-col]
            [/uacf7-row]
        [/uacf7-col]
        [uacf7-col col:6]
            <label> Country
                [uacf7_country_dropdown uacf7_country] </label>
        [/uacf7-col]
    [/uacf7-row]

    [uacf7-row]
        [uacf7-col col:6]
            [uacf7-row]
                [uacf7-col col:6]    
                    <label> City *
                        [text* country_city] </label> [/uacf7-col]
                [uacf7-col col:6]
                    <label> State 
                        [text country_state] </label> [/uacf7-col]
            [/uacf7-row]
        [/uacf7-col]
        [uacf7-col col:6]
            <label> Zip Code *
                [number* zip-code] </label>
        [/uacf7-col]
    [/uacf7-row]

    <label> Amount you would like to donate
        [number donate-amount placeholder "e.g.: $10"] </label>

    <label> Your Preferred Method of Donation *
        [checkbox* question-1 class:uacf7-checkbox "Credit Card" "PayPal" "CashApp" "Wire Transfer" "Check"] </label>

    <label> How repeatedly do you want to donate? *
        [checkbox* question-2 class:uacf7-checkbox "One Time" "Yearly" "Monthly" "Weekly" "Daily"] </label>

    <div class="uacf7-submint">
        [submit "Submit Form"]
    </div>

</div>';
		break;

	// End Form from -MHemelHasan


    // Start Form from -Masum Billah
    case "blood-donation":
        $form = '<div class="uacf7-wrapper-default">

        <h3 style="text-align: center;">Blood Donation Form</h3>
    
        <p style="text-align: center;">Donate blood save life!</p>
    
        <br>
    
        <hr>
    
        <br>
    
        [uacf7-row]
    
            [uacf7-col col:6]
    
                <label> Donor\'s First Name *
                    [text* first-name autocomplete:first-name placeholder "First Name"] 
                </label> 
            [/uacf7-col]
    
            [uacf7-col col:6] 
    
                <label> Donor\'s Last Name *
                    [text* last-name autocomplete:last-name placeholder "Last Name"] </label>  
            [/uacf7-col]
        [/uacf7-row]
        [uacf7-row]
            [uacf7-col col:12] 
            <label> Date of Birth
                    [date date-of-birth placeholder "dd/mm/yy"] </label>
            [/uacf7-col]
        [/uacf7-row]
         <label> Donor\'s Email
    
            [email donors-email placeholder "Email"] </label>
         <label> Donor\'s Phone
    
            [tel donors-phone placeholder "Phone Number"] </label>
        [uacf7-row]
            [uacf7-col col:6]
                <label> Current Address
                    [text* donors-current-address placeholder "A/35 Lake Forest Drive Road"] 
                </label> 
            [/uacf7-col]
    
            [uacf7-col col:6] 
    
                <label> City
                [text* donors-city] </label>  
            [/uacf7-col]
        [/uacf7-row]
      [uacf7-row]
    
        [uacf7-col col:6]

            <label> State
                [text* donors-state] 
            </label> 
        [/uacf7-col]

        [uacf7-col col:6] 

            <label> Zip Code
            [text* donors-zip] </label>  
        [/uacf7-col]
        [/uacf7-row]
            <label> Country
            [text donors-country ] </label>
            <label> Blood Group
            [select* donor-blood-group include_blank "O+" "O-" "A+" "A-" "B+" "B-" "AB+" "AB-"] </label>
            <label> Have you done a blood donation before?
            [radio is-donated-before class:uacf7-radio default:1 "Yes" "No"] </label>
        <label> Do you have any known allergy?
            [radio if-allergy class:uacf7-radio default:1 "Yes" "No"]  </label>
        <div class="uacf7-submint">
            [submit "Submit Form"]
        </div>
    </div>';
    break;

    case "charity-dinner":
    $form = '<div class="uacf7-wrapper-default">
            <h2 style="text-align: center; color:#115e99;">Charity Dinner</h2>
            <p style="text-align: center; color: #115e99;">Charity dinner for refugee children!</p>
            <br>
            <hr>
            <br>
            [uacf7-row]
                [uacf7-col col:6]
                    <label> First Name *
                        [text* first-name autocomplete:first-name placeholder "First Name"] 
                    </label> 
                [/uacf7-col]
                [uacf7-col col:6] 
                    <label> Last Name *
                        [text* last-name autocomplete:last-name placeholder "Last Name"] </label>  
                [/uacf7-col]
            [/uacf7-row]
            [uacf7-row]
                [uacf7-col col:6]
                <label> Phone
                [tel donors-phone placeholder "Phone Number"] </label>
                    </label> 
                [/uacf7-col]
                [uacf7-col col:6] 
                <label>Email
                [email donors-email placeholder "Email"] </label
                [/uacf7-col]
            [/uacf7-row]
        <div class="uacf7-charity-dinner">
        <label> Will you attend ?

                [radio will-donor-attend class:uacf7-radio default:1 "Yes" "No"] </label>
        <label> Number of Guests
                [number total-guest min:1 placeholder "1-3"]  </label> 

        <label> Special Request
                [textarea* donor-special-request]  </label> 
            <div class="uacf7-submint">
                [submit "Submit Form"]
            </div>
        </div>
        </div>';
        break;
    case 'volunteer-application':
    $form = '<div class="uacf7-wrapper-default">  
        [uacf7-row]
        [uacf7-col col:6]
            <label> First Name *
                [text* first-name autocomplete:first-name placeholder "First Name"] 
            </label> 
        [/uacf7-col]
        [uacf7-col col:6] 
            <label> Last Name *
                [text* last-name autocomplete:last-name placeholder "Last Name"] </label>  
        [/uacf7-col]
        [/uacf7-row]
        <label>Email
        [email volunteer-email placeholder "Email"] </label
        <label> Contact No *
        [tel volunteer-phone placeholder "Phone Number"] </label>
            </label> 
        <br>
        [uacf7-row]
         [uacf7-col col:12]
        <label>Address</label>
        [/uacf7-col]
        [/uacf7-row]
        [uacf7-row]
        [uacf7-col col:6]
        <label> Address Line 1 *
            [text* volunteer-address-one] 
        </label> 
        [/uacf7-col]
        [uacf7-col col:6] 
        <label> Address Line 2 
            [text volunteer-address-two] 
        </label>    
        [/uacf7-col]
        [/uacf7-row]
        [uacf7-row]
        [uacf7-col col:6]
        <label> City *
            [text* volunteer-city] 
        </label> 
        [/uacf7-col]
        [uacf7-col col:6] 
        <label> State * 
            [text volunteer-state] 
        </label>    
        [/uacf7-col]
        [/uacf7-row]
        <label> Zip Code
            [text* volunteer-zip] </label> 
        <label> Working Days
            [checkbox volunteer-working-days class:uacf7-checkbox "Sunday" " Satarday" " Monday" " Tuesday" " Wednesday" " Thursday" " Friday"] </label>
        <label> Area of Interest/ skills
            [textarea* volunteer-interest]  </label> 
        <label> Comments (optional)
            [textarea* volunteer-comments]  </label> 
            <div class="uacf7-submint">
            [submit "Submit Form"]
        </div>
    </div>';
    break;

    case "graphic-designer-contact-form":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7-row]
            [uacf7-col col:6]
                <label> First Name *
                    [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
            [uacf7-col col:6] 
                <label> Last Name *
                    [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
        [/uacf7-row]
        <label> Email *
            [email* your-email autocomplete:email placeholder "Email Address"] </label>
        <label> Phone Number
                [tel your-phone  placeholder "Phone"] </label>
        <label> When is the best time to contact you?
                [text your-time  ] </label>
            <label> When is the best date to contact you?
                [date your-date  placeholder ] </label>
        <label> What can I help you with?
        [radio your-services class:uacf7-radio default:1 "Social Media Publication" " Prints & Ilustrations" " Website Design" " Other"]
                </label>
            <label> Describe your need *
                [textarea* your-message placeholder "Type your message here...."] </label>
            <label> When do you need the graphic designer? *
                [date* your-needing-date ] </label>
            <div class="uacf7-submint">
                [submit "Submit Form"]
            </div>
        </div>';
    break;
    case "hardware-request-form":
        $form = '<div class="uacf7-wrapper-default">
        <h3 style="text-align: center"> Hardware Request Form </h3>
        <p style="text-align: center"> This form will be used to request if any new hardware is needed in any department.</p>
        [uacf7-row]
            [uacf7-col col:6]
                <label> Requester\'s First Name *
                    [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
            [uacf7-col col:6] 
                <label> Requester\'s Last Name *
                [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
        [/uacf7-row]
        <label> Requester\'s Email *
            [email* your-email autocomplete:email placeholder "Email Address"] </label>
        <label> Requester\'s Phone Number *
            [tel your-phone  placeholder "Phone"] </label>
        <label> Department to Purchase*
            [text* your-purchase-dept  ] </label>
            <label> What type of hardware do you need?
        [select item-type include_blank "New Desktop" "New Laptop" "Laptop Table" "Accessories" "Others"] </label>
        <label> If you choose other, please write the name.
                [text your-other-choice  ] </label>
        <label> Choose Software to to be pre installed     
        [checkbox other-adobe-products class:uacf7-checkbox "Microsoft Office" " Adobe Products" " 3D Software"] </label>
            <label> Other Software / Instruction *
                [textarea* other-soft-instruction placeholder "Type your message here...."] </label>
            <label> Reason for the Request (Be Specific) *
                [textarea* other-soft-instruction placeholder "Type your message here...."] </label>
            <label> Date Submitted
                [date* your-needing-date ] </label>
            <div class="uacf7-submint">
                [submit "Submit Form"]
            </div>
        </div>';
    break;
    case "it-service-req":
        $form = '<div class="uacf7-wrapper-default">
        <p style="text-align: center; font-weight: bold;" > Please fill out this form and an IT service team member will be in touch with you shortly..</p>
        [uacf7-row]
            [uacf7-col col:6]
            <label> First Name *
                [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
            [uacf7-col col:6] 
        <label> Last Name *
            [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
        [/uacf7-row]
        <label>  Email *
            [email* your-email autocomplete:email placeholder "Email Address"] </label>
        <label> Department *
            [text* your-dept  ] </label>
        <label> What are you having issues with?
        [checkbox issue-with class:uacf7-checkbox "Computer" "Projector " "Internet Connection " "Others"] </label>
        [conditional others-conditional]
        <label> Others
                [text* your-others-issue  ] </label>
        [/conditional]
        <label> Any details we should know about?
                [textarea your-other-details  ] </label>
            <div class="uacf7-submint">
                [submit "Submit Request"]
            </div>
        </div>';
    break;

    case "request-for-quote":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7-row]
            [uacf7-col col:6]
            <label> First Name *
                [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
            [uacf7-col col:6] 
        <label> Last Name *
            [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
        [/uacf7-row]
        <label>  Email *
            [email* your-email autocomplete:email placeholder "Email Address"] </label>
        <label> Phone No *
            [tel* your-phone autocomplete:email placeholder "Phone No"] </label>
        <label> Prefered Method of Contact ? *
        [radio preffered-method class:uacf7-radio "Phone" "Email" "Others"] </label>
        [conditional others-conditional]
        <label> Others
                [text* your-others-method  ] </label>
        [/conditional]
        <label> Comments
                [textarea your-comments  ] </label>
            <div class="uacf7-submint">
                [submit "Submit Request"]
            </div>
        </div>';
    break;
    case "report-a-bug":
        $form = '<div class="uacf7-wrapper-default">
        <h3 style="text-align:center;">Report a Bug </h3>
        [uacf7-row]
        [uacf7-col col:6]
        <label> First Name *
            [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
            [uacf7-col col:6] 
        <label> Last Name *
            [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
        [/uacf7-row]
        <label>  Enter Your Email Address  *
            [email* your-email autocomplete:email placeholder "Email Address"] </label>
        <label> Title of the Issue *
            [text* your-issue-title  ] </label>
        <label> Problem Status *
            [select* your-problem-status include_blank "Open " "Hold" "Fixed " "Closed" "Invalid " "Others"] </label>
        [conditional others-conditional]
        <label> Others
            [text* your-others-status  ] </label>
            [/conditional]
        <label> Summary of the Information *
            [textarea* your-bug-summery  ] </label>
        <label> Steps to Reproduce *
            [textarea* your-reproduce-steps  ] </label>
        <label> Results *
            [textarea* your-step-result  ] </label>
        <label> Regression
            [textarea your-regression  ] </label>
        <label> Is there a Workaround?
            [radio question-1 class:uacf7-radio default:1 "Yes" "No"]</label>
        <label> Documentation & Notes
        [file document]
        </label>
         <label> Reproducibility *
               [select* your-reproducibility include_blank "I didn\'t try" "Rarely" "Sometimes" "Always"] </label>
        <label> Classification of Bug*
               [select* your-bug-classification include_blank "Security" "Crash/Hang/Data Loss" "Perfomance/Ui-Usability" "Serius Bug" "Other Bug" "Feature (New)" "Enhancement"] </label>
        <label> How severe it is? *
            [select* how-severe-is include_blank "Trivial" "Normal" "Major" "Critical"] </label>
                <div class="uacf7-submint">
                    [submit "Submit Bug Report"]
                </div>
            </div>';
    break;
    case "check-request":
        $form = '<div class="uacf7-wrapper-default">
        <h2 style="text-align:center;">Check Request</h2>
        <p style="text-align:center;">If you are in need of funds, please fill out the following check request. We will reach out to you once the request has been approved. If this is an emergency, please contact the financial department directly.</p>
        <h3>Requested By :</h3>
        [uacf7-row]
        [uacf7-col col:6]
        <label> First Name *
            [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
            [uacf7-col col:6] 
        <label> Last Name *
        [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
        [/uacf7-row]
        <label> Email *
            [email* your-email autocomplete:email placeholder "Email Address"] </label>
        <label> Date Requested 
         [date date-requested  ]</label>
       <label> Date Needed *
         [date* date-needed ]</label>
        <label> Purpose of Funds
            [text purpose-of-fund  ] </label>
        <label> Amount Requested ($) *
        [number* requested-amount min:1 ] </label>
        <h3>Make Payable To :</h3>
    [uacf7-row]
        [uacf7-col col:6]
        <label> First Name
        [text payable-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
    <label> Last Name
        [text payable-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
    [/uacf7-row]
    <label> Payable to Address </label>
    [uacf7-row]
        [uacf7-col col:6]
        <label> Address Line 1
        [text payable-address-1 ] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> Address Line 2
        [text payable-address-2 ] </label>  [/uacf7-col]
    [/uacf7-row]
    [uacf7-row]
    [uacf7-col col:6]
        <label> City
            [text payable-city ] </label> [/uacf7-col]
            [uacf7-col col:6] 
          <label> State
        [text payable-state ] </label>  [/uacf7-col]
    [/uacf7-row]
    [uacf7-row]
    [uacf7-col col:6]
        <label> Zip
            [text payable-zip ] </label> [/uacf7-col]
            [uacf7-col col:6] 
          <label> Country
        [text payable-country ] </label>  [/uacf7-col]
    [/uacf7-row]
       [acceptance acceptance-terms] I have read and agree to the Terms and Conditions and Privacy Policy [/acceptance]
            <div class="uacf7-submint">
                [submit "Submit Bug Report"]
            </div>
    </div>';
    break;
    case "vendor-contact":
        $form = '
        <div class="uacf7-wrapper-default">
            <label> Subject *
                [text* your-subject] </label>

            <label> Message *
                [textarea* your-message] </label>
            <div class="uacf7-submint end fill">
            [submit "Submit Form"]
            </div>
        </div>';
        break;
    case "request-a-leave":
       $form = '<div class="uacf7-wrapper-default">
       [uacf7-row]
        [uacf7-col col:6]
        <label> First Name *
         [text* your-first-name autocomplete:name ] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> Last Name *
        [text* your-last-name autocomplete:last-name ] </label>  [/uacf7-col]
        [/uacf7-row]
        <label> Email *
        [email* your-email] </label>
        <label> Contact No *
        [tel* your-contact-no] </label>
        <label> Position *
        [text* your-position] </label>
        <label> Manager *
        [tel* your-manager] </label>
        <label> Leave Start *
        [date* your-leave-start] </label>
       <label> Leave End *
        [date* your-leave-end] </label>
       <label> Leave Type *
            [radio leave-type class:uacf7-radio default:1 "Vacation" "Sick" "Quitting" "Maternity/Paternity" "Other"] </label>
            <label> Comments *
            [textarea* your-comments] </label>
        <div class="uacf7-submint end fill">
        [submit "Apply for Leave"]
        </div>
    </div>';  
    break;
    case "event-registration":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7-row]
        [uacf7-col col:6]
        <label> First Name *
            [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> Last Name *
            [text* your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
        [/uacf7-row]
        <label> Email
            [email* your-email autocomplete:email placeholder "email address"] </label>
        <label> Phone
            [tel* your-phone  placeholder "phone number"] </label>
        <label> Company
            [text company placeholder "company name" ] </label>
        <label> Website
            [url your-website placeholder "https://google.com"] </label>
        <label> Message (if any)
            [textarea your-message] </label>
         <div class="uacf7-submint">
        [submit "Submit Form"]
        </div>
        </div>';
        break; 
    case "tell-a-friend":
        $form = '<div class="uacf7-wrapper-default">
            [uacf7-row]
            [uacf7-col col:6]
                <label> First Name *
                    [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
            [uacf7-col col:6] 
                <label> Last Name 
                    [text your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
            [/uacf7-row]
            <label> To *
                [text* message-to ] </label>
            <label> Message
                [textarea your-message] </label>
            <div class="uacf7-submint">
            [submit "Send Message"]
            </div>
        </div>';
        break;
    case "accident-report-form":
        $form = '<div class="uacf7-wrapper-default">
        <label> I am reporting a :
        [checkbox accident-type class:uacf7-checkbox "Loss of time/injury" "Work vehicle accident" "Work accident" "First aid incident" "Observation"]
        </label>
        <h3> Person Reporting Incident </h3>
        [uacf7-row]
        [uacf7-col col:6]
        <label> First Name *
        [text* your-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> Last Name 
        [text your-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
        [/uacf7-row]
        <h3> Person Involved in Incident </h3>
        [uacf7-row]
        [uacf7-col col:6]
        <label> First Name *
        [text* involved-first-name autocomplete:name placeholder "First Name"] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> Last Name 
        [text involved-last-name autocomplete:last-name placeholder "Last Name"] </label>  [/uacf7-col]
        [/uacf7-row]
        <label> Incident Date and Time *
        [date* accident-date-time ] </label>
        <label> Location of Incident
        [text* location-of-incident ] 
        <label> Please describe the event in detail.
        [textarea your-incident-details] </label>
        <label> Was damage done to the property?
        [radio is-damaged class:uacf7-radio default:1 "Yes" "No"]
        </label>
        <label> How many hours were lost because of this incident?
          [text incident-hours-lost ] 
        </label>
        <label> What first aid measures were needed?
        [textarea your-incident-aid] </label>
        <label> Could this incident been avoided?
        [radio could-avoided class:uacf7-radio default:1 "Yes" "No"]
        </label>
        [acceptance acceptance-terms optional] I certify that the information I have provided is truthful to the best of my knowledge. [/acceptance]
            <div class="uacf7-submint">
            [submit "Send Message"]
            </div>
        </div>';
        break;

    case "complaint-form-2":
        $form = '<div class="uacf7-wrapper-default">
        <h4 style="text-align:center"> Please fill out the following form with your complaint. We will review your request and follow up with you as soon as possible. </h4>
        [uacf7-row]
        
            [uacf7-col col:6]
    
            <label> First Name *
    
            [text* your-first-name autocomplete:name ] </label> [/uacf7-col]
    
            [uacf7-col col:6] 
    
            <label> Last Name 
    
            [text your-last-name autocomplete:last-name ] </label>  [/uacf7-col]
    
            [/uacf7-row]
        <label> Email
        [email* your-email autocomplete:email] </label>
        <label> Address </label>
        [uacf7-row]
        [uacf7-col col:6]
        <label> Address Line 1
        [text address-1 ] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> Address Line 2
        [text address-2 ] </label>  [/uacf7-col]
        [/uacf7-row]
        [uacf7-row]
        [uacf7-col col:6]
        <label> City
        [text city ] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> State
        [text state ] </label>  [/uacf7-col]
        [/uacf7-row]
        [uacf7-row]
        [uacf7-col col:6]
        <label> Zip
        [text zip ] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> Country
        [text country ] </label>  [/uacf7-col]
        [/uacf7-row]
        <label> Date of incident 
        [date date-of-incident]
        </label>
        <label> Please describe the incident you would like to report.
        [textarea incident-details]
        </label>
        <label> How would you like to see this incident resolved?
        [textarea incident-resolved-details]
        </label>
        [acceptance acceptance-terms optional] All the data I submitted is truthfull, and I am responsible for that. [/acceptance]
            <div class="uacf7-submint">
            [submit "Submit Form"]
            </div>
        </div>';
        break;
    case "directory-information":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7-row]
        [uacf7-col col:6]
        <label> First Name *
        [text* your-first-name autocomplete:name ] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> Last Name 
        [text your-last-name autocomplete:last-name ] </label>  [/uacf7-col]
        [/uacf7-row]
        <label> Username *
        [text* your-username] </label>
        <label> Site Address*
        [text* your-site-address] </label>
            <label> Do you want to share your password?
        [radio wanna-share-password class:uacf7-radio default:2 "Yes" "No"] </label>
            <div class="uacf7-submint">
            [submit "Submit Informations"]
            </div>
        </div>';
        break;
    case "patient-intake-form":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7-row]
        [uacf7-col col:6]
        <label> First Name *
        [text* first-name autocomplete:name ] </label> [/uacf7-col]
        [uacf7-col col:6] 
        <label> Last Name 
        [text last-name autocomplete:last-name ] </label>  [/uacf7-col]
        [/uacf7-row]
        <label> Patient Age *
        [number* patient-age min:0] </label>
        <label> Preferred Name / Nickname *
        [text* patient-nickname] </label>
            <label> Patient Gender *
        [select patient-gender include_blank "Male" "Female" "Others"] </label>
        <label> Phone no. *
                [tel* patient-phone] </label>
        <label> Spouse Name
                [text patient-spouse ] </label>
        <label> With whome do you live?
                [text patient-live-with] </label>
        <label> Marital Status *
                [radio patient-marital-status class:uacf7-radio "Married" "Unmarried" "Others"] </label>
        <label> Occupation
                [text patient-occupation placeholder "If retired or disabled then enter your last occupation"] </label>
        <label> Retired? *
            [radio is-retired class:uacf7-radio default:2 "Yes" "No"]
        </label>
        <label> Disability ?*
            [radio is-disabled class:uacf7-radio default:2 "Yes" "No"]
        </label>
        <label> Who is your primary care doctor:?
                [text primary-care-doctor] </label>
        <label> Where is your primary care doctor located ?

                [text primary-care-doctor-located] </label>
        <label> Phone Number of primary care doctor:
                [tel primary-care-doctor-phone] </label>
        <label> Allergic to any medications? *
            [radio is-allergic  class:uacf7-radio default:2 "Yes" "No"]
        </label>
        <label> Do you smoke?*
            [radio is-smoke class:uacf7-radio default:2 "Yes" "No"]
        </label>
        <label> If you quit, when did you stop?
                [text if-quit ] </label>
        <label> Do you drink alcohol?
                [text if-alcohol] </label>
        <label> Personal opinion
                [textarea personal-opinion] </label>
        <div class="uacf7-submint">
            [submit "Submit Form"]
            </div>
        </div>';
    break;
    case "market-research-survey":
        $form = '<div class="uacf7-wrapper-default">
        <h3>Market Research Survey</h3>
        <hr>
        <br>
        [uacf7_step_start uacf7_step_start-367]   
        <label> How often do you use our product? 
                [checkbox how-often-use class:uacf7-checkbox "More than once a week" " Once a week" " Monthly" " Every other month" " A few times a year"] </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-368]
        <label> What similar products do you use? (by name and brand)
        [textarea about-similar-product]
        </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-369]   
        <label> When did you last purchase our product? 
            [checkbox last-purchased-product class:uacf7-checkbox "Less than 1 month ago" "Between 1 month and 6 months ago" "Between 6 months and 1 year ago" " More than one year ago" " I don\'t remember"] </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-370]
        <label> What similar products do you use? (by name and brand)
        [textarea about-similar-product-2]
        </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-371]   
        <label> When did you last purchase our product? 
            [checkbox last-purchased-product-2 class:uacf7-checkbox "Less than 1 month ago" "Between 1 month and 6 months ago" "Between 6 months and 1 year ago" " More than one year ago" " I don\'t remember"] </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-372]   
        <label> Have you had a chance to review our newest product? 
            [radio newest-product class:uacf7-radio "Yes" "No"] </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-373]   
        <label> What do you think of our new product? 
            [textarea about-new-product] </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-374]   
        <label> What is your least favorite thing about our new product? 
            [textarea favorite-about-new-product] </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-375]   
        <label> How do you feel our products pricing compares with other similar products? 
            [checkbox pricing-with-similar-product class:uacf7-checkbox "Less expensive" "About the same price" "More expensive"] </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-376] 
        <h3> Tell us a little about yourself. </h3>
        <hr>  
        <label> What is your age range?
            [radio age-range class:uacf7-radio default:1 "18 or younger" " 19 - 24" " 25 - 34" " 35 - 44" " 45 - 54" " 55 or older"] </label> 
        <label> What country are you from?
            [text* country] </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-400]
            <div class="uacf7-submint">
                [submit "Submit Form"]
            </div>
        [uacf7_step_end end]
    </div>';
    break;
    case "database-management": 
        $form = '<div class="uacf7-wrapper-default">
        [uacf7-row]
        [uacf7-col col:6]
        <label> First Name
        [text first-name autocomplete:first-name ] 
        </label>
        [/uacf7-col]
        [uacf7-col col:6] 
        <label> Last Name 
        [text last-name autocomplete:last-name ] </label>  
        [/uacf7-col]
        [/uacf7-row]
        <label> Email
        [email email autocomplete:email ] </label> 
       <label> Phone Number
        [tel phone-number  ] </label> 
       <label> Address </label>
       [uacf7-row]
        [uacf7-col col:6]
        <label> Address Line 1
        [text address-line-1 ] 
        </label> 
        <label> City
        [text city ] 
        </label> 
        <label> Zip Code
        [text zip-code ] 
         </label> 
        [/uacf7-col]
        [uacf7-col col:6] 
        <label> Address Line 2
        [text address-line-2 ] 
        </label> 
        <label> State
        [text state] 
        </label> 
        <label> Country
        [text country] 
        </label>
        [/uacf7-col]
       [/uacf7-row]
       <label> Describe your current issues/needs * 
       [textarea* current-issue ]
       </label>
       <label> Describe your current system if applicable *
       [textarea* current-system]
       </label>
       
       <label> What is your expertise with managing your database?
       [select db-expertise class:uacf7-select include_black "Novice" "Intermediate" "Expert"]
       </label>
       <label> Do you need an internet in your office?
       [radio if-internet-need class:uacf7-radio"Yes" "No"]
       </label>
       <label> Software Type
       [select software-type class:uacf7-select include_blank "Accounting and Financial Management" "Asset Management" "Business Intelligence and Data Management Customer" "Relationship Management (CRM)" "Enterprise Resource Planning (ERP)" "Human Capital Management (HCM)" "Information Management and Collaboration" "Product Lifecycle Management (PLM)" "Project and Process Management" "Supply Chain Management (SCM)"]
       </label>
       <label> Business Area
       [select business-area class:uacf7-select include_blank "Sales and Marketing" "Professional Services and Support" "Production and Distribution" "IT Management and Development" "Data Management and Analysis" "Back Office and Operation"]
       </label>
       <label> Needed Requirements, Functionality, or Specification
       [textarea needed-requirements ]
       </label>
       <label> Desired deliverables
       [textarea desired-deliverables]
       </label>
       <label> When do you need the support? *
       [date* support-needed-date]
       </label>
       <label> What is your budget? *
       [number* your-budget min:1]
       </label>
          
       <label>Will this system be sold as third party software?
       [radio third-party-software class:uacf7-radio"Yes" "No"]
       </label>
       <label>Will you need back up services?
       [radio need-backup-services class:uacf7-radio"Yes" "No"]
       </label>
       <label>Will you need virus protection?
       [radio need-virus-protection class:uacf7-radio "Yes" "No"]
       </label>
       <label>Upload any supporting documents.
       [file supporting-docs ]
       </label>
          <div class="uacf7-submint">
               [submit "Submit Form"]
          </div>
       </div>';
    break;
    // End Form from -Masum Billah	

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