<?php

namespace App\Enums;

enum Comparison
{
    case Equals;
    case NotEqual;
    case More;
    case MoreOrEqual;
    case Less;
    case LessOrEqual;
}
