<?php

namespace App\Enums;

enum UserRole: string
{
    case MainAdmin = 'main_admin';
    case Admin = 'admin';
    case Realtor = 'realtor';
    case Client = 'client';
}
