<?php

namespace OsKoala\Statistics;

use Dcat\Admin\Extend\Setting as Form;

class Setting extends Form
{
    public function form()
    {
        $this->text('title',"标题")->required();
    }
}
