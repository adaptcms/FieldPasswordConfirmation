<?php

namespace Adaptcms\FieldPasswordConfirmation;

use Adaptcms\Base\Models\Package;

class FieldPasswordConfirmation
{
  /**
  * On Install
  *
  * @return void
  */
  public function onInstall()
  {
    Package::syncPackageFolder(get_class());
  }
}
