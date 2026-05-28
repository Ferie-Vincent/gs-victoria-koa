<?php

namespace App\View\Composers;

use App\Models\ContactMessage;
use Illuminate\View\View;

class AdminComposer
{
    public function compose(View $view): void
    {
        $view->with('nbNonLus', ContactMessage::where('lu', false)->count());
    }
}
