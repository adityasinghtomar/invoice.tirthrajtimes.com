# Invoice Language Support Implementation

## Overview
This implementation adds support for both Hindi and English versions of invoices in the Tirthraj Times Invoice Management System. The system now allows users to select the language when creating or editing invoices, and generates PDFs with appropriate headers, signatures, and terms of service based on the selected language.

## Changes Made

### 1. Configuration File Updates (`includes/config.php`)
Added language-specific constants:

```php
// HINDI VERSION
define('HEADER_LOGO_HINDI', 'images/header_logo.png');
define('SIGNATURE_IMAGE_HINDI', 'images/sign.png');
define('TERMS_OF_SERVICE_HINDI', 'नोट : <br>1) भुगतान हिंदी दैनिक तीर्थराज टाइम्स को ही करें<br>...');
define('PAYMENT_DETAILS_HINDI', 'खाता धारक का नाम : तीर्थराज टाइम्स<br>...');

// ENGLISH VERSION
define('HEADER_LOGO_ENGLISH', 'images/header_logo_english.png');
define('SIGNATURE_IMAGE_ENGLISH', 'images/sign_english.png');
define('TERMS_OF_SERVICE_ENGLISH', 'Note: <br>1) Payment should be made to Hindi Daily Tirthraj Times only<br>...');
define('PAYMENT_DETAILS_ENGLISH', 'NAME OF ACCOUNT HOLDER: TIRTHRAJ TIMES<br>...');
```

### 2. Invoice Class Updates (`invoice.php`)
- Added `$language` property with default value 'hindi'
- Added `setLanguage($lang)` method
- Updated `create_pdf()` method to use language-specific configurations:
  - Header logo selection based on language
  - Payment details in appropriate language
  - Signature image selection
  - Terms of service in selected language

### 3. Database Schema Update
Created SQL script (`add_language_column.sql`) to add language support:
```sql
ALTER TABLE `invoices` ADD COLUMN `language` VARCHAR(10) NOT NULL DEFAULT 'hindi' AFTER `GSTN`;
```

### 4. Form Updates
#### Invoice Creation Form (`invoice-create.php`)
- Added language selection dropdown with Hindi and English options
- Default selection is Hindi

#### Invoice Edit Form (`invoice-edit.php`)
- Added language selection dropdown
- Shows currently selected language when editing existing invoices

### 5. Backend Processing (`response.php`)
#### Create Invoice Action:
- Added `$invoice_language` parameter handling
- Set language for both invoice objects using `setLanguage()` method
- Updated database INSERT query to include language field

#### Update Invoice Action:
- Added language parameter handling
- Updated database INSERT query to include language field
- Set language for invoice object during update

## Required Assets

### For English Version:
You need to create these image files:
1. `images/header_logo_english.png` - English version of the header logo
2. `images/sign_english.png` - English version of the signature

### Current Hindi Assets:
- `images/header_logo.png` - Hindi header logo (already exists)
- `images/sign.png` - Hindi signature (already exists)

## Database Migration
Run the SQL script to add the language column:
```bash
mysql -u username -p database_name < add_language_column.sql
```

## Usage

### Creating New Invoice:
1. Select language from the dropdown (Hindi/English)
2. Fill in other invoice details
3. Generated PDF will use appropriate language-specific elements

### Editing Existing Invoice:
1. Language dropdown shows current selection
2. Change language if needed
3. Updated PDF will reflect the new language selection

## Language-Specific Elements

### Hindi Version:
- Uses `header_logo.png`
- Uses `sign.png`
- Payment details in Hindi
- Terms of service in Hindi

### English Version:
- Uses `header_logo_english.png`
- Uses `sign_english.png`
- Payment details in English
- Terms of service in English

## Benefits
1. **Bilingual Support**: Serves both Hindi and English speaking clients
2. **Professional Appearance**: Language-appropriate headers and signatures
3. **Flexible Configuration**: Easy to modify language-specific content via config file
4. **Backward Compatibility**: Existing invoices default to Hindi
5. **User-Friendly**: Simple dropdown selection for language choice

## Future Enhancements
- Add more languages
- Language-specific number formatting
- Localized date formats
- Currency symbol localization
