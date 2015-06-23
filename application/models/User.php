<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class User extends OaModel {

  static $table_name = 'users';

  static $has_one = array (
  );

  static $has_many = array (
    array ('pictures', 'class_name' => 'Picture')
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);

    OrmImageUploader::bind ('avatar', 'UserAvatarImageUploader');

  }

  public function destroy () {
    array_map (function ($picture) {
      $picture->destroy ();
    }, $this->pictures);

    return $this->avatar->cleanAllFiles () && $this->delete ();
  }
}