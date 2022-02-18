<?php

namespace Dealskoo\Platform\Traits;

use Dealskoo\Platform\Models\Platform;

trait HasPlatform
{
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
