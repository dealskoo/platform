<?php

namespace Dealskoo\Platform\Models;

use Dealskoo\Platform\Traits\HasPlatform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dealskoo\Seller\Models\Seller as BaseSeller;

class Seller extends BaseSeller
{
    use HasFactory, HasPlatform;
}
