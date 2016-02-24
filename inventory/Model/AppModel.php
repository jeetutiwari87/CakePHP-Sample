<?php

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    function unbindValidation($type, $fields, $require = false) {


        if ($type === 'remove') {
            $this->validate = array_diff_key($this->validate, array_flip($fields));
        } elseif ($type === 'keep') {
            $this->validate = array_intersect_key($this->validate, array_flip($fields));
        }



        if ($require === true) {
            foreach ($this->validate as $field => $rules) {
                if (is_array($rules)) {
                    $rule = key($rules);

                    $this->validate[$field][$rule]['required'] = true;
                } else {
                    $ruleName = (ctype_alpha($rules)) ? $rules : 'required';

                    $this->validate[$field] = array($ruleName => array('rule' => $rules, 'required' => true));
                }
            }
        }
    }

    function changeFromEmail($from_address = null) {
        if (!empty($from_address)) {
            if (preg_match('|<(.*)>|', $from_address, $matches)) {
                return $matches[1];
            } else {
                return $from_address;
            }
        }
    }

    function formatToAddress($user = null) {
        if (!empty($user['User']['username']) && !empty($user['User']['username'])) {
            return $user['User']['username'] . ' <' . $user['User']['email'] . '>';
        } else {
            return $user['User']['email'];
        }
    }

   

    public function uploadFiles($check, $path, $field_name) {

        $key = key($check);

        $uploadData = array_shift($check);

        $ext = pathinfo($uploadData['name']);

        if ($uploadData['size'] == 0 || $uploadData['error'] !== 0) {
            return false;
        }


        $uploadFolder = 'uploads' . DS . $path;
        $fileName = uniqid() . '.' . $ext['extension'];
        $uploadPath = $uploadFolder . DS . $fileName;

        if (!file_exists($uploadFolder)) {
            $oldmask = umask(0);
            mkdir($uploadFolder, 0777);
            umask($oldmask);
        }


        if (move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
            if (isset($this->data[$this->alias]['id'])) {
                $this->unlinkFile($key, $path);
            }

            $this->set($field_name, $fileName);
            $this->data[$this->alias][$key] = $fileName;


            return true;
        }

        return false;
    }

    public function unlinkFile($key, $path) {
        if (isset($this->data[$this->alias]['id'])) {
            $files = $this->find('first', array('conditions' => array($this->alias . '.id' => $this->data[$this->alias]['id']), 'fields' => array($this->alias . "." . $key)));
            @unlink(WWW_ROOT . 'uploads/' . $path . '/' . $files[$this->alias][$key]);
        }
    }

    public function deleteFile($key, $path) {

        $files = $this->find('first', array('conditions' => array($this->alias . '.id' => $this->id), 'fields' => array($this->alias . "." . $key)));

        @unlink(WWW_ROOT . 'uploads/' . $path . '/' . $files[$this->alias][$key]);
    }

}
