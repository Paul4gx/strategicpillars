<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Realtor = 'realtor';
    case Client = 'client';
}
