<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_ALL, array('en_US.UTF-8', 'en_US.UTF8', 'enu_usa'));

define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('JQUERY_DATEPICKER_I18N_CODE', ''); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'mm/dd/yy'); // see http://docs.jquery.com/UI/Datepicker/formatDate

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'USD');
define('PRIVACY_POLICY', 'គោលការណ៍​ភាព​ឯកជន');
define('Terms_Conditions', 'ល័ក្ខខ័ណ្ឌនៃកម្មវិធី');
define('Disclaimer', 'ការមិនទទួលខុសត្រូវ');
// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="en"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', STORE_NAME);
define(PROPERTY, 'អចលនទ្រព្យ');
define(LISTING, 'តារាង');
define(RENT, 'សម្រាប់ជួល');
define(SALE, 'សម្រាប់លក់');
define(BOTH, 'លក់និងជួល');

define(BEDS, 'គ្រែដេក');
define(BATHS, 'បន្ចបទឹក់');
// customer language 
define('POST_PROPERTY', 'បង្កើតអចលនទ្រព្យ');
define('MENU_AGENTS', 'ភ្នាក់ងារ');
define('MENU_NEWS', 'ពត័មាន');
define('FEATURED', 'លក្ខណៈពិសេសជាងគេ');
define('LOGIN', 'ចូល គណនី');
define('REGISTER', 'ចុះឈ្មោះ');

define('HEADING_FOOTER_PROFILE', 'ប្រវត្តិ');
define('HEADING_FOOTER_TERM', 'រយៈពេល');
define('HEADING_FOOTER_CONTACT', 'ការ​ទំនាក់ទំនង');
define('HEADING_FOOTER_ABOUT', 'អំពី');


// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Create an Account');
define('HEADER_TITLE_MY_ACCOUNT', 'គណនី​របស់ខ្ញុំ');
define('HEADER_TITLE_CART_CONTENTS', 'Cart Contents');
define('HEADER_TITLE_CHECKOUT', 'Checkout');
define('HEADER_TITLE_TOP', '<i class="glyphicon glyphicon-home"></i>');
define('HEADER_TITLE_CATALOG', 'Catalog');
define('HEADER_TITLE_LOGOFF', 'ចាកចេញ');
define('HEADER_TITLE_LOGIN', 'Log In');

// text for gender
define('MALE', 'M<span class="hidden-xs">ale</span>');
define('FEMALE', 'F<span class="hidden-xs">emale</span>');
define('MALE_ADDRESS', 'Mr.');
define('FEMALE_ADDRESS', 'Ms.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Delivery Information');
define('CHECKOUT_BAR_PAYMENT', 'Payment Information');
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmation');
define('CHECKOUT_BAR_FINISHED', 'Finished!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Please Select');
define('TYPE_BELOW', 'Type Below');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form.\n\nPlease make the following corrections:\n\n');

define('JS_REVIEW_TEXT', '* The \'Review Text\' must have at least ' . REVIEW_TEXT_MIN_LENGTH . ' characters.\n');
define('JS_REVIEW_RATING', '* You must rate the product for your review.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Please select a payment method for your order.\n');

define('JS_ERROR_SUBMITTED', 'This form has already been submitted. Please press Ok and wait for this process to be completed.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Please select a payment method for your order.');
define('TEXT_PLAN', 'ការបង់សេវាកម្មនៅ SingaProperty.com តម្លៃសម្រាប់ការបោះពុម្ភផ្សាយនៅក្នុងការផ្តល់ជូនពិសេសផ្សព្វផ្សាយពាណិជ្ជកម្ម SingaProperty.com
ការផ្សព្វផ្សាយពាណិជ្ជកម្មមានឋានៈខ្ពស់ជាងអចលនទ្រព្យត្រូវបានបង្ហាញមុនពេលដែលការផ្សព្វផ្សាយពាណិជ្ជកម្មអចលនទ្រព្យផ្សេងទៀត។
ទាំងអស់ការផ្សព្វផ្សាយពាណិជ្ជកម្មអចលនទ្រព្យនៅជាមួយរយៈពេលនៃការ 30 ថ្ងៃ។ ប្រសិនបើចំនួនបេក្ខជនដែលចង់បាន
ត្រូវបានទៅដល់កាលពីដើមអ្នកមានជម្រើសដើម្បីបញ្ឈប់ការផ្សព្វផ្សាយពាណិជ្ជកម្មអចលនទ្រព្យនេះ។
        ');
define('CATEGORY_COMPANY', 'Company Details');
define('CATEGORY_PERSONAL', 'Your Personal Details');
define('CATEGORY_ADDRESS', 'Your Address');
define('CATEGORY_CONTACT', 'Your Contact Information');
define('CATEGORY_OPTIONS', 'Options');
define('CATEGORY_PASSWORD', 'Your Password');
define('ENTRY_MANAGE_POST', 'គ្រប់គ្រងអចលនទ្រព្យ');
define('ENTRY_MANAGE_NEWS', 'គ្រប់គ្រងព័ត៍មាន');
define('ENTRY_MY_ACCOUNT', 'គណនី​របស់ខ្ញុំ');
define('ENTRY_COMPANY', 'Company Name');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Gender');
define('ENTRY_GENDER_ERROR', 'Please select your Gender.');
define('ENTRY_GENDER_TEXT', '');
define('ENTRY_FIRST_NAME', 'First Name');
define('ENTRY_NAME', 'ឈ្មោះអ្នកប្រើ');
define('ENTRY_FIRST_NAME_ERROR', 'Your First Name must contain a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.');
define('ENTRY_FIRST_NAME_TEXT', '');
define('ENTRY_NAME_TEXT', '');
define('ENTRY_LAST_NAME', 'Last Name');
define('ENTRY_LAST_NAME_ERROR', 'Your Last Name must contain a minimum of ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.');
define('ENTRY_LAST_NAME_TEXT', '');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Your Date of Birth must be in this format: MM/DD/YYYY (eg 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', 'eg. 05/21/1970');
define('ENTRY_EMAIL_ADDRESS', 'អាស័យ​ដ្ឋាន​អ៊ី​ម៉េ​ល');
define('ENTRY_ADDRESS', 'អាសយដ្ឋាន');
define('ENTRY_LOCATION', 'ទីតាំង');
define('ENTRY_USER_NAME', 'ឈ្មោះអ្នកប្រើ');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'អាសយដ្ឋានអ៊ីមែលរបស់អ្នកត្រូវតែមានអប្បរមានៃការមួយ ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' តួអក្សរ.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'អ៊ីម៉ែលអាសយដ្ឋានរបស់អ្នកមិនត្រឹមត្រូវ - សូមធ្វើការកែតម្រូវចាំបាច់ណាមួយ។');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'អាសយដ្ឋានអ៊ីមែលរបស់អ្នករួចហើយនៅក្នុងកំណត់ត្រារបស់យើង - សូមចូលជាមួយអាសយដ្ឋានអ៊ីម៉ែលឬបង្កើតគណនីមួយជាមួយអាសយដ្ឋានផ្សេង។');
define('ENTRY_EMAIL_ADDRESS_TEXT', '');
define('ENTRY_STREET_ADDRESS', 'Street Address');
define('ENTRY_STREET_ADDRESS_ERROR', 'Your Street Address must contain a minimum of ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.');
define('ENTRY_STREET_ADDRESS_TEXT', '');
define('ENTRY_SUBURB', 'Suburb');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Post Code');
define('ENTRY_POST_CODE_ERROR', 'Your Post Code must contain a minimum of ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.');
define('ENTRY_POST_CODE_TEXT', '');
define('ENTRY_CITY', 'City');
define('ENTRY_CITY_ERROR', 'Your City must contain a minimum of ' . ENTRY_CITY_MIN_LENGTH . ' characters.');
define('ENTRY_CITY_TEXT', '');
define('ENTRY_STATE', 'State/Province');
define('ENTRY_STATE_ERROR', 'Your State must contain a minimum of ' . ENTRY_STATE_MIN_LENGTH . ' characters.');
define('ENTRY_STATE_ERROR_SELECT', 'Please select a state from the States pull down menu.');
define('ENTRY_STATE_TEXT', '');
define('ENTRY_COUNTRY', 'Country');
define('ENTRY_COUNTRY_ERROR', 'You must select a country from the Countries pull down menu.');
define('ENTRY_COUNTRY_TEXT', '');
define('ENTRY_TELEPHONE_NUMBER', 'លេខទូរស័ព្ទ');
define('ENTRY_PHOTO', 'រូបថត');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Your Telephone Number must contain a minimum of ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '');
define('ENTRY_FAX_NUMBER', 'Fax Number');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');
define('ENTRY_PASSWORD', 'ពាក្យសម្ងាត់');
define('ENTRY_PASSWORD_ERROR', 'ពាក្យសម្ងាត់របស់អ្នកត្រូវតែមានអប្បរមានៃការមួយ' . ENTRY_PASSWORD_MIN_LENGTH . ' តួអក្សរ.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'អះអាងពាក្យសម្ងាត់ត្រូវតែផ្គូផ្គងពាក្យសម្ងាត់របស់អ្នក។');
define('ENTRY_PASSWORD_TEXT', '');
define('ENTRY_PASSWORD_CONFIRMATION', 'ការ​បញ្ជាក់​ពាក្យ​សម្ងាត់');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '');
define('ENTRY_PASSWORD_CURRENT', 'លេខសំងាត់​បច្ចុប្បន្ន');
define('ENTRY_PASSWORD_CURRENT_TEXT', '');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'ពាក្យសម្ងាត់របស់អ្នកត្រូវតែមានអប្បរមានៃការមួយ' . ENTRY_PASSWORD_MIN_LENGTH . '  តួអក្សរ.');
define('ENTRY_PASSWORD_NEW', 'ពាក្យសម្ងាត់​ថ្មី');
define('ENTRY_PASSWORD_NEW_TEXT', '');
define('ENTRY_PASSWORD_NEW_ERROR', 'ពាក្យសម្ងាត់ថ្មីរបស់អ្នកត្រូវតែមានអប្បរមានៃការមួយ' . ENTRY_PASSWORD_MIN_LENGTH . '  តួអក្សរ.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'អះអាងពាក្យសម្ងាត់ត្រូវតែផ្គូផ្គងពាក្យសម្ងាត់ថ្មីរបស់អ្នក.');
define('PASSWORD_HIDDEN', '--HIDDEN--');

define('ENTRY_TYPE', 'ប្រភេទ');
define('ENTRY_NORMAL', 'ធម្មតា');
define('ENTRY_AGENCY', 'ភ្នាកងារ');


// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Result Pages:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> products)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> orders)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> reviews)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> new products)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> specials)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'First Page');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Previous Page');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Next Page');
define('PREVNEXT_TITLE_LAST_PAGE', 'Last Page');
define('PREVNEXT_TITLE_PAGE_NO', 'Page %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Previous Set of %d Pages');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Next Set of %d Pages');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;FIRST');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Prev]');
define('PREVNEXT_BUTTON_NEXT', '[Next&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'LAST&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Add Address');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Address Book');
define('IMAGE_BUTTON_BACK', 'ត្រឡប់ក្រោយ');
define('IMAGE_BUTTON_BUY_NOW', 'Buy Now');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Change Address');
define('IMAGE_BUTTON_CHECKOUT', 'Checkout');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirm Order');
define('IMAGE_BUTTON_CONTINUE', 'បន្ត');
define('IMAGE_BUTTON_REGISTER', 'ចុះឈ្មោះ​ឥឡូវនេះ');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continue Shopping');
define('IMAGE_BUTTON_DELETE', 'Delete');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'កែសម្រួលគណនី');
define('IMAGE_BUTTON_HISTORY', 'Order History');
define('IMAGE_BUTTON_LOGIN', 'ចូល');
define('IMAGE_BUTTON_IN_CART', 'Add to Cart');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notifications');
define('IMAGE_BUTTON_QUICK_FIND', 'Quick Find');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Remove Notifications');
define('IMAGE_BUTTON_REVIEWS', 'Reviews');
define('IMAGE_BUTTON_SEARCH', 'Search');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Shipping Options');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Tell a Friend');
define('IMAGE_BUTTON_UPDATE', 'Update');
define('IMAGE_BUTTON_UPDATE_CART', 'Update Cart');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Write Review');

define('SMALL_IMAGE_BUTTON_DELETE', 'លុប');
define('SMALL_IMAGE_BUTTON_EDIT', 'Edit');
define('SMALL_IMAGE_BUTTON_VIEW', 'View');
define('SMALL_IMAGE_BUTTON_BUY', 'Buy');

define('ICON_ARROW_RIGHT', 'more');
define('ICON_CART', 'In Cart');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Success');
define('ICON_WARNING', 'Warning');

define('TEXT_GREETING_PERSONAL', 'Welcome back <span class="greetUser">%s!</span> Would you like to see which <a href="%s"><u>new products</u></a> are available to purchase?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>If you are not %s, please <a href="%s"><u>log yourself in</u></a> with your account information.</small>');
define('TEXT_GREETING_GUEST', 'Welcome <span class="greetUser">Guest!</span> Would you like to <a href="%s"><u>log yourself in</u></a>? Or would you prefer to <a href="%s"><u>create an account</u></a>?');

define('TEXT_SORT_PRODUCTS', 'Sort products ');
define('TEXT_DESCENDINGLY', 'descendingly');
define('TEXT_ASCENDINGLY', 'ascendingly');
define('TEXT_BY', ' by ');

define('TEXT_REVIEW_BY', 'by %s');
define('TEXT_REVIEW_WORD_COUNT', '%s words');
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Date Added: %s');
define('TEXT_NO_REVIEWS', 'There are currently no product reviews.');

define('TEXT_NO_NEW_PRODUCTS', 'There are currently no products.');

define('TEXT_UNKNOWN_TAX_RATE', 'Unknown tax rate');

define('TEXT_REQUIRED', '<span class="errorText">Required</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><strong><small>TEP ERROR:</small> Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</strong></font>');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'The expiry date entered for the credit card is invalid. Please check the date and try again.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'The credit card number entered is invalid. Please check the number and try again.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'The first four digits of the number entered are: %s. If that number is correct, we do not accept that type of credit card. If it is wrong, please try again.');

// category views
define('TEXT_VIEW', 'View: ');
define('TEXT_VIEW_LIST', ' List');
define('TEXT_VIEW_GRID', ' Grid');

define('TEXT_ALL_LOCATION', 'ខេត្ត');
define('TEXT_TYPE', 'ប្រភេទ');
define('TEXT_SEARCH','ស្វែងរក');
// search placeholder
define('TEXT_SEARCH_PLACEHOLDER','Search');

// message for required inputs
define('FORM_REQUIRED_INFORMATION', '<span class="glyphicon glyphicon-asterisk font-color inputRequirement"></span> ពត៏មានត្រូវការ');
define('FORM_REQUIRED_INPUT', '<span><span class="glyphicon glyphicon-asterisk font-color form-control-feedback inputRequirement"></span></span>');

// reviews
define('REVIEWS_TEXT_RATED', 'Rated %s by <cite title="%s" itemprop="reviewer">%s</cite>');
define('REVIEWS_TEXT_AVERAGE', 'Average rating based on <span itemprop="count">%s</span> review(s) %s');
define('REVIEWS_TEXT_TITLE', 'What our customers say...');

// grid/list
define('TEXT_SORT_BY', 'Sort By ');
// moved from index
define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Product Name');
define('TABLE_HEADING_MANUFACTURER', 'Manufacturer');
define('TABLE_HEADING_QUANTITY', 'Quantity');
define('TABLE_HEADING_PRICE', 'Price');
define('TABLE_HEADING_WEIGHT', 'Weight');
define('TABLE_HEADING_BUY_NOW', 'Buy Now');
define('TABLE_HEADING_LATEST_ADDED', 'Latest Products');

// product notifications
define('PRODUCT_SUBSCRIBED', '%s has been added to your Notification List');
define('PRODUCT_UNSUBSCRIBED', '%s has been removed from your Notification List');
define('PRODUCT_ADDED', '%s has been added to your Cart');
define('PRODUCT_REMOVED', '%s has been removed from your Cart');
define('TEXT_RELATE', 'អចលនទ្រព្យទាក់ទង');
define('TEXT_CONTACT_AGENCY', 'ភ្នាក់ងារទំនាក់ទំនង');
define('TEXT_MAKE_AN_ENQUIRY', 'បង្កើតសំណួរ');
define('TEXT_MESSAGE', 'សារ');
define('TEXT_SUBMIT', 'ផ្ញើ');