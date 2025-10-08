# Environment Variables for Strategic Pillars

Add these variables to your `.env` file to configure contact information:

## Company Information
```
COMPANY_NAME="Strategic Pillars"
COMPANY_EMAIL="info@strategicpillars.com"
COMPANY_ADDRESS="2, Orchard Close, Chevron Drive, Lekki, Lagos, Nigeria"
```

## Contact Information
```
PRIMARY_PHONE="+2348094440599"
SECONDARY_PHONE="+2347053838423"
TERTIARY_PHONE="+2347078998690"
CONTACT_EMAIL="info@strategicpillars.com"
WHATSAPP_NUMBER="+2348094440599"
```

## Social Media Links
```
FACEBOOK_URL="https://facebook.com/strategicpillars"
TWITTER_URL="https://twitter.com/strategicpillars"
INSTAGRAM_URL="https://instagram.com/strategicpillars"
LINKEDIN_URL="https://linkedin.com/company/strategicpillars"

# Image Optimization Settings
IMAGE_DRIVER="gd"
IMAGE_QUALITY="85"
```

## Usage in Views

The contact information can now be accessed in your Blade templates using:

```php
{{ config('settings.company.name') }}
{{ config('settings.company.email') }}
{{ config('settings.company.address') }}
{{ config('settings.contact.primary_phone') }}
{{ config('settings.contact.secondary_phone') }}
{{ config('settings.contact.tertiary_phone') }}
{{ config('settings.contact.email') }}
{{ config('settings.contact.whatsapp') }}

// Get all phone numbers
@foreach(config('settings.phones') as $phone)
    {{ $phone }}
@endforeach

// Social media links
{{ config('settings.social.facebook') }}
{{ config('settings.social.twitter') }}
{{ config('settings.social.instagram') }}
{{ config('settings.social.linkedin') }}

// Using the ContactHelper class (optional)
@php
use App\Helpers\ContactHelper;
@endphp

{{ ContactHelper::getPrimaryPhone() }}
{{ ContactHelper::getCompanyEmail() }}
{{ ContactHelper::getCompanyAddress() }}
{{ ContactHelper::getWhatsAppNumber() }}

@foreach(ContactHelper::getAllPhones() as $phone)
    {{ $phone }}
@endforeach
```
