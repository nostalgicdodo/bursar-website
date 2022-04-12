<?php

use ThisProject\CMS\WordPress\Frontend;

Frontend\jQueryMigrate::remove();
// By default, `$` is (for some reason) not an alias for `jQuery`
Frontend\jQueryAlias::add();
