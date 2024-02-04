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
                        [text* donors-state] </label> 
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
                    [tel donors-phone placeholder "Phone Number"] 
                </label>
            [/uacf7-col]
            [uacf7-col col:6] 
                <label>Email
                    [email donors-email placeholder "Email"] 
                </label>
            [/uacf7-col]
        [/uacf7-row]
    
        <div class="uacf7-charity-dinner">
            <label> Will you attend?
                [radio will-donor-attend class:uacf7-radio default:1 "Yes" "No"] 
            </label>
            
            <label> Number of Guests
                [number total-guest min:1 placeholder "1-3"]  
            </label> 
    
            <label> Special Request
                [textarea* donor-special-request]  
            </label> 
    
            <div class="uacf7-submint">
                [submit "Submit Form"]
            </div>
        </div>
    </div>';
    break;
    
    case 'volunteer-application':
        $form = '
        <div class="uacf7-wrapper-default">
            [uacf7-row]
                [uacf7-col col:6]
                    <label> First Name *
                        [text* first-name autocomplete:first-name placeholder "First Name"] 
                    </label>
                [/uacf7-col]
                [uacf7-col col:6] 
                    <label> Last Name *
                        [text* last-name autocomplete:last-name placeholder "Last Name"] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            <label>Email
                [email volunteer-email placeholder "Email"] 
            </label>
            
            <label>Contact No *
                [tel volunteer-phone placeholder "Phone Number"] 
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
                [text* volunteer-zip] 
            </label>
            
            <label> Working Days
                [checkbox volunteer-working-days class:uacf7-checkbox "Sunday" "Satarday" "Monday" "Tuesday" "Wednesday" "Thursday" "Friday"] 
            </label>
            
            <label> Area of Interest/ skills
                [textarea* volunteer-interest]  
            </label>
            
            <label> Comments (optional)
                [textarea* volunteer-comments]  
            </label>
            
            <div class="uacf7-submint">
                [submit "Submit Form"]
            </div>
        </div>';
        break;
    
    case "graphic-designer-contact-form":
        $form = '
        <div class="uacf7-wrapper-default">
            [uacf7-row]
                [uacf7-col col:6]
                    <label> First Name *
                        [text* your-first-name autocomplete:name placeholder "First Name"] 
                    </label> 
                [/uacf7-col]
                [uacf7-col col:6] 
                    <label> Last Name *
                        [text* your-last-name autocomplete:last-name placeholder "Last Name"] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            <label> Email *
                [email* your-email autocomplete:email placeholder "Email Address"] 
            </label>
            
            <label> Phone Number
                [tel your-phone  placeholder "Phone"] 
            </label>
            
            <label> When is the best time to contact you?
                [text your-time] 
            </label>
            
            <label> When is the best date to contact you?
                [date your-date placeholder] 
            </label>
            
            <label> What can I help you with?
                [radio your-services class:uacf7-radio default:1 "Social Media Publication" "Prints & Illustrations" "Website Design" "Other"]
            </label>
            
            <label> Describe your need *
                [textarea* your-message placeholder "Type your message here...."] 
            </label>
            
            <label> When do you need the graphic designer? *
                [date* your-needing-date] 
            </label>
            
            <div class="uacf7-submint">
                [submit "Submit Form"]
            </div>
        </div>';
        break;
    
    case "hardware-request-form":
        $form = '
        <div class="uacf7-wrapper-default">
            <h3 style="text-align: center"> Hardware Request Form </h3>
            <p style="text-align: center"> This form will be used to request if any new hardware is needed in any department.</p>
            
            [uacf7-row]
                [uacf7-col col:6]
                    <label> Requester\'s First Name *
                        [text* your-first-name autocomplete:name placeholder "First Name"] 
                    </label> 
                [/uacf7-col]
                [uacf7-col col:6] 
                    <label> Requester\'s Last Name *
                        [text* your-last-name autocomplete:last-name placeholder "Last Name"] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            <label> Requester\'s Email *
                [email* your-email autocomplete:email placeholder "Email Address"] 
            </label>
            
            <label> Requester\'s Phone Number *
                [tel your-phone  placeholder "Phone"] 
            </label>
            
            <label> Department to Purchase*
                [text* your-purchase-dept] 
            </label>
            
            <label> What type of hardware do you need?
                [select item-type include_blank "New Desktop" "New Laptop" "Laptop Table" "Accessories" "Others"] 
            </label>
            
            <label> If you choose other, please write the name.
                [text your-other-choice] 
            </label>
            
            <label> Choose Software to be pre-installed     
                [checkbox other-adobe-products class:uacf7-checkbox "Microsoft Office" "Adobe Products" "3D Software"] 
            </label>
            
            <label> Other Software / Instruction *
                [textarea* other-soft-instruction placeholder "Type your message here...."] 
            </label>
            
            <label> Reason for the Request (Be Specific) *
                [textarea* other-soft-instruction placeholder "Type your message here...."] 
            </label>
            
            <label> Date Submitted
                [date* your-needing-date] 
            </label>
            
            <div class="uacf7-submint">
                [submit "Submit Form"]
            </div>
        </div>';
        break;    
    case "it-service-req":
        $form = '
        <div class="uacf7-wrapper-default">
            <p style="text-align: center; font-weight: bold;">Please fill out this form, and an IT service team member will be in touch with you shortly.</p>
            
            [uacf7-row]
                [uacf7-col col:6]
                    <label> First Name *
                        [text* your-first-name autocomplete:name placeholder "First Name"] 
                    </label> 
                [/uacf7-col]
                
                [uacf7-col col:6] 
                    <label> Last Name *
                        [text* your-last-name autocomplete:last-name placeholder "Last Name"] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            <label>Email *
                [email* your-email autocomplete:email placeholder "Email Address"] 
            </label>
            
            <label>Department *
                [text* your-dept] 
            </label>
            
            <label>What are you having issues with?
                [checkbox issue-with class:uacf7-checkbox "Computer" "Projector" "Internet Connection" "Others"] 
            </label>
            
            [conditional others-conditional]
                <label>Others
                    [text* your-others-issue] 
                </label>
            [/conditional]
            
            <label>Any details we should know about?
                [textarea your-other-details] 
            </label>
            
            <div class="uacf7-submint">
                [submit "Submit Request"]
            </div>
        </div>';
        break;
    
    case "request-for-quote":
        $form = '
        <div class="uacf7-wrapper-default">
            [uacf7-row]
                [uacf7-col col:6]
                    <label> First Name *
                        [text* your-first-name autocomplete:name placeholder "First Name"] 
                    </label> 
                [/uacf7-col]
                
                [uacf7-col col:6] 
                    <label> Last Name *
                        [text* your-last-name autocomplete:last-name placeholder "Last Name"] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            <label>Email *
                [email* your-email autocomplete:email placeholder "Email Address"] 
            </label>
            
            <label>Phone No *
                [tel* your-phone autocomplete:email placeholder "Phone No"] 
            </label>
            
            <label>Prefered Method of Contact? *
                [radio preffered-method class:uacf7-radio "Phone" "Email" "Others"] 
            </label>
            
            [conditional others-conditional]
                <label>Others
                    [text* your-others-method] 
                </label>
            [/conditional]
            
            <label>Comments
                [textarea your-comments] 
            </label>
            
            <div class="uacf7-submint">
                [submit "Submit Request"]
            </div>
        </div>';
        break;
    
    case "report-a-bug":
        $form = '
        <div class="uacf7-wrapper-default">
            <h3 style="text-align:center;">Report a Bug</h3>
            
            [uacf7-row]
                [uacf7-col col:6]
                    <label> First Name *
                        [text* your-first-name autocomplete:name placeholder "First Name"] 
                    </label> 
                [/uacf7-col]
                
                [uacf7-col col:6] 
                    <label> Last Name *
                        [text* your-last-name autocomplete:last-name placeholder "Last Name"] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            <label>Enter Your Email Address  *
                [email* your-email autocomplete:email placeholder "Email Address"] 
            </label>
            
            <label>Title of the Issue *
                [text* your-issue-title] 
            </label>
            
            <label>Problem Status *
                [select* your-problem-status include_blank "Open" "Hold" "Fixed" "Closed" "Invalid" "Others"] 
            </label>
            
            [conditional others-conditional]
                <label>Others
                    [text* your-others-status] 
                </label>
            [/conditional]
            
            <label>Summary of the Information *
                [textarea* your-bug-summery] 
            </label>
            
            <label>Steps to Reproduce *
                [textarea* your-reproduce-steps] 
            </label>
            
            <label>Results *
                [textarea* your-step-result] 
            </label>
            
            <label>Regression
                [textarea your-regression] 
            </label>
            
            <label>Is there a Workaround?
                [radio question-1 class:uacf7-radio default:1 "Yes" "No"] 
            </label>
            
            <label>Documentation & Notes
                [file document] 
            </label>
            
            <label>Reproducibility *
                [select* your-reproducibility include_blank "I didn\'t try" "Rarely" "Sometimes" "Always"] 
            </label>
            
            <label>Classification of Bug*
                [select* your-bug-classification include_blank "Security" "Crash/Hang/Data Loss" "Performance/Ui-Usability" "Serious Bug" "Other Bug" "Feature (New)" "Enhancement"] 
            </label>
            
            <label>How severe is it? *
                [select* how-severe-is include_blank "Trivial" "Normal" "Major" "Critical"] 
            </label>
            
            <div class="uacf7-submint">
                [submit "Submit Bug Report"]
            </div>
        </div>';
        break;
    
    case "check-request":
        $form = '
        <div class="uacf7-wrapper-default">
            <h2 style="text-align:center;">Check Request</h2>
            <p style="text-align:center;">If you are in need of funds, please fill out the following check request. We will reach out to you once the request has been approved. If this is an emergency, please contact the financial department directly.</p>
            
            <h3>Requested By :</h3>
            
            [uacf7-row]
                [uacf7-col col:6]
                    <label> First Name *
                        [text* your-first-name autocomplete:name placeholder "First Name"] 
                    </label> 
                [/uacf7-col]
                
                [uacf7-col col:6] 
                    <label> Last Name *
                        [text* your-last-name autocomplete:last-name placeholder "Last Name"] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            <label>Email *
                [email* your-email autocomplete:email placeholder "Email Address"] 
            </label>
            
            <label>Date Requested 
                [date date-requested] 
            </label>
            
            <label>Date Needed *
                [date* date-needed] 
            </label>
            
            <label>Purpose of Funds
                [text purpose-of-fund] 
            </label>
            
            <label>Amount Requested ($)
                [number* requested-amount min:1] 
            </label>
            
            <h3>Make Payable To :</h3>
            
            [uacf7-row]
                [uacf7-col col:6]
                    <label> First Name
                        [text payable-first-name autocomplete:name placeholder "First Name"] 
                    </label> 
                [/uacf7-col]
                
                [uacf7-col col:6] 
                    <label> Last Name
                        [text payable-last-name autocomplete:last-name placeholder "Last Name"] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            <label>Payable to Address </label>
            
            [uacf7-row]
                [uacf7-col col:6]
                    <label> Address Line 1
                        [text payable-address-1] 
                    </label> 
                [/uacf7-col]
                
                [uacf7-col col:6] 
                    <label> Address Line 2
                        [text payable-address-2] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            [uacf7-row]
                [uacf7-col col:6]
                    <label> City
                        [text payable-city] 
                    </label> 
                [/uacf7-col]
                
                [uacf7-col col:6] 
                    <label> State
                        [text payable-state] 
                    </label>  
                [/uacf7-col]
            [/uacf7-row]
            
            [uacf7-row]
                [uacf7-col col:6]
                    <label> Zip
                        [text payable-zip] 
                    </label> 
                [/uacf7-col]
                
                [uacf7-col col:6] 
                    <label> Country
                        [text payable-country] 
                    </label>  
                [/uacf7-col]
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
                <label>Subject *
                    [text* your-subject] 
                </label>
        
                <label>Message *
                    [textarea* your-message] 
                </label>
                
                <div class="uacf7-submint end fill">
                    [submit "Submit Form"]
                </div>
            </div>';
            break;
        
        case "request-a-leave":
            $form = '
            <div class="uacf7-wrapper-default">
                [uacf7-row]
                    [uacf7-col col:6]
                        <label> First Name *
                            [text* your-first-name autocomplete:name] 
                        </label> 
                    [/uacf7-col]
                    
                    [uacf7-col col:6] 
                        <label> Last Name *
                            [text* your-last-name autocomplete:last-name] 
                        </label>  
                    [/uacf7-col]
                [/uacf7-row]
                
                <label>Email *
                    [email* your-email] 
                </label>
                
                <label>Contact No *
                    [tel* your-contact-no] 
                </label>
                
                <label>Position *
                    [text* your-position] 
                </label>
                
                <label>Manager *
                    [tel* your-manager] 
                </label>
                
                <label>Leave Start *
                    [date* your-leave-start] 
                </label>
                
                <label>Leave End *
                    [date* your-leave-end] 
                </label>
                
                <label>Leave Type *
                    [radio leave-type class:uacf7-radio default:1 "Vacation" "Sick" "Quitting" "Maternity/Paternity" "Other"] 
                </label>
                
                <label>Comments *
                    [textarea* your-comments] 
                </label>
                
                <div class="uacf7-submint end fill">
                    [submit "Apply for Leave"]
                </div>
            </div>';  
            break;
        
        case "event-registration":
            $form = '
            <div class="uacf7-wrapper-default">
                [uacf7-row]
                    [uacf7-col col:6]
                        <label> First Name *
                            [text* your-first-name autocomplete:name placeholder "First Name"] 
                        </label> 
                    [/uacf7-col]
                    
                    [uacf7-col col:6] 
                        <label> Last Name *
                            [text* your-last-name autocomplete:last-name placeholder "Last Name"] 
                        </label>  
                    [/uacf7-col]
                [/uacf7-row]
                
                <label>Email
                    [email* your-email autocomplete:email placeholder "email address"] 
                </label>
                
                <label>Phone
                    [tel* your-phone  placeholder "phone number"] 
                </label>
                
                <label>Company
                    [text company placeholder "company name"] 
                </label>
                
                <label>Website
                    [url your-website placeholder "https://google.com"] 
                </label>
                
                <label>Message (if any)
                    [textarea your-message] 
                </label>
                
                <div class="uacf7-submint">
                    [submit "Submit Form"]
                </div>
            </div>';
            break; 
        
        case "tell-a-friend":
            $form = '
            <div class="uacf7-wrapper-default">
                [uacf7-row]
                    [uacf7-col col:6]
                        <label> First Name *
                            [text* your-first-name autocomplete:name placeholder "First Name"] 
                        </label> 
                    [/uacf7-col]
                    
                    [uacf7-col col:6] 
                        <label> Last Name 
                            [text your-last-name autocomplete:last-name placeholder "Last Name"] 
                        </label>  
                    [/uacf7-col]
                [/uacf7-row]
                
                <label>To *
                    [text* message-to ] 
                </label>
                
                <label>Message
                    [textarea your-message] 
                </label>
                
                <div class="uacf7-submint">
                    [submit "Send Message"]
                </div>
            </div>';
            break;
        
        case "accident-report-form":
            $form = '
            <div class="uacf7-wrapper-default">
                <label>I am reporting a:
                    [checkbox accident-type class:uacf7-checkbox "Loss of time/injury" "Work vehicle accident" "Work accident" "First aid incident" "Observation"]
                </label>
                
                <h3>Person Reporting Incident</h3>
                
                [uacf7-row]
                    [uacf7-col col:6]
                        <label> First Name *
                            [text* your-first-name autocomplete:name placeholder "First Name"] 
                        </label> 
                    [/uacf7-col]
                    
                    [uacf7-col col:6] 
                        <label> Last Name 
                            [text your-last-name autocomplete:last-name placeholder "Last Name"] 
                        </label>  
                    [/uacf7-col]
                [/uacf7-row]
                
                <h3>Person Involved in Incident</h3>
                
                [uacf7-row]
                    [uacf7-col col:6]
                        <label> First Name *
                            [text* involved-first-name autocomplete:name placeholder "First Name"] 
                        </label> 
                    [/uacf7-col]
                    
                    [uacf7-col col:6] 
                        <label> Last Name 
                            [text involved-last-name autocomplete:last-name placeholder "Last Name"] 
                        </label>  
                    [/uacf7-col]
                [/uacf7-row]
                
                <label>Incident Date and Time *
                    [date* accident-date-time ] 
                </label>
                
                <label>Location of Incident
                    [text* location-of-incident ] 
                </label>
                
                <label>Please describe the event in detail.
                    [textarea your-incident-details] 
                </label>
                
                <label>Was damage done to the property?
                    [radio is-damaged class:uacf7-radio default:1 "Yes" "No"]
                </label>
                
                <label>How many hours were lost because of this incident?
                    [text incident-hours-lost ] 
                </label>
                
                <label>What first aid measures were needed?
                    [textarea your-incident-aid] 
                </label>
                
                <label>Could this incident have been avoided?
                    [radio could-avoided class:uacf7-radio default:1 "Yes" "No"]
                </label>
                
                [acceptance acceptance-terms optional] I certify that the information I have provided is truthful to the best of my knowledge. [/acceptance]
                
                <div class="uacf7-submint">
                    [submit "Send Message"]
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
            <label> Could this incident have been avoided?
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
            <label> With whom do you live?
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
                <label>How often do you use our product? 
                    [checkbox how-often-use class:uacf7-checkbox "More than once a week" " Once a week" " Monthly" " Every other month" " A few times a year"] 
                </label>
            [uacf7_step_end end]
            
            [uacf7_step_start uacf7_step_start-368]
                <label>What similar products do you use? (by name and brand)
                    [textarea about-similar-product]
                </label>
            [uacf7_step_end end]
            
            [uacf7_step_start uacf7_step_start-369]   
                <label>When did you last purchase our product? 
                    [checkbox last-purchased-product class:uacf7-checkbox "Less than 1 month ago" "Between 1 month and 6 months ago" "Between 6 months and 1 year ago" " More than one year ago" " I don\'t remember"] 
                </label>
            [uacf7_step_end end]
            
            [uacf7_step_start uacf7_step_start-370]
                <label>What similar products do you use? (by name and brand)
                    [textarea about-similar-product-2]
                </label>
            [uacf7_step_end end]
            
            [uacf7_step_start uacf7_step_start-371]   
                <label>When did you last purchase our product? 
                    [checkbox last-purchased-product-2 class:uacf7-checkbox "Less than 1 month ago" "Between 1 month and 6 months ago" "Between 6 months and 1 year ago" " More than one year ago" " I don\'t remember"] 
                </label>
            [uacf7_step_end end]
            
            [uacf7_step_start uacf7_step_start-372]   
                <label>Have you had a chance to review our newest product? 
                    [radio newest-product class:uacf7-radio "Yes" "No"] 
                </label>
            [uacf7_step_end end]
            
            [uacf7_step_start uacf7_step_start-373]   
                <label>What do you think of our new product? 
                    [textarea about-new-product] 
                </label>
            [uacf7_step_end end]
            
            [uacf7_step_start uacf7_step_start-374]   
                <label>What is your least favorite thing about our new product? 
                    [textarea favorite-about-new-product] 
                </label>
            [uacf7_step_end end]
            
            [uacf7_step_start uacf7_step_start-375]   
                <label>How do you feel our product\'s pricing compares with other similar products? 
                    [checkbox pricing-with-similar-product class:uacf7-checkbox "Less expensive" "About the same price" "More expensive"] 
                </label>
            [uacf7_step_end end]
            
            [uacf7_step_start uacf7_step_start-376] 
                <h3> Tell us a little about yourself. </h3>
                <hr>  
                <label>What is your age range?
                    [radio age-range class:uacf7-radio default:1 "18 or younger" " 19 - 24" " 25 - 34" " 35 - 44" " 45 - 54" " 55 or older"] 
                </label> 
                <label>What country are you from?
                    [text* country] 
                </label>
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
                            [text first-name autocomplete:first-name ] </label>
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
                            [text address-line-1 ] </label> 
        
                        <label> City
                            [text city ] </label> 
        
                        <label> Zip Code
                            [text zip-code ] </label> 
                    [/uacf7-col]
        
                    [uacf7-col col:6] 
                        <label> Address Line 2
                            [text address-line-2 ] </label> 
        
                        <label> State
                            [text state] </label> 
        
                        <label> Country
                            [text country] </label>
                    [/uacf7-col]
                [/uacf7-row]
        
                <label> Describe your current issues/needs * 
                    [textarea* current-issue ] </label>
        
                <label> Describe your current system if applicable *
                    [textarea* current-system] </label>
        
                <label> What is your expertise with managing your database?
                    [select db-expertise class:uacf7-select include_black "Novice" "Intermediate" "Expert"] </label>
        
                <label> Do you need an internet in your office?
                    [radio if-internet-need class:uacf7-radio"Yes" "No"] </label>
        
                <label> Software Type
                    [select software-type class:uacf7-select include_blank "Accounting and Financial Management" "Asset Management" "Business Intelligence and Data Management Customer" "Relationship Management (CRM)" "Enterprise Resource Planning (ERP)" "Human Capital Management (HCM)" "Information Management and Collaboration" "Product Lifecycle Management (PLM)" "Project and Process Management" "Supply Chain Management (SCM)"] </label>
        
                <label> Business Area
                    [select business-area class:uacf7-select include_blank "Sales and Marketing" "Professional Services and Support" "Production and Distribution" "IT Management and Development" "Data Management and Analysis" "Back Office and Operation"] </label>
        
                <label> Needed Requirements, Functionality, or Specification
                    [textarea needed-requirements ] </label>
        
                <label> Desired deliverables
                    [textarea desired-deliverables] </label>
        
                <label> When do you need the support? *
                    [date* support-needed-date] </label>
        
                <label> What is your budget? *
                    [number* your-budget min:1] </label>
        
                <label>Will this system be sold as third party software?
                    [radio third-party-software class:uacf7-radio"Yes" "No"] </label>
        
                <label>Will you need back up services?
                    [radio need-backup-services class:uacf7-radio"Yes" "No"] </label>
        
                <label>Will you need virus protection?
                    [radio need-virus-protection class:uacf7-radio "Yes" "No"] </label>
        
                <label>Upload any supporting documents.
                    [file supporting-docs ] </label>
        
                <div class="uacf7-submint">
                    [submit "Submit Form"]
                </div>
            </div>';
            break;        

            case 'pricing-survey':
                $form = '<div class="uacf7-wrapper-default">
                    [uacf7_step_start uacf7_step_start-753]
                        <label> Are you currently a customer? *
                            [radio is-customer class:uacf7-radio default:1 "Yes" "No"] 
                        </label> 
                    [uacf7_step_end end]
                    [uacf7_step_start uacf7_step_start-754]
                        <label> Which plan are you subscribed to?* 
                            [radio subscribe-plan class:uacf7-radio default:1 "Plan A" "Plan B" "Plan C"] 
                        </label> 
                    [uacf7_step_end end]
                    [uacf7_step_start uacf7_step_start-755]
                        <label> How long have you been a customer? *
                            [radio how-long-as-customer class:uacf7-radio default:1 "Less than a month" " 1-6 months" " 6 months to 1 year" " 1-3 years" " More than 3 years"] 
                        </label> 
                    [uacf7_step_end end]
                    [uacf7_step_start uacf7_step_start-756]
                        <label> What do you like about our service?
                            [textarea about-our-services]
                        </label> 
                    [uacf7_step_end end]
                    [uacf7_step_start uacf7_step_start-757]
                        <label>What do you dislike about our service?
                            [textarea why-dislike]
                        </label> 
                    [uacf7_step_end end]
                    [uacf7_step_start uacf7_step_start-758]
                        <label>Would you recommend our product?*
                            [radio is-recommend class:uacf7-radio default:1 "Yes" "No"] 
                        </label> 
                    [uacf7_step_end end]
                    [uacf7_step_start uacf7_step_start-759]
                        <label>Do you have any additional comments or suggestions?
                            [textarea any-suggestion]
                        </label> 
                    [uacf7_step_end end]
                    [uacf7_step_start uacf7_step_start-800]
                        <div class="uacf7-submint">
                            [submit "Submit Form"]
                        </div>
                    [uacf7_step_end end]
                </div>';
                break;
            
            case "workshop-registration":
                $form = '<div class="uacf7-wrapper-default">
                    <h2 style="text-align: center; color:#3838b0"> Workshop Registration </h2>
                    <label style="text-align: center;"> You can Add a Logo </label>
                    <h5 style="text-align: center; color:#3838b0"> Date : December 05, 2020                 Time: 10:00 am           Address : 3491 Henry Ford Avenue, Tulsa, OK, Oklahoma, 74120 </h5>
                    <label> Name 
                        [text name]
                    </label> 
                    <label> Email
                        [email email]
                    </label> 
                    <label> Phone
                        [tel phone]
                    </label> 
                    <label> Company
                        [text company]
                    </label> 
                    [uacf7-row]
                        [uacf7-col col:6]
                            <label> Permanent Address
                                [text permanent-address ] 
                            </label> 
                            <label> City
                                [text city ] 
                            </label> 
                            <label> Zip Code
                                [text zip-code ] 
                            </label> 
                        [/uacf7-col]
                        [uacf7-col col:6] 
                            <label> Current Address
                                [text current-address ] 
                            </label> 
                            <label> State
                                [text state] 
                            </label> 
                            <label> Country
                                [text country] 
                            </label>
                        [/uacf7-col]
                    [/uacf7-row]
                    <label> How did you hear about the workshop?
                        [checkbox where-from-heard class:uacf7-checkbox "Website" "Friend/Colleague" "Online Search"]
                    </label>
                    <div class="uacf7-submint">
                        [submit "Submit Form"]
                    </div>
                </div>';
                break;
            
case "product-order-form":
    $form = '<div class="uacf7-wrapper-default">
        [uacf7-row]
            [uacf7-col col:6]
                <label> First Name *
                    [text* first-name ] 
                </label> 
            [/uacf7-col]
            [uacf7-col col:6]
                <label> Last Name 
                    [text last-name ] 
                </label> 
            [/uacf7-col]
        [/uacf7-row]
        <label> Email *
            [email* email]
        </label> 
        <label> Shipping Address </label>
        [uacf7-row]
            [uacf7-col col:6]
                <label> Address Line 1 *
                    [text* address-line-1 ] 
                </label> 
                <label> City *
                    [text* city ] 
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
        <label> Choose your Product * 
            [checkbox* product class:uacf7-checkbox "Product Item 1 - $10" "Product Item 2 - $50" "Product Item 3 - $100"]
        </label>
        <label> Choose Payment Method * 
            [radio payment-method class:uacf7-radio "Pay with Card (Stripe)" "Pay with Paypal" "Test Payment"]
        </label>
        <div class="uacf7-submint">
            [submit "Purchase"]
        </div>
    </div>';
    break;

    case "donation-form-2":
        $form = '<div class="uacf7-wrapper-default">
            [uacf7-row]
                [uacf7-col col:6]
                    <label> First Name *
                        [text* first-name ] 
                    </label> 
                [/uacf7-col]
                [uacf7-col col:6]
                    <label> Last Name 
                        [text last-name ] 
                    </label> 
                [/uacf7-col]
            [/uacf7-row]
            <label> Email *
                [email* email]
            </label> 
            <label> Donation Amount * 
                [radio donation-amount class:uacf7-radio "$10" "$50" "$100" "Other"]
                [conditional conditional-505]
            </label>
            <label> Type your amount 
                [number  other-donation-amount min:1 ]
            </label>
            [/conditional]
            <label> Payment Method 
                [radio payment-method class:uacf7-radio default:1 "Pay with Card (Stripe)" "Pay with Paypal" "Offline Payment"]
            </label>
            <div class="uacf7-submint">
                [submit "Donate Now"]
            </div>
        </div>';
        break;
    
    case "order-bump-form":
        $form = '<div class="uacf7-wrapper-default">
            [uacf7-row]
                [uacf7-col col:6]
                    <label> Name *
                        [text* name ] 
                    </label> 
                [/uacf7-col]
                [uacf7-col col:6]
                    <label> Email*
                        [email* email ] 
                    </label> 
                [/uacf7-col]
            [/uacf7-row]
            <label> Your Awesome Product <br> Price: $49</label> 
            <label> Payment Method 
                [radio payment-method class:uacf7-radio default:1 "Pay with Card (Stripe)" "Pay with Paypal" "Offline Payment"]
            </label>
            <div> 
                <p style="margin: 0;"><span style="text-decoration: underline;"><strong>One-time offer:</strong></span> I would also like to get over-the-shoulder videos that walk me through every single step of the passive profits system for only $19 extra (a $97 value)</p>
            </div>
            [acceptance acceptance-terms optional] Yes, I want access $19 extra [/acceptance]
            <div class="uacf7-submint uacf7-order-bump-form">
                [submit  "Purchase Now"]
            </div>
        </div>';
        break;
    
    case "student-survey":
        $form = '<div class="uacf7-wrapper-default">
            [uacf7_step_start uacf7_step_start-630]
                [uacf7-row]
                    [uacf7-col col:6]
                        <label> First Name *
                            [text* first-name ] 
                        </label> 
                    [/uacf7-col]
                    [uacf7-col col:6]
                        <label> Last Name
                            [text last-name] 
                        </label> 
                    [/uacf7-col]
                [/uacf7-row]
                <label> Email*
                    [email* email ] 
                    <h3> How important is it that we provide you with the following?</h3> 
                    <label> Variety of student organizations *
                        [radio student-org class:uacf7-radio default:1 "Not important at all" "Somewhat important" "Very Important" "Essential"]
                    </label>
                    <label> Plenty of professor office hours *
                        [radio prof-office-hrs class:uacf7-radio default:1 "Not important at all" "Somewhat important" "Very Important" "Essential"]
                    </label>
                    <label> Internship opportunities *
                        [radio internship-opportunities class:uacf7-radio default:1 "Not important at all" "Somewhat important" "Very Important" "Essential"]
                    </label>
            [uacf7_step_end end]
            [uacf7_step_start uacf7_step_start-631]
                <h3> How important is it that we provide you with the following? </h3>
                <label> Get a job to help pay for college expenses *
                    [radio college-expenses class:uacf7-radio default:1 "Not at all likely" "Somewhat likely" "Very Likely"]
                </label>
                <label> Become a teacher assistant *
                    [radio become-teacher-assistant class:uacf7-radio default:1 "Not at all likely" "Somewhat likely" "Very Likely"]
                </label>
                <label> Study abroad  *
                    [radio study-abroad class:uacf7-radio default:1 "Not at all likely" "Somewhat likely" "Very Likely"]
                </label>
                <label> Take out student loans *
                    [radio student-loan class:uacf7-radio default:1 "Not at all likely" "Somewhat likely" "Very Likely"]
                </label>
                <label> Please select any activities/groups you plan on participating in while in school.*
                    [checkbox* interest class:uacf7-checkbox "Intramural Sports" "Student Organizations" "Fraternity/Sorority" "Other"]
                </label>
                <label> Others
                    [textarea others ]
                </label>
                <div class="uacf7-submint">
                    [submit  "Submit Form"]
                </div>
            [uacf7_step_end end]
        </div>';
        break;
    
        case "classroom-observation":
            $form = '<div class="uacf7-wrapper-default">
                [uacf7_step_start uacf7_step_start-170]
                    <h2 style="text-align:center;">Classroom Observation</h2>
                    <p style="text-align:center;">Please use the following form to evaluate the teacher\'s performance in the classroom. Your feedback is valuable and helps us ensure success for all teachers and students. Please answer each question honestly.</p>
                    <label> Teacher\'s Name 
                        [text teacher-name ] 
                    </label> 
                    <label> Classroom/Course 
                        [text course-name ] 
                    </label> 
                    <label> Observation Date 
                        [date observation-date] 
                    </label> 
                [uacf7_step_end end]
                [uacf7_step_start uacf7_step_start-171]
                    <label> Teacher was prepared for the lesson.
                        [radio is-teacher-prepared class:uacf7-radio default:1 "Strongly Agree" "Agree" "Neutral" "Disagree" "Strongly Disagree"] 
                    </label> 
                    <label> Teacher encouraged student participation.
                        [radio is-teacher-encouraged class:uacf7-radio default:1 "Strongly Agree" "Agree" "Neutral" "Disagree" "Strongly Disagree"] 
                    </label> 
                    <label> Teacher explained the lesson thoroughly.
                        [radio is-teacher-explained class:uacf7-radio default:1 "Strongly Agree" "Agree" "Neutral" "Disagree" "Strongly Disagree"] 
                    </label> 
                    <label> Teacher interacted with all students.
                        [radio is-teacher-interacted class:uacf7-radio default:1 "Strongly Agree" "Agree" "Neutral" "Disagree" "Strongly Disagree"] 
                    </label> 
                    <label> Teacher was able to control the entire classroom.
                        [radio is-teacher-control class:uacf7-radio default:1 "Strongly Agree" "Agree" "Neutral" "Disagree" "Strongly Disagree"] 
                    </label> 
                    <label> Teacher effectively used technology.
                        [radio is-teacher-use-technology class:uacf7-radio default:1 "Strongly Agree" "Agree" "Neutral" "Disagree" "Strongly Disagree"] 
                    </label> 
                    <label> Teacher used time efficiently.
                        [radio is-teacher-use-time-efficiently class:uacf7-radio default:1 "Strongly Agree" "Agree" "Neutral" "Disagree" "Strongly Disagree"] 
                    </label> 
                    <label> Teacher responded appropriately to student questions.
                        [radio is-teacher-responded-appropriately class:uacf7-radio default:1 "Strongly Agree" "Agree" "Neutral" "Disagree" "Strongly Disagree"] 
                    </label> 
                    <label> Teacher used a variety of teaching methods.
                        [radio is-teacher-used-teaching-methods class:uacf7-radio default:1 "Strongly Agree" "Agree" "Neutral" "Disagree" "Strongly Disagree"] 
                    </label> 
                [uacf7_step_end end]
                [uacf7_step_start uacf7_step_start-172]
                    <label> Based on this observation, would you pass or fail this teacher?
                        [radio your-result class:uacf7-radio default:1 "Pass" "Fail"] 
                    </label> 
                    <label> Additional Comments
                        [textarea additional-comments ] 
                    </label> 
                    <h4> Observer\'s Details (Optional) </h4>
                    [uacf7-row][uacf7-col col:6] 
                        <label> First Name
                            [text first-name] 
                        </label> 
                    [/uacf7-col][uacf7-col col:6] 
                        <label> Last Name
                            [text last-name] 
                        </label> 
                    [/uacf7-col][/uacf7-row]
                [uacf7_step_end end]
                <div class="uacf7-submit">
                    [submit "Submit Bug Report"]
                </div>
            </div>';
            break;
        
        case "course-evalution":
            $form = '
            <div class="uacf7-wrapper-default">
                [uacf7_step_start uacf7_step_start-170]
                    <p style="text-align:center;">Please answer all required questions. Only complete this evaluation if you will be completing the course.</p>
                    <h4>Course Data</h4>
                    <label> Course Name *
                        [text* course-name ] 
                    </label> 
                    <label> Course Number *
                        [text* course-number] 
                    </label> 
                    <label> Section Number * 
                        [text* section-number] 
                    </label> 
                    <label> Instructor Name * 
                        [text* instructor-name] 
                    </label> 
                [uacf7_step_end end]
                [uacf7_step_start uacf7_step_start-171]
                    <h4>Evaluation</h4>
                    <p>Your Evaluations are important, so please do it carefully</p>
                    <hr>
                    <label> Level of effort you put into the course. *
                        [radio leave-of-effort class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> Your level of knowledge at the beginning of the course. *
                        [radio label-of-knowledge-beginning class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> Your level of knowledge at the end of the course.  *
                        [radio label-of-knowledge-end class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> I understood the objectives of the course.  *
                        [radio objectives class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> The length of the course was appropriate to cover content.  *
                        [radio length-was-appropriate class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label>
                    <label> The course provided me with new information.  *
                        [radio provided-new-information class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label>
                [uacf7_step_end end]
                [uacf7_step_start uacf7_step_start-172]
                    <label> Instructor\'s preparation.                        
                        [radio instructor-preparation class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> Instructor\'s deliverance .                        
                        [radio instructor-deliverance class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> Instructor\'s communication.                        
                        [radio instructor-communication class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> Instructor\'s effectiveness.                        
                        [radio instructor-effectiveness class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> Instructor\'s availability.                        
                        [radio instructor-availability class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> Overall quality of the course                        
                        [radio overall-quality-of-course class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                    <label> Overall quality of the equipment used for the course.                        
                        [radio overall-quality-of-equipment class:uacf7-radio default:1 "Very Good" "Good" "Fair" "Poor" "Very Poor"] 
                    </label> 
                [uacf7_step_end end]
                [uacf7_step_start uacf7_step_start-173]  
                    <label> Would you recommend this course to other students?                        
                        [radio will-recommend class:uacf7-radio default:1 "Yes" "No"] 
                    </label>
                    <label> Why did you choose this course?                        
                        [radio why-choose class:uacf7-radio default:1 "Degree requirement" "Time offered" "Interest"] 
                    </label>
                    <label> Your class standing.                        
                        [radio your-class-standing class:uacf7-radio default:1 "Freshman" "Sophomore" "Junior" "Senior" "Graduate"] 
                    </label>
                [uacf7_step_end end]
                [uacf7_step_start uacf7_step_start-174] 
                    [uacf7-row][uacf7-col col:6] 
                        <label> Please identify aspects of the course you found useful.                
                            [textarea is-useful-feedback] 
                        </label> 
                    [/uacf7-col][uacf7-col col:6] 
                        <label> Please provide any suggestions to improve the course.            
                            [textarea should-improve-feedback] 
                        </label> 
                    [/uacf7-col][/uacf7-row]
                    <div class="uacf7-submit">
                        [submit "Submit Form"]
                    </div>
                [uacf7_step_end end]
            </div>';
        break;
    case "university-enrollment":
        $form = '<div class="uacf7-wrapper-default">
        <label>Anticipated Start Date *
            [date anticipated-start-date]
        </label>
        [uacf7-row]
            [uacf7-col col:6]
                <label>First Name
                    [text first-name]
                </label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Last Name
                    [text last-name]
                </label>
            [/uacf7-col]
        [/uacf7-row]
        <label>Phone
            [tel phone]
        </label>
        <label>Email
            [email email]
        </label>
        <label>Birth Date
            [date* birth-date]
        </label>
        <label>Gender *
            [radio gender class:uacf7-radio default:1 "Male" "Female" "Others"]
        </label>
        <label>Address </label>
        [uacf7-row]
            [uacf7-col col:6]
                <label>Address Line 1
                    [text address-line-1 ]
                </label>
                <label>City*
                    [text* city ]
                </label>
                <label>Zip Code *
                    [text* zip-code ]
                </label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Address Line 2
                    [text* address-line-2 ]
                </label>
                <label>State *
                    [text* state]
                </label>
                <label>Country *
                    [text* country]
                </label>
            [/uacf7-col]
        [/uacf7-row]
        <label>Proof of identity (e.g. birth certificate, Passport etc.)
            [file proof-of-identity]
        </label>
        <h4>Background Information: </h4>
        <hr>
        <label>Enrollment Status
            [radio enrollment-status class:uacf7-radio default:1 "Full Time" " Part Time"]
        </label>
        <label>High School Name
            [text high-school-name]
        </label>
        <label>High School Address </label>
        [uacf7-row]
            [uacf7-col col:6]
                <label>Address Line 1
                    [text address-line-1-2 ]
                </label>
                <label>City*
                    [text* city-2 ]
                </label>
                <label>Zip Code *
                    [text* zip-code-2 ]
                </label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Address Line 2
                    [text* address-line-2-2 ]
                </label>
                <label>State *
                    [text* state-2]
                </label>
                <label>Country *
                    [text* country-2]
                </label>
            [/uacf7-col]
        [/uacf7-row]
        <label>GPA *
            [number* gpa]
        </label>
        <label>Diploma Type *
            [text* diploma-type]
        </label>
        <label>High School Transcripts *
            [file* high-school-transcript]
        </label>
        <label>Medical Allergies *
            [text* medical-allergies]
        </label>
        [uacf7-row]
            [uacf7-col col:6]
                <label>Parent/Guardian (First Name) *
                    [text* guardian-first-name]
                </label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>(Last Name) *
                    [text* guardian-last-name]
                </label>
            [/uacf7-col]
        [/uacf7-row]
        <label>Parent/Guardian Company *
            [text* guardian-company]
        </label>
        <label>Parent/Guardian Phone *
            [tel* guardian-phone]
        </label>
        <label>Parent/Guardian Email *
            [email* guardian-email]
        </label>
        <div class="uacf7-submint">
            [submit "Submit Form"]
        </div>
    </div>
    '; 
    break;  
    case "high-school-transcript":
        $form = '
        <div class="uacf7-wrapper-default">
    [uacf7-row]
        [uacf7-col col:4]
            <label>First Name *
                [text* first-name]
            </label>
        [/uacf7-col]

        [uacf7-col col:4]
            <label>Middle Name
                [text middle-name]
            </label>
        [/uacf7-col]

        [uacf7-col col:4]
            <label>Last Name *
                [text* last-name]
            </label>
        [/uacf7-col]
    [/uacf7-row]

    <label>Graduation Date *
        [date* graduation-date]
    </label>

    <label>Address </label>
    [uacf7-row]
        [uacf7-col col:6]
            <label>Address Line 1
                [text address-line-1 ]
            </label>

            <label>City*
                [text* city ]
            </label>

            <label>Zip Code *
                [text* zip-code ]
            </label>
        [/uacf7-col]

        [uacf7-col col:6]
            <label>Address Line 2
                [text* address-line-2 ]
            </label>

            <label>State *
                [text* state]
            </label>

            <label>Country *
                [text* country]
            </label>
        [/uacf7-col]
    [/uacf7-row]

    <label>Registration Number *
        [number* registration-number]
    </label>

    <label>Birth Date
        [date* birth-date]
    </label>

    <label>Current Phone *
        [tel* phone]
    </label>

    <label>Email *
        [email* email]
    </label>

    <label>I wish to pick up an UNOFFICIAL copy of my transcript
        [checkbox willing-to-unofficial-copy class:uacf7-radio "Yes" "No"]
    </label>

    <h3>Please send an OFFICIAL copy of my high school transcript to:</h3>

    <label>College/University Name *
        [text* uni-or-clg-name]
    </label>

    <label>Address </label>
    [uacf7-row]
        [uacf7-col col:6]
            <label>Address Line 1
                [text uni-address-line-1 ]
            </label>

            <label>City*
                [text* uni-city ]
            </label>

            <label>Zip Code *
                [text* uni-zip-code ]
            </label>
        [/uacf7-col]

        [uacf7-col col:6]
            <label>Address Line 2
                [text* uni-address-line-2 ]
            </label>

            <label>State *
                [text* uni-state]
            </label>

            <label>Country *
                [text* uni-country]
            </label>
        [/uacf7-col]
    [/uacf7-row]

    <label>Email *
        [email* uni-email]
    </label>

    <label>Today\'s Date
        [date* todays-date]
    </label>

    <label>Your Signature
        [uacf7_signature* student-signature]
    </label>

    <div class="uacf7-submint">
        [submit "Submit Form"]
    </div>
    </div>
    ';
    break; 
    case "functional-behavioral-assesment":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7_step_start uacf7_step_start-534]
            [uacf7-row]
                [uacf7-col col:6]
                    <label>First Name *
                        [text* first-name]
                    </label>
                [/uacf7-col]
                [uacf7-col col:6]
                    <label>Last Name *
                        [text* last-name]
                    </label>
                [/uacf7-col]
            [/uacf7-row]
            <label>Date *
                [date* date]
            </label>
            <label>Sources of Data *
                [checkbox* source-of-data class:uacf7-checkbox "Record Review" " Scatterplot" " ABC Logs" " Other"]
            </label>
            <label>Information Reported By *
                [checkbox* info-reported-by class:uacf7-checkbox "Teacher" " Parent" " Student" " Other"]
            </label>
            <label> Describe your role.
                [textarea* your-role]
            </label>
            [uacf7-row]
                [uacf7-col col:6]
                    <label>Assessor Name(First Name) *
                        [text* assessor-first-name]
                    </label>
                [/uacf7-col]
                [uacf7-col col:6]
                    <label>Assessor Name(Last Name)
                        [text* assessor-last-name]
                    </label>
                [/uacf7-col]
            [/uacf7-row]
            <h3> Problem Behaviors </h3>
            <hr>
            <label> Describe behaviors in specific and observable terms.
                [text* term-desc]
            </label>
            <label> Estimated frequency
                [text* estimated-frequency]
            </label>
            <label> Describe any observed patterns related to reported behavior.
                [text* reported-behavior]
            </label>
            <h3> Medical/Health Information </h3>
            <hr>
            <label> Known health, medical, or psychiatric conditions
                [text* health-conditions]
            </label>
            <label> Current medications
                [text* current-medications]
            </label>
            <label> Known traumatic events
                [text* known-traumatic-events]
            </label>
            <label> Medical treatments, therapies, or services (outside of school)
                [text* outside-school-treatments]
            </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-536]
            <h3> Intervention History </h3>
            <hr>
            <label> Describe a brief history of the problem behavior and any interventions.
                [textarea* interventions-history]
            </label>
            <label> If applicable, how would you describe the effectiveness of past intervention efforts?
                [textarea* interventions-efforts]
            </label>
            <label> What rewards are currently provided to the student in school? For what and how often?
                [textarea* provided-rewards]
            </label>
            <label> What consequences are currently used in school for problem behaviors?
                [textarea* consequences-problem-behaviors]
            </label>
            <label> What is the typical student response to these consequences?
                [textarea* consequences-typical-response]
            </label>
            <h3> Skills Assessment </h3>
            <hr>
            <label> What are the student\'s academic strengths?
                [text* academic-strengths]
            </label>
            <label> What are the student\'s academic needs?
                [text* academic-needs]
            </label>
            <label> What are the student\'s organizational needs?
                [textarea* organizational-needs]
            </label>
            <label> What are the student\'s preferred learning styles?
                [text* preferred-learning-styles]
            </label>
            <label> What are the student\'s social strengths?
                [text* social-strengths]
            </label>
            <label> What are the student\'s deficits in regard to social skills with adults and peers?
                [textarea* social-skills-with-adults-and-peers]
            </label>
            <h3> Communication Summary </h3>
            <hr>
            <label> Does the student have difficulty in expressing any of these basic communication functions?
                [checkbox* basic-communication-functions class:uacf7-checkbox "Gaining adult attention" " Gaining attention of peers" " Dealing with a difficult task" " Expressing frustration or confusion" " Requesting things of others" " Rejecting or protesting something" " Indicating preferences or making choices" " Requesting assistance"]
            </label>
            <label> Use the summary below to think about and identify possible replacement behaviors for instruction. Number separate issues in each of the following fields to clearly connect problem behavior to communication function and replacement behavior. Target Problem Behavior(s)
                [textarea* possible-replacement-behaviors]
            </label>
            <label> Related Communication Function(s)
                [textarea* related-communication-functions]
            </label>
            <label> Possible Replacement Behavior(s)
                [textarea* possible-replacement-behaviors]
            </label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-535]
            <h3> Consequence Analysis </h3>
            <hr>
            <label> Thinking about the last few times the behavior occurred, what typically actually happens immediately afterward?
                [text* thinking-about-last-behavior-occurred]
            </label>
            <label> Are demands typically altered after the target behavior?
                [text* targeted-behavior]
            </label>
            <label> Does someone usually intervene to help the student after the target behavior?
                [text* intervene-targeted-behavior]
            </label>
            <label> Does the student gain access to something that he/she appears to want?
                [textarea* does-student-gain-access]
            </label>
            <label> Does the behavior appear pleasurable to the student apart from what else is going on around him/her?
                [textarea* behavior-appear-pleasurable]
            </label>
            <label> Does the behavior appear to give the student control of others or the situation? Explain.
                [textarea* behavior-situation-explain]
            </label>
            <label> Does the behavior, or do related behaviors, appear to be compulsive (i.e., repetitive, internally driven)? Explain.
                [textarea* behavior-compulsive]
            </label>
            <div class="uacf7-submint">
                [submit "Submit Form"]
            </div>
        [uacf7_step_end end]
    </div>';  
    break;
    case "admission-form":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7-row]
            [uacf7-col col:6]
                <label>First Name *
                    [text* first-name]
                </label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Last Name *
                    [text* last-name]
                </label>
            [/uacf7-col]
        [/uacf7-row]
        <label>Email*
            [email* email]
        </label>
        <label>Birth Date *
            [date* birth-date]
        </label>
        <label>Gender *
            [radio gender class:uacf7-radio default:1 "Male" "Female" "Others"]
        </label>
        <label>Select section *
            [select* section include_blank class:uacf7-select "Section - A" "Section - B" "Section - C"]
        </label>
        <label> Apply for Class *
            [radio apply-for-class class:uacf7-radio default:1 "O Level" "A Level"]
        </label>
        <label> Guardian Name *
            [text* guardian-name]
        </label>
        <label> Guardian Contact *
            [tel* guardian-contact]
        </label>
        <label> Upload Your Photo *
            [file* your-photo]
        </label>
        <label> Comments (Optional)
            [textarea your-comments]
        </label>
        <div class="uacf7-submint">
            [submit "Apply For Admission"]
        </div>
    </div>';
    break;
    case "multiple-file-upload":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7-row]
            [uacf7-col col:6]
                <label>First Name *
                    [text* first-name]
                </label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Last Name *
                    [text* last-name]
                </label>
            [/uacf7-col]
        [/uacf7-row]
        
        <label>Email*
            [email* email]
        </label>
    
        [uarepeater uarepeater-232 add "Add more" remove "Remove"]
            <label> Upload Your File *
                [file* your-photo]
            </label>
        [/uarepeater]
    
        <label> Comments (Optional)
            [textarea your-comments]
        </label>
        
        <div class="uacf7-submint">
            [submit "Submit Form"]
        </div>
    </div>
    ';
    break;
    case "software-survey":
        $form = '<div class="uacf7-wrapper-default">
        <h3>Software Survey</h3>
        <hr>
    
        <label>How did you hear about ...?
            [checkbox* where-from-heard class:uacf7-checkbox "Our Website" "Friends" "Social Media" "Ads" "Generic Search"]
        </label>
    
        <label>Which platform do you use?
            [checkbox* which-platform class:uacf7-checkbox "Mac OS" "Linux" "Windows" "Other"]
        </label>
    
        <label>How would you rate our software?
            [uacf7_star_rating* rating icon:star1 "default"]
        </label>
    
        <label>Did you purchase any of our software?
            [radio did-you-purchased class:uacf7-radio default:1 "Yes" "No"]
        </label>
    
        <label>Please let us know if you have any suggestions for us.
            [textarea your-comments]
        </label>
    
        <div class="uacf7-submint">
            [submit "Submit Form"]
        </div>
    </div>
    ';
    break;
    case "website-feedback":
        $form = '<div class="uacf7-wrapper-default">
        <h3>Website Feedback</h3>
        <hr>
        <label>Your Full Name *
            [text* your-name]
        </label>
        <label>Your Email *
            [email* your-email]
        </label>
        <label>Is this the first time you have visited the website?
            [radio is-this-first-time-visit class:uacf7-radio default:1 "Yes" "No"]
        </label>
        <label>What is the PRIMARY reason you came to the site?
            [textarea your-reason-of-visit]
        </label>
        <label>Did you find what you needed? *
            [checkbox* did-you-find-what-you-needed class:uacf7-checkbox "Yes, all of it" "Yes, some of it" "No, none of it"]
        </label>
        <label>User Friendliness
            [uacf7_star_rating* how-much-user-friendly "default"]
        </label>
        <div class="uacf7-submint">
            [submit "Submit Form"]
        </div>
    </div>
    ';
    break;
    case "partnership-application":
        $form = '<div class="uacf7-wrapper-default">
        <h3>Partnership Application Form</h3>
        <p>Thank you for your interests in our company. We are excited to have you on board as one of our esteemed partners. To get started, please complete all fields accordingly. We will review and get in touch with you shortly. If you are unsure about any of the answers, please use an estimation.</p>
        <hr>
        [uacf7-row][uacf7-col col:6] 
            <label>Company Name
                [text company-name]
            </label>
            <label>Number of Employees
                [text number-of-employees]
            </label>
        [/uacf7-col][uacf7-col col:6] 
            <label>Company URL
                [url company-url]
            </label>
            <label>Number of Customers
                [text number-of-customers]
            </label>
        [/uacf7-col][/uacf7-row]
        <label>Place of Business 
            [select place-of-business include_blank "USA" "UK" "Singapore" "Palestine"]
        </label>
        <label>Current Demand Generation Activities (you can select more than one)
            [checkbox currently-demanded-activities class:uacf7-checkbox "Direct Mailer" "Website Optimization" "Email/Mobile Marketing" "Media Advertisement" "Social Media" "Paid Search / SEO" "Trade show/Workshop"]
        </label>
        <label>Do you want us to publish your profile on our site?
            [radio wanna-publish-profile class:uacf7-radio default:1 "Yes" "No"]
        </label>
        <label>Your Company Profile (less than 150 words)
            [textarea your-company-profile]
        </label>
        <label>Company Specialization Keywords (Separated by comma)
            [textarea your-company-keywords]
        </label>
        [uacf7-row][uacf7-col col:6] 
            <label>Sales Inquiry Number (Leave blank if unknown)
                [number sales-inquiry-number]
            </label>
        [/uacf7-col][uacf7-col col:6] 
            <label>Sales Enquiry Email Address
                [email sales-inquiry-email]
            </label>
        [/uacf7-col][/uacf7-row]
        <label>Upload Logo (PNG, Transparent Background)
            [file your-logo]
        </label>
        <hr>
        <h3>Point of Contact - Partnership</h3>
        <label>Contact Name
            [text contact-name]
        </label>
        [uacf7-row][uacf7-col col:6] 
            <label>Phone Number*
                [tel* contact-phone]
            </label>
        [/uacf7-col][uacf7-col col:6] 
            <label>Email Address*
                [email* contact-email]
            </label>
        [/uacf7-col][/uacf7-row]
        <div class="uacf7-submint">
            [submit "Submit Form"]
        </div>
    </div>
    ';
    break;

    case "finance-application":
        $form ='<div class="uacf7-wrapper-default">
        <h3>Finance Application</h3>
        [uacf7-row][uacf7-col col:4] 
        <label> Date 
        [date date]
        </label>
        [/uacf7-col][uacf7-col col:4]
        <label> Sales Person
        [text sales-person]
        </label>
        [/uacf7-col][uacf7-col col:4] 
        <label> Choose One
        [radio choose-credit-type class:uacf7-radio default:1 "Individual Credit" "Joint Credit"]
        </label>
        [/uacf7-col][/uacf7-row]
        <h3> Applicant Name: </h3>
        [uacf7-row][uacf7-col col:4] 
        <label> First Name 
        [text first-name]
        </label>
        [/uacf7-col][uacf7-col col:4]
        <label> Middle Name
        [text middle-name]
        </label>
        [/uacf7-col][uacf7-col col:4] 
        <label> Last Name
        [text last-name]
        </label>
        [/uacf7-col][/uacf7-row]
        <label> Social Security Number * 
        [number* security-number]
        </label>
        [uacf7-row][uacf7-col col:4] 
        <label>Birth Date
        [date* birth-date]
        </label>
        [/uacf7-col][uacf7-col col:4]
        <label> Home Phone Number
        [tel home-phone-number]
        </label>
        [/uacf7-col][uacf7-col col:4] 
        <label> Cell Phone Number
        [tel* cell-phone-number]
        </label>
        [/uacf7-col][/uacf7-row]
        [uacf7-row][uacf7-col col:4] 
        <label>Applicant Email *
        [email* applicant-email]
        </label>
        [/uacf7-col][uacf7-col col:4]
        <label> Number of Dependents
        [number number-of-dependencies]
        </label>
        [/uacf7-col][uacf7-col col:4] 
        <label> Time at Resident
        [text* time-at-resident]
        </label>
        [/uacf7-col][/uacf7-row]
        <label> Present Address </label>
        [uacf7-row][uacf7-col col:6] 
        <label>Street Line 1 *
        [text* applicant-street-1]
        </label>
        <label>City *
        [text* applicant-city]
        </label>
        <label>Zip Code *
        [text* applicant-zip]
        </label>
        [/uacf7-col][uacf7-col col:6]
        <label>Street Line 2 *
        [text* applicant-street-2]
        </label>
        <label>State *
        [text* applicant-state]
        </label>
        <label>Country *
        [text* applicant-country]
        </label>
        [/uacf7-col][/uacf7-row]
        <label> Previous Address ( If less than 2 years at present address ) </label>
        [uacf7-row][uacf7-col col:6] 
        <label>Street Line 1 *
        [text* applicant-street-1-prev]
        </label>
        <label>City *
        [text* applicant-city-prev]
        </label>
        <label>Zip Code *
        [text* applicant-zip-prev]
        </label>
        [/uacf7-col][uacf7-col col:6]
        <label>Street Line 2 *
        [text* applicant-street-2-prev]
        </label>
        <label>State *
        [text* applicant-state-prev]
        </label>
        <label>Country *
        [text* applicant-country-prev]
        </label>
        [/uacf7-col][/uacf7-row]
        [uacf7-row][uacf7-col col:4] 
        <label> How many years *
        [number* how-many-years]
        </label>
        [/uacf7-col][uacf7-col col:4]
        <label> Gross Annual Income *
        [number* gross-annual-income]
        </label>
        [/uacf7-col][uacf7-col col:4] 
        <label> Mark please 
        [radio profession class:uacf7-radio default:1 " Military" "Spouse" "Single"]
        </label>
        [/uacf7-col][/uacf7-row]
        [uacf7-row][uacf7-col col:6] 
        <label>Military Unit Number 
        [text military-unit-number]
        </label>
        <label>Work Phone Number *
        [tel* work-phone-number]
        </label>
        [/uacf7-col][uacf7-col col:6]
        <label>Military Rank 
        [text military-rank]
        </label>
        <label>Numeric Field *
        [number* numeric-field]
        </label>
        [/uacf7-col][/uacf7-row]
        <label> Source of Additional Income
        [text source-of-additional-income]
        </label>
        <h3> Co-Applicant Information </h3>
        <hr>
        [uacf7-row][uacf7-col col:6] 
        <label>First Name
        [text co-applicant-first-name]
        </label>
        [/uacf7-col][uacf7-col col:6]
        <label>Last Name
        [text co-applicant-last-name]
        </label>
        [/uacf7-col][/uacf7-row]
        <label>Email
        [email co-applicant-email]
        </label>
        <label>Cell Phone
        [tel co-applicant-cell]
        </label>
        <label>Address </label>
        [uacf7-row][uacf7-col col:6] 
        <label>Street Line 1 *
        [text* co-applicant-street-1]
        </label>
        <label>City *
        [text* co-applicant-city]
        </label>
        <label>Zip Code *
        [text* co-applicant-zip]
        </label>
        [/uacf7-col][uacf7-col col:6]
        <label>Street Line 2 *
        [text* co-applicant-street-2]
        </label>
        <label>State *
        [text* co-applicant-state]
        </label>
        <label>Country *
        [text* co-applicant-country]
        </label>
        [/uacf7-col][/uacf7-row]
        [acceptance terms] By clicking the submit button, I agree to terms & conditions [/acceptance]
        <label>I authorize the XXX to make whatever inquires it deems necessary in connection with this credit application and in the course of review or collection of any credit extended in reliance on this application. I further authorized any person or YYY to complete and finish to the XXX any information that it may have or obtain in response to such inquires and agree that such information along with this application shall remain the XXX\'s property, whether or not credit is extended. All information stated in this application is declared to be a true representation of the facts and made for the purpose of obtaining the credit request. I HAVE REVIEWED THE ABOVE DISCLOSURE.
        </label>
        <div class="uacf7-submint">

            [submit "Submit Form"]

        </div>

    </div>';
    break;
    case "book-a-room":
        $form = '<div class="uacf7-wrapper-default">
        <h3>Book a Room</h3>
        <hr>
        [Add Your Hotel Logo]
        [Add Your Hotel Name]
        [Add Your Hotel Address]
        [uacf7-row]
            [uacf7-col col:6]
                <label>First Name [text first-name placeholder]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Last Name [text last-name placeholder]</label>
            [/uacf7-col]
        [/uacf7-row]
        <label>Email [email email]</label>
        <label>Room Type [select room-type class:uacf7-select include_blank "Standard room (1 to 2 people)" "Family room (1 to 4 people)" "Private room (1 to 3 people)" "Only female room"]</label>
        <label>Arrival Date [date arrival-date]</label>
        <label>Departure Date [date departure-date]</label>
        <label>No. of people [number number-of-people]</label>
        <label>Special Requests [textarea special-request]</label>
        <div class="uacf7-submint">
            [submit "Submit Form"]
        </div>
    </div>
    ';
    break;
    case "qoute-request":
        $form ='<div class="uacf7-wrapper-default">
        [uacf7_step_start uacf7_step_start-509]
        <h3>REQUEST FOR QUOTE</h3>
        <hr>
        <label>Date [date date]</label>
        <hr>
        <h3>CONTACT INFORMATION</h3>
        <hr>
        [uacf7-row]
            [uacf7-col col:6]
                <label>First Name [text first-name placeholder]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Last Name [text last-name placeholder]</label>
            [/uacf7-col]
        [/uacf7-row]
        <label>Address</label>
        [uacf7-row]
            [uacf7-col col:6]
                <label>Address Line 1 [text address-line-1]</label>
                <label>City* [text* city]</label>
                <label>Zip Code* [text* zip-code]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Address Line 2 [text* address-line-2]</label>
                <label>State* [text* state]</label>
                <label>Country* [text* country]</label>
            [/uacf7-col]
        [/uacf7-row]
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-510]
        <h3>PRODUCTS</h3>
        <br>
        <h4>ITEM 1</h4>
        [uacf7-row][uacf7-col col:6]
            <label>Product Name: [text product-name-1]</label>
        [/uacf7-col][uacf7-col col:6]
            <label>Quantity [number product-quantity-1]</label>
        [/uacf7-col][/uacf7-row]
        <h4>ITEM 2</h4>
        [uacf7-row][uacf7-col col:6]
            <label>Product Name: [text product-name-2]</label>
        [/uacf7-col][uacf7-col col:6]
            <label>Quantity [number product-quantity-2]</label>
        [/uacf7-col][/uacf7-row]
        <h4>ITEM 3</h4>
        [uacf7-row][uacf7-col col:6]
            <label>Product Name: [text product-name-3]</label>
        [/uacf7-col][uacf7-col col:6]
            <label>Quantity [number product-quantity-3]</label>
        [/uacf7-col][/uacf7-row]
        <h4>NOTES</h4>
        <label>Additional comments or questions: [textarea your-comments]</label>
        <div class="uacf7-submint">
            [submit "Submit Form"]
        </div>
        [uacf7_step_end end]
    </div>
    ';
    break;
    case "loan-application":
        $form = '<div class="uacf7-wrapper-default">
        <h3>Business Loan Application</h3>
        <p>Personal Information</p>
        <hr>
        [uacf7-row]
            [uacf7-col col:6]
                <label>First Name [text first-name placeholder]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Last Name [text last-name placeholder]</label>
            [/uacf7-col]
        [/uacf7-row]
        <label>E-mail of Applicant* [email* applicant-email]</label>
        <label>Phone number of Applicant* [tel* applicant-phone]</label>
        <label>Fax Number of Applicant [number applicant-fax]</label>
        <label>Address of Applicant</label>
        [uacf7-row]
            [uacf7-col col:6]
                <label>Address Line 1 [text address-line-1]</label>
                <label>City* [text* city]</label>
                <label>Zip Code* [text* zip-code]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Address Line 2 [text* address-line-2]</label>
                <label>State* [text* state]</label>
                <label>Country* [text* country]</label>
            [/uacf7-col]
        [/uacf7-row]
        <label>Date of Birth of Applicant [date* applicant-date-of-birth]</label>
        <h3>Project Details</h3>
        <br>
        <label>Applying as * [radio applying-as class:uacf7-radio default:1 "Sole Proprietor" "Partnership" "Corporation"]</label>
        <label>Planned Business Location</label>
        [uacf7-row]
            [uacf7-col col:6]
                <label>Address Line 1 [text business-address-line-1]</label>
                <label>City* [text* business-city]</label>
                <label>Zip Code* [text* business-zip-code]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Address Line 2 [text* business-address-line-2]</label>
                <label>State* [text* business-state]</label>
                <label>Country* [text* business-country]</label>
            [/uacf7-col]
        [/uacf7-row]
        <label>Project Marketing Material [file project-marketing-material]</label>
        <label>Project Information [file project-information]</label>
        <label>Does the borrower have an up-to-date assets and liabilities statement? * [radio borrower-liabilities class:uacf7-radio default:1 "Yes" "No"]</label>
        <label>Have you previously been financed? * [radio previously-financed class:uacf7-radio default:1 "Yes" "No"]</label>
        <label>Loan Reason [checkbox loan-reason class:uacf7-checkbox "Construction" "Asset Purchase" "Refinancing" "Other"]</label>
        <label>Project Gross Value [text project-gross-value]</label>
        <label>Loan Amount [text loan-amount]</label>
        <p>The information provided in this application shall not be shared with anyone else and is kept confidential</p>
        [acceptance acceptance] I agree that the information herein is true and correct [/acceptance]
        <div class="uacf7-submint">
            [submit "Submit Application Form"]
        </div>
    </div>
    ';
    break;
    case "personal-loan":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7_step_start uacf7_step_start-303]
        <h3>Personal Information</h3>
        <hr>
        <label>Title * [select* title include_blank "Mr" "Mrs" "Ms"]</label>
        [uacf7-row]
            [uacf7-col col:6]
                <label>First Name [text first-name placeholder]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Last Name [text last-name placeholder]</label>
            [/uacf7-col]
        [/uacf7-row]
        <label>Date of Birth* [date* date-of-birth]</label>
        <label>Marital Status* [radio marital-status class:uacf7-radio default:1 "Single" "Married" "Other"]</label>
        <label>Email * [email* email]</label>
        <label>Phone Number * [tel* phone-number]</label>
        <label>Address of Applicant</label>
        [uacf7-row]
            [uacf7-col col:6]
                <label>Address Line 1 [text address-line-1]</label>
                <label>City* [text* city]</label>
                <label>Zip Code* [text* zip-code]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Address Line 2 [text* address-line-2]</label>
                <label>State* [text* state]</label>
                <label>Country* [text* country]</label>
            [/uacf7-col]
        [/uacf7-row]
        <label>How long have you lived in your given address? * [radio how-long-living-there class:uacf7-radio default:1 "0-1 years" "1-2 years" "2-3 years" "3-4 years" "5+ years"]</label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-304]
        <h3 style="text-align:center">Employment Information</h3>
        <p style="text-align:center">Put Your Employment Information below, Please fill all the required. </p>
        <hr>
        <label>Present Employer* [text* present-employer]</label>
        <label>Occupation* [text* occupation]</label>
        <label>Experience of work (years)* [checkbox* experience-of-work class:uacf7-checkbox "0-1 years" "1-2 years" "2-3 years" "3-4 years" "5+ years"]</label>
        <label>Gross monthly income * [text* gross-monthly-income]</label>
        <label>Monthly rent/mortgage * [text* monthly-mortgage]</label>
        <label>Down Payment Amount * [text* down-payment-amount]</label>
        <label>Comments [text your-comments]</label>
        [acceptance acceptance] I have read and agree to the Terms and Conditions and Privacy Policy [/acceptance]
        <div class="uacf7-submint">
            [submit "Submit Application Form"]
        </div>
        [uacf7_step_end end]
    </div>
    ';
    break;
    case "employee-evaluation":
        $form = '<div class="uacf7-wrapper-default">
        <p style="text-align: center; font-weight:bold">Please remember that the form will be confidential and will be used for only internally; so, feel free to submit your data however you feel to submit;</p>
        <hr>
        [uacf7-row]
            [uacf7-col col:6]
                <label>First Name [text first-name placeholder]</label>
                <label>Title [text title]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Last Name [text last-name placeholder]</label>
                <label>Relationship with employee: [select relationship-with-employee include_blank "Coworker" "Supervisor(Direct)" "Supervisor(Indirect)"]</label>
            [/uacf7-col]
        [/uacf7-row]
        <h3>Employee Information</h3>
        [uacf7-row]
            [uacf7-col col:6]
                <label>First Name [text employee-first-name placeholder]</label>
                <label>Text Input [text text-input]</label>
            [/uacf7-col]
            [uacf7-col col:6]
                <label>Last Name [text employee-last-name placeholder]</label>
                <label>Review type: [radio review-type class:uacf7-radio default:1 "90-Day Review" "Annual/Raise Review"]</label>
            [/uacf7-col]
        [/uacf7-row]
        <p>How would you rate the employee...</p>
        <label>Attendance? [radio attendance class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Professionalism? [radio professionalism class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Attire? [radio attire class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Work area? [radio work-area class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Ability to do the job? [radio ability-to-job class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Ability to work with others? [radio ability-to-work-with-others class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Ability to receive feedback/criticism? [radio ability-to-receive-feedback class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Ability to adapt? [radio ability-to-adapt class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Willingness to learn? [radio willingness-to-learn class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Willingness to participate? [radio willingness-to-participate class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Work ethic? [radio work-ethic class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>Quality of work? [radio quality-of-work class:uacf7-radio default:1 "Very Poor" "Poor" "Average" "Good" "Very Good"]</label>
        <label>What are the employee\'s top qualities? [textarea employees-top-qualities]</label>
        <label>In what ways could the employee improve? [textarea employees-improvement-comments]</label>
        <div class="uacf7-submint">
            [submit "Submit"]
        </div>
    </div>
    ';
    break;
    case "sponsor-request":
        $form = '<div class="uacf7-wrapper-default">
        [uacf7_step_start uacf7_step_start-589]
            <h3 style="text-align: center; font-weight:bold; color:#34C4C7">Sponsorship Request</h3>
            <p style="text-align: center; color:#88D7D8">Let\'s get started.</p>
            <hr>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-590]
            <label>What\'s your Name [text name]</label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-591]
            <label>What\'s your Email [email email]</label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-592]
            <label>What\'s your Phone Number [tel phone-number]</label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-593]
            <label>What\'s your Address</label>
            [uacf7-row]
                [uacf7-col col:6]
                    <label>Address Line 1 [text address-line-1]</label>
                    <label>City* [text* city]</label>
                    <label>Zip Code* [text* zip-code]</label>
                [/uacf7-col]
                [uacf7-col col:6]
                    <label>Address Line 2 [text* address-line-2]</label>
                    <label>State* [text* state]</label>
                    <label>Country* [text* country]</label>
                [/uacf7-col]
            [/uacf7-row]
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-594]
            <label>May I know where do you work? [text working-place]</label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-595]
            <label>Which position do you want to sponsor? [text sponsor-position]</label>
        [uacf7_step_end end]
        [uacf7_step_start uacf7_step_start-596]
            <label>Special Request [textarea special-request]</label>
            <div class="uacf7-submint">
                [submit "Submit"]
            </div>
        [uacf7_step_end end]
    </div>
    ';
    break;
    case "job-listing":
        $form = '<div class="uacf7-wrapper-default">
                [uacf7_step_start uacf7_step_start-589]
                    <h3>Personal Information</h3>
                    <hr>
                    <label>Company Name [text company-name]</label>
                    <label>Salutation [select salutation class:uacf7-select include_blank "Mr" "Mrs" "Miss" "Ms." "Dr." "Prof."]</label>
                    [uacf7-row][uacf7-col col:4] 
                        <label>First Name [text first-name]</label>
                    [/uacf7-col][uacf7-col col:4] 
                        <label>Middle Name [text middle-name]</label>
                    [/uacf7-col][uacf7-col col:4] 
                        <label>Last Name [text last-name]</label>
                    [/uacf7-col][/uacf7-row]
                    <label>Email [email email]</label>
                    [acceptance terms optional]Agree to show contact information in public posting (optional)[/acceptance]
                [uacf7_step_end end]
                [uacf7_step_start uacf7_step_start-590]
                    <h3>Information of Your Position</h3>
                    <hr>
                    <label>Company Name * [text company-name-2]</label>
                    <label>Department / Division [text company-dept]</label>
                    <label>Position Title [text position-title]</label>
                    <label>Reference Number [text ref-number]</label>
                    <label>Job Posting Url [url job-posting-url]</label>
                    <label>Salary Details [text salary-details]</label>
                    [acceptance salary-nego optional]Salary Negotiable[/acceptance]
                    <label>Type of Employment [select type-of-employment class:uacf7-select include_blank "Full Time" "Part Time"]</label>
                    <label>Type of Contract [select type-of-contract class:uacf7-select include_blank "Permanent" "Term" "Locum"]</label>
                    <label>Type of Position [select type-of-position class:uacf7-select include_blank "Academic" "Administrative" "Obstetrics" "Gynaecology" "Obstetrics/Gynaecology" "Other"]</label>
                    <label>Job Summary [textarea job-summery]</label>
                    <label>Roles and Responsibilities [textarea job-roles]</label>
                    <label>Skills and Competencies [textarea job-skills]</label>
                    <label>Education and Experience [textarea education-and-experience]</label>
                    <label>Others [textarea others-details]</label>
                    <label>Upload your CV * [file* your-cv]</label>
                    <label>Start Date of Employment * [date* start-date]</label>
                    <label>Application Deadline * [date* application-deadline]</label>
                [uacf7_step_end end]
                [uacf7_step_start uacf7_step_start-591]
                    <h3>Payment Information</h3>
                    <hr>
                    <label>Salary Amount [radio salary-amount class:uacf7-radio default:1 "$ 400.00 - 1 Month Posting Duration" "$ 600.00 - 2 Month Posting Duration" "$ 900.00 - 3 Month Posting Duration" "Other"]</label>
                    [conditional conditional-946]
                        <label>Type your Amount [text custom-salary-amount]</label>
                    [/conditional]   
                    <div class="uacf7-submint">
                        [submit "Submit"]
                    </div>
                [uacf7_step_end end]
            </div>
           ';
        break;
    case "party-invite":
        $form = '<div class="uacf7-wrapper-default">
        <h6 style="text-align:center">You\'re Invited!</h6>
        <h6 style="text-align:center">Come get cool at our pool this 4th of July!</h6>
        <p style="text-align:center">[You can add an Image/Logo Here]</p>
        <p style="text-align:center">Time: July 4th, 2020</p>
        <p style="text-align:center">Address: 2611 Ash Avenue, SAN DIEGO, CA, California, 92152</p>
        <hr>
        <label>Are you coming? * [radio are-you-coming class:uacf7-radio default:1 "Yes" "No"]</label>
        <label>Will you bring a guest with you? * [radio bringing-guest class:uacf7-radio default:1 "Yes" "No"]</label>
        <label>Are you bringing any food? (e.g., wine, sandwich, pizza, etc.) * [radio bringing-food class:uacf7-radio default:1 "Yes" "No"]</label>
        <label>Your Special Comments (If any) [textarea special-comments]</label>
        <div class="uacf7-submint">
            [submit "Submit"]
        </div>
    </div>
    ';
    break;
    case "birthday-party":
        $form = '<div class="uacf7-wrapper-default">
        <h3 style="text-align:center; color:#14B8E5; font-weight:bold">Join Birthday Party!</h3>
        <p style="text-align:center">[You can add an Image/Logo Here]</p>
        <p style="text-align:center; color:#382673; font-weight:bold">Date: December 05, 2019 | Time: 12:00 am | Address: 3491 Henry Ford Avenue, Tulsa, OK, Oklahoma, 74120</p>
        <hr>
    
        <label>Name [text name]</label>
        <label>Phone [text phone]</label>
        <label>Email [text email]</label>
        <label>Food Type [checkbox food-type class:uacf7-checkbox "Vegan" "Non - Vegan"]</label>
        <label>How many people will you come with? [select number-of-guest class:uacf7-select include_blank "One" "Two" "Three" "Four" "Five"]</label>
    
        <label>Your Special Comments (If any) [textarea special-comments]</label>
    
        <div class="uacf7-submint">
            [submit "Submit"]
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