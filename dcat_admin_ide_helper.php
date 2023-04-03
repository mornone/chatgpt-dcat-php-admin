<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Collection|Grid\Column id
     * @property Collection|Grid\Column name
     * @property Collection|Grid\Column type
     * @property Collection|Grid\Column version
     * @property Collection|Grid\Column detail
     * @property Collection|Grid\Column created_at
     * @property Collection|Grid\Column updated_at
     * @property Collection|Grid\Column is_enabled
     * @property Collection|Grid\Column parent_id
     * @property Collection|Grid\Column order
     * @property Collection|Grid\Column icon
     * @property Collection|Grid\Column uri
     * @property Collection|Grid\Column extension
     * @property Collection|Grid\Column permission_id
     * @property Collection|Grid\Column menu_id
     * @property Collection|Grid\Column slug
     * @property Collection|Grid\Column http_method
     * @property Collection|Grid\Column http_path
     * @property Collection|Grid\Column role_id
     * @property Collection|Grid\Column user_id
     * @property Collection|Grid\Column value
     * @property Collection|Grid\Column username
     * @property Collection|Grid\Column password
     * @property Collection|Grid\Column avatar
     * @property Collection|Grid\Column remember_token
     * @property Collection|Grid\Column request_body
     * @property Collection|Grid\Column ask
     * @property Collection|Grid\Column url
     * @property Collection|Grid\Column status
     * @property Collection|Grid\Column api_id
     * @property Collection|Grid\Column mode_id
     * @property Collection|Grid\Column question
     * @property Collection|Grid\Column uuid
     * @property Collection|Grid\Column connection
     * @property Collection|Grid\Column queue
     * @property Collection|Grid\Column payload
     * @property Collection|Grid\Column exception
     * @property Collection|Grid\Column failed_at
     * @property Collection|Grid\Column email
     * @property Collection|Grid\Column token
     * @property Collection|Grid\Column tokenable_type
     * @property Collection|Grid\Column tokenable_id
     * @property Collection|Grid\Column abilities
     * @property Collection|Grid\Column last_used_at
     * @property Collection|Grid\Column expires_at
     * @property Collection|Grid\Column email_verified_at
     *
     * @method Collection|Grid\Column id(string $label = null)
     * @method Collection|Grid\Column name(string $label = null)
     * @method Collection|Grid\Column type(string $label = null)
     * @method Collection|Grid\Column version(string $label = null)
     * @method Collection|Grid\Column detail(string $label = null)
     * @method Collection|Grid\Column created_at(string $label = null)
     * @method Collection|Grid\Column updated_at(string $label = null)
     * @method Collection|Grid\Column is_enabled(string $label = null)
     * @method Collection|Grid\Column parent_id(string $label = null)
     * @method Collection|Grid\Column order(string $label = null)
     * @method Collection|Grid\Column icon(string $label = null)
     * @method Collection|Grid\Column uri(string $label = null)
     * @method Collection|Grid\Column extension(string $label = null)
     * @method Collection|Grid\Column permission_id(string $label = null)
     * @method Collection|Grid\Column menu_id(string $label = null)
     * @method Collection|Grid\Column slug(string $label = null)
     * @method Collection|Grid\Column http_method(string $label = null)
     * @method Collection|Grid\Column http_path(string $label = null)
     * @method Collection|Grid\Column role_id(string $label = null)
     * @method Collection|Grid\Column user_id(string $label = null)
     * @method Collection|Grid\Column value(string $label = null)
     * @method Collection|Grid\Column username(string $label = null)
     * @method Collection|Grid\Column password(string $label = null)
     * @method Collection|Grid\Column avatar(string $label = null)
     * @method Collection|Grid\Column remember_token(string $label = null)
     * @method Collection|Grid\Column request_body(string $label = null)
     * @method Collection|Grid\Column ask(string $label = null)
     * @method Collection|Grid\Column url(string $label = null)
     * @method Collection|Grid\Column status(string $label = null)
     * @method Collection|Grid\Column api_id(string $label = null)
     * @method Collection|Grid\Column mode_id(string $label = null)
     * @method Collection|Grid\Column question(string $label = null)
     * @method Collection|Grid\Column uuid(string $label = null)
     * @method Collection|Grid\Column connection(string $label = null)
     * @method Collection|Grid\Column queue(string $label = null)
     * @method Collection|Grid\Column payload(string $label = null)
     * @method Collection|Grid\Column exception(string $label = null)
     * @method Collection|Grid\Column failed_at(string $label = null)
     * @method Collection|Grid\Column email(string $label = null)
     * @method Collection|Grid\Column token(string $label = null)
     * @method Collection|Grid\Column tokenable_type(string $label = null)
     * @method Collection|Grid\Column tokenable_id(string $label = null)
     * @method Collection|Grid\Column abilities(string $label = null)
     * @method Collection|Grid\Column last_used_at(string $label = null)
     * @method Collection|Grid\Column expires_at(string $label = null)
     * @method Collection|Grid\Column email_verified_at(string $label = null)
     */
    class Grid
    {
    }

    class MiniGrid extends Grid
    {
    }

    /**
     * @property Collection|Show\Field id
     * @property Collection|Show\Field name
     * @property Collection|Show\Field type
     * @property Collection|Show\Field version
     * @property Collection|Show\Field detail
     * @property Collection|Show\Field created_at
     * @property Collection|Show\Field updated_at
     * @property Collection|Show\Field is_enabled
     * @property Collection|Show\Field parent_id
     * @property Collection|Show\Field order
     * @property Collection|Show\Field icon
     * @property Collection|Show\Field uri
     * @property Collection|Show\Field extension
     * @property Collection|Show\Field permission_id
     * @property Collection|Show\Field menu_id
     * @property Collection|Show\Field slug
     * @property Collection|Show\Field http_method
     * @property Collection|Show\Field http_path
     * @property Collection|Show\Field role_id
     * @property Collection|Show\Field user_id
     * @property Collection|Show\Field value
     * @property Collection|Show\Field username
     * @property Collection|Show\Field password
     * @property Collection|Show\Field avatar
     * @property Collection|Show\Field remember_token
     * @property Collection|Show\Field request_body
     * @property Collection|Show\Field ask
     * @property Collection|Show\Field url
     * @property Collection|Show\Field status
     * @property Collection|Show\Field api_id
     * @property Collection|Show\Field mode_id
     * @property Collection|Show\Field question
     * @property Collection|Show\Field uuid
     * @property Collection|Show\Field connection
     * @property Collection|Show\Field queue
     * @property Collection|Show\Field payload
     * @property Collection|Show\Field exception
     * @property Collection|Show\Field failed_at
     * @property Collection|Show\Field email
     * @property Collection|Show\Field token
     * @property Collection|Show\Field tokenable_type
     * @property Collection|Show\Field tokenable_id
     * @property Collection|Show\Field abilities
     * @property Collection|Show\Field last_used_at
     * @property Collection|Show\Field expires_at
     * @property Collection|Show\Field email_verified_at
     *
     * @method Collection|Show\Field id(string $label = null)
     * @method Collection|Show\Field name(string $label = null)
     * @method Collection|Show\Field type(string $label = null)
     * @method Collection|Show\Field version(string $label = null)
     * @method Collection|Show\Field detail(string $label = null)
     * @method Collection|Show\Field created_at(string $label = null)
     * @method Collection|Show\Field updated_at(string $label = null)
     * @method Collection|Show\Field is_enabled(string $label = null)
     * @method Collection|Show\Field parent_id(string $label = null)
     * @method Collection|Show\Field order(string $label = null)
     * @method Collection|Show\Field icon(string $label = null)
     * @method Collection|Show\Field uri(string $label = null)
     * @method Collection|Show\Field extension(string $label = null)
     * @method Collection|Show\Field permission_id(string $label = null)
     * @method Collection|Show\Field menu_id(string $label = null)
     * @method Collection|Show\Field slug(string $label = null)
     * @method Collection|Show\Field http_method(string $label = null)
     * @method Collection|Show\Field http_path(string $label = null)
     * @method Collection|Show\Field role_id(string $label = null)
     * @method Collection|Show\Field user_id(string $label = null)
     * @method Collection|Show\Field value(string $label = null)
     * @method Collection|Show\Field username(string $label = null)
     * @method Collection|Show\Field password(string $label = null)
     * @method Collection|Show\Field avatar(string $label = null)
     * @method Collection|Show\Field remember_token(string $label = null)
     * @method Collection|Show\Field request_body(string $label = null)
     * @method Collection|Show\Field ask(string $label = null)
     * @method Collection|Show\Field url(string $label = null)
     * @method Collection|Show\Field status(string $label = null)
     * @method Collection|Show\Field api_id(string $label = null)
     * @method Collection|Show\Field mode_id(string $label = null)
     * @method Collection|Show\Field question(string $label = null)
     * @method Collection|Show\Field uuid(string $label = null)
     * @method Collection|Show\Field connection(string $label = null)
     * @method Collection|Show\Field queue(string $label = null)
     * @method Collection|Show\Field payload(string $label = null)
     * @method Collection|Show\Field exception(string $label = null)
     * @method Collection|Show\Field failed_at(string $label = null)
     * @method Collection|Show\Field email(string $label = null)
     * @method Collection|Show\Field token(string $label = null)
     * @method Collection|Show\Field tokenable_type(string $label = null)
     * @method Collection|Show\Field tokenable_id(string $label = null)
     * @method Collection|Show\Field abilities(string $label = null)
     * @method Collection|Show\Field last_used_at(string $label = null)
     * @method Collection|Show\Field expires_at(string $label = null)
     * @method Collection|Show\Field email_verified_at(string $label = null)
     */
    class Show
    {
    }

    class Form
    {
    }
}

namespace Dcat\Admin\Grid {
    class Column
    {
    }

    class Filter
    {
    }
}

namespace Dcat\Admin\Show {
    class Field
    {
    }
}
