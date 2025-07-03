<?php
/*******************************************************************************
*  Invoice 
* Billing Management System                                             *
*                                                                              *
* Version: 1.0	                                                               *
*******************************************************************************/

// Debugging
ini_set('error_reporting', E_ALL);

// DATABASE INFORMATION
define('DATABASE_HOST', getenv('IP'));
define('DATABASE_NAME', 'tirthrajtimes_invoice');
define('DATABASE_USER', 'tirthrajtimes_invoice');
define('DATABASE_PASS', 'tirthraj#25');

// COMPANY INFORMATION
define('COMPANY_LOGO', 'images/invoice_logo.jpeg');
define('COMPANY_LOGO_WIDTH', '300');
define('COMPANY_LOGO_HEIGHT', '90');
define('COMPANY_NAME','Tirthraj Times');
define('COMPANY_ADDRESS_1','पता : 1, अमरनाथ झा मार्ग, जार्ज टाउन, प्रयागराज');
define('COMPANY_ADDRESS_2','प्रयागराज');
define('COMPANY_ADDRESS_3',' UP');
define('COMPANY_COUNTY','India');
define('COMPANY_POSTCODE','');
define('COMPANY_MOBILE','मो  नं : 9936044444');
define('COMPANY_FAX','फैक्स नं : 0532-2256244');
define('COMPANY_EMAIL','इ-मेल : tirthraj_times@rediffmail.com');

define('COMPANY_NUMBER','Company No: 655454545'); // Company registration number
define('COMPANY_VAT', 'Company VAT: 645515154'); // Company TAX/VAT number

// EMAIL DETAILS
define('EMAIL_FROM', 'tirthraj_times@rediffmail.com'); // Email address invoice emails will be sent from
define('EMAIL_NAME', 'tirthraj_times@rediffmail.com'); // Email from address
define('EMAIL_SUBJECT', 'Tirth raj Times Invoice'); // Invoice email subject
define('EMAIL_BODY_INVOICE', 'Invoice default body'); // Invoice email body
define('EMAIL_BODY_QUOTE', 'Quote default body'); // Invoice email body
define('EMAIL_BODY_RECEIPT', 'Receipt default body'); // Invoice email body


define('GSTNO', 'GSTNO.-09ADVPT8605N3ZB');
// OTHER SETTINFS
define('INVOICE_PREFIX', '425/TRT/'); // Prefix at start of invoice - leave empty '' for no prefix
define('INVOICE_PREFIX2', '466/TRT/');
define('INVOICE_INITIAL_VALUE', '1'); // Initial invoice order number (start of increment)
define('INVOICE_THEME', '#222222'); // Theme colour, this sets a colour theme for the PDF generate invoice
define('TIMEZONE', 'Asia/Kolkata'); // Timezone - See for list of Timezone's http://php.net/manual/en/function.date-default-timezone-set.php
define('DATE_FORMAT', 'DD/MM/YYYY'); // DD/MM/YYYY or MM/DD/YYYY
define('CURRENCY', 'Rs.'); // Currency symbol
define('ENABLE_VAT', true); // Enable TAX/VAT
define('VAT_INCLUDED', false); // Is VAT included or excluded?
define('VAT_RATE', '10'); // This is the percentage value

define('PAYMENT_DETAILS', ' NAME OF ACCOUNT HOLDER :  TIRTHRAJ TIMES<br>NAME OF BANK: BANK OF MAHARASTRA<br>ACCOUNT NUMBER: 20066401247<br>BRANCH AND CITY : CIVIL LINES ALLAHABAD<br> IFSC CODE : MAHB0001291'); // Payment information
define('FOOTER_NOTE', '');

// LANGUAGE-SPECIFIC CONFIGURATIONS
// HINDI VERSION
define('HEADER_LOGO_HINDI', 'images/header_logo.png');
define('SIGNATURE_IMAGE_HINDI', 'images/sign.png');
define('TERMS_OF_SERVICE_HINDI', 'नोट : <br>

1)  भुगतान हिंदी दैनिक तीर्थराज टाइम्स को ही करें<br>
2)  आर.ओ. की मूल प्रति संलग्न<br>
3)  अंक प्राप्ति की रसीद संलग्न<br>
4)  डी.ए.वी.पी. की नवीनतम दर की प्रति संलग्न');

// ENGLISH VERSION
define('HEADER_LOGO_ENGLISH', 'images/header_logo_english.png');
define('SIGNATURE_IMAGE_ENGLISH', 'images/sign_english.png');
define('TERMS_OF_SERVICE_ENGLISH', 'Note: <br>

1) Payment should be made to Hindi Daily Tirthraj Times only<br>
2) Original copy of R.O. attached<br>
3) Receipt of issue receipt attached<br>
4) Copy of latest rates of D.A.V.P. attached');

// PAYMENT DETAILS - LANGUAGE VERSIONS
define('PAYMENT_DETAILS_HINDI', 'खाता धारक का नाम : तीर्थराज टाइम्स<br>बैंक का नाम: बैंक ऑफ महाराष्ट्र<br>खाता संख्या: 20066401247<br>शाखा और शहर : सिविल लाइन्स इलाहाबाद<br>IFSC कोड : MAHB0001291');
define('PAYMENT_DETAILS_ENGLISH', 'NAME OF ACCOUNT HOLDER: TIRTHRAJ TIMES<br>NAME OF BANK: BANK OF MAHARASTRA<br>ACCOUNT NUMBER: 20066401247<br>BRANCH AND CITY: CIVIL LINES ALLAHABAD<br>IFSC CODE: MAHB0001291');

// CONNECT TO THE DATABASE
$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

?>