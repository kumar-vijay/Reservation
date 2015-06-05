<?php

/**
 * Description of ValidateForm
 *
 * @author Aniket Kumar
 * @Objective       :   This file is for server side validation.
 */
class ValidateForm {


    /**
     * This method validates the username
     * @param type $username
     * @return boolean true if username id is valid otherwise false
     */
    public static function forUsername($username) {
        if (preg_match('/^[a-z](?=[\w.]{3,31}$)\w*\.?\w*$/i', $username)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method validates the password
     * @param type $password
     * @return boolean true if password value is valid otherwise false
     */
    public static function forPassword($password) {
        if (preg_match('/^\S{6,20}\z/', $password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method validates the Email Id
     * @param type $emailId
     * @return boolean true if email id is valid otherwise false
     */
    public static function forEmail($emailId) {
        if (filter_var($emailId, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method validates the phone number
     * @param type $phoneNumber
     * @return boolean
     */
    public static function forPhoneNumber($phoneNumber) {
        if (preg_match('/^[9|8|7]{1}[0-9]{9}\z/', $phoneNumber)) {
            return true;
        } else {
            return false;
        }
    }

    public static function forName($name) {
        if (preg_match('/^[a-zA-Z]{3,150}$/', $name)) {
            return true;
        } else {
            return false;
        }
    }

    public static function forGroupName($groupName) {

        if (preg_match('/^[a-zA-Z0-9 ]{3,150}$/', $groupName)) {
            return true;
        } else {
            return false;
        }
    }

    public static function forCallingCapacity($number) {
        if (preg_match('/^[1-9][0-9]{0,2}$/', $number)) {
            return true;
        } else {
            return false;
        }
        die;
    }

    public static function forSpamNumberCheck($phoneNo) {
        if (preg_match('/^[9|8|7]{1}[0-9]{9}\z/', $phoneNo)) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function  forFullName($string){
        if (preg_match("/^[a-z]+(\s+[a-z]+)*$/i", $string)) {
            return true;
        } else {
            return false;
        }
    }

}

?>
