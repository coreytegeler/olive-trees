<?php

namespace Kirby\Cms;

/**
 * Extension of the basic blueprint class
 * to handle all blueprints for users.
 */
class UserBlueprint extends Blueprint
{
    public function __construct(array $props)
    {
        parent::__construct($props);

        // normalize all available page options
        $this->props['options'] = $this->normalizeOptions(
            $props['options'] ?? true,
            // defaults
            [
                'create'         => null,
                'changeEmail'    => null,
                'changeLanguage' => null,
                'changeName'     => null,
                'changePassword' => null,
                'changeRole'     => null,
                'delete'         => null,
                'update'         => null,
            ]
        );
    }
}
