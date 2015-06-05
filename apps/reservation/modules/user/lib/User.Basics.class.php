<?php

/**
 *
 *
 * 
 *
 * 
 */
class UsersBasicFunctions {

    /**
     * @author Sumit Pachouri <sumit.pachouri@xceedance.com>
     * @param string $email
     * @return bool return true in case of email found else true
     * 
     */
    private $_con = NULL;
    private $_dateTime = NULL;

    public function __construct() {
        $this->_con = Propel::getConnection();
        $this->_dateTime = date('Y-m-d H:i:s');
    }

    public static function isEmailRegistered($email) {
        echo $email;

        exit;

        $criteria = new Criteria();
        $criteria->clearSelectColumns();
        $criteria->addSelectColumn(UsersPeer::EMAIL_ID);
        $criteria->add(UsersPeer::EMAIL_ID, $email, Criteria::EQUAL);
        //$criteria->toString();        
        if (UsersPeer::doCount($criteria) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method saves the forgot password key for the user
     * @param type $key
     * @return boolean true if forgot password key has been saved otherwise false
     */
    public static function saveForgotPasswordKey($key, $lmsUserId) {
        /**
         * Saving the new forgot password key
         */
        $UserForgotPassword = new Users();
        $UserForgotPassword->setPassword($key);
        $UserForgotPassword->setModifiedOn(date('d-m-Y H:i:s'));
        $UserForgotPassword->setModifiedById(date('d-m-Y H:i:s'));
        if ($UserForgotPassword->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function userChangePassword(array $changePasswordInfo) {
        $errFlag = false;
        $error = array();
        $con = new Criteria();
        $con->add(UsersPeer::USER_ID, $changePasswordInfo['userId']);
        $userInfo = UsersPeer::doSelectStmt($con);
        $result = $userInfo->fetchAll();
        $oldpassworddb = $result['0']['PASSWORD'];
        if (md5($changePasswordInfo['oldpassword']) == $oldpassworddb) {
            if ($changePasswordInfo['newpassword'] == $changePasswordInfo['repeatnewpassword']) {
                $wherec = new Criteria();
                $wherec->add(UsersPeer::USER_ID, $changePasswordInfo['userId'], Criteria::EQUAL);
                $updc = new Criteria();
                $updc->add(UsersPeer::MODIFIED_ON, $this->_dateTime)
                        ->add(UsersPeer::PASSWORD, md5($changePasswordInfo['newpassword']));
                BasePeer::doUpdate($wherec, $updc, $this->_con);
                $errFlag = false;
                $response['msg'][] = 'Password updated successfully';
                $response['success'] = true;
            }
        } else {
            $errFlag = true;
            $response['msg'][] = 'Please enter correct existing password';
            $response['success'] = false;
        }
        return $response;
    }
    
    public static function getUserGroup($group_id) {
        $con = Propel::getConnection();
        $query = "SELECT GROUP_NAME FROM Groups WHERE GROUP_ID =" . $group_id;
        $stmt = $con->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['GROUP_NAME'];
    }

}

?>
