<?php declare(strict_types=1);
echo new App\Admin\Forms\ChatgptConfigs(); ?>
<iframe src="{{config('chatgpt.front_url')}}/?uid={{Admin::user()->id}}#/chat" height="520px"></iframe>
