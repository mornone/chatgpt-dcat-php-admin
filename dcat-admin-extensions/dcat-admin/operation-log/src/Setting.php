<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace Dcat\Admin\OperationLog;

use Dcat\Admin\Extend\Setting as Form;
use Dcat\Admin\OperationLog\Models\OperationLog;
use Dcat\Admin\Support\Helper;

class Setting extends Form
{
    public function title()
    {
        return $this->trans('log.title');
    }

    public function form()
    {
        $this->tags('except');
        $this->multipleSelect('allowed_methods')
            ->options(array_combine(OperationLog::$methods, OperationLog::$methods));
        $this->tags('secret_fields');
    }

    protected function formatInput(array $input)
    {
        $input['except'] = Helper::array($input['except']);
        $input['allowed_methods'] = Helper::array($input['allowed_methods']);

        return $input;
    }
}
