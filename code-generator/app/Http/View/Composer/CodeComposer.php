<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;
use App\Models\Code;

class CodeComposer
{
    public function compose(View $view)
    {
        $codes = Code::all();
        $view->with('codes', $codes);
    }
}
