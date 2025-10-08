<?php

namespace App\Helpers;

class ContactHelper
{
    /**
     * Get all phone numbers as an array
     */
    public static function getAllPhones(): array
    {
        return collect(config('settings.phones'))->filter()->values()->toArray();
    }

    /**
     * Get formatted phone numbers
     */
    public static function getFormattedPhones(): array
    {
        return collect(config('settings.phones'))->map(function($phone) {
            return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $phone);
        })->filter()->values()->toArray();
    }

    /**
     * Get primary phone number
     */
    public static function getPrimaryPhone(): string
    {
        return config('settings.contact.primary_phone');
    }

    /**
     * Get company email
     */
    public static function getCompanyEmail(): string
    {
        return config('settings.contact.email');
    }

    /**
     * Get company address
     */
    public static function getCompanyAddress(): string
    {
        return config('settings.company.address');
    }

    /**
     * Get WhatsApp number (formatted for WhatsApp links)
     */
    public static function getWhatsAppNumber(): string
    {
        return str_replace('+', '', config('settings.contact.whatsapp'));
    }
}

