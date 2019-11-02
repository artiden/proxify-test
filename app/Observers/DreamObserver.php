<?php

namespace App\Observers;

use App\Dream;

class DreamObserver
{
    /**
     * A method will called when user's dream will be updating. Using for closing selected dream, when collected money >= needed sum.
     * 
     * @param Dream $dream
     */
    public function updating(Dream $dream)
    {
        if ($dream->collected >= $dream->needed) {
            $dream->closed = true;
        }
    }
}
