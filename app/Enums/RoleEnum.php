<?php 
namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case AGENT = 'agent';
    case USER = 'user';
}