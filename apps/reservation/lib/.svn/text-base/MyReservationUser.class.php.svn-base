<?php

/**
 * @author Rohit Choudhary <rohit.choudhary@berkshireindia.com>
 * @Description This class is managing user actions like, login, logout
 * @Created_on: 28 May 2012
 */
class MyReservationUser {

    protected $isValid = false;
    protected $id = false;
    protected $groupId = false;
    protected $rights = array();

    /**
     * This function creates a object by taking 
     * username and password as input.
     * 
     * if the username and password matches it sets
     * the $isValid = true otherwise $isValid = false
     * 
     * @param type $username
     * @param type $password
     */
    public function __construct($emailId, $password) {
        $criteria = new Criteria();
        $criteria->add(UsersPeer::EMAIL_ID, $emailId, Criteria::EQUAL);
        $criteria->add(UsersPeer::PASSWORD, md5($password), Criteria::EQUAL); //      
        $criteria->add(UsersPeer::USER_STATUS, 'active', Criteria::EQUAL); //
        $user = UsersPeer::doSelectOne($criteria);
        if ($user) {
            $this->id = $user->getUserId();
            $criteria1 = new Criteria();
            $criteria1->clearSelectColumns();
            $criteria1->addSelectColumn(GroupsPeer::GROUP_ID);
            $criteria1->addJoin(UsersPeer::GROUP_ID, GroupsPeer::GROUP_ID);
            $criteria1->add(UsersPeer::USER_ID, $this->id, Criteria::EQUAL);
            $group = GroupsPeer::doSelectOne($criteria1);
            if ($group) {
                $this->groupId = $group->getGroupId();
                $con = Propel::getConnection();
                $stmt = $con->query("SELECT STATUS FROM GROUPS WHERE GROUP_ID = '" . $this->groupId . "'");
                $result = $stmt->fetchAll();
                if ($result[0]['STATUS'] == 'active') {
                    $this->_setRights();
                    $this->isValid = true;
                } else {
                    $this->isValid = false;
                }
            }
            //$this->isValid = true;
        } else {
            $this->isValid = false;
        }
    }

    /**
     * 
     * @return type - bool - if the user is valid the it will 
     * return true otherwise false
     */
    public function isValid() {
        return $this->isValid;
    }

    /**
     * 
     * @return type id
     */
    public function getId() {
        return $this->id;
    }

    public function getGroupId() {
        return $this->groupId;
    }

    /**
     * 
     * @return type rights
     */
    public function getRights() {
        return $this->rights;
    }

    private function _setRights() {
        $rightArray = MyGroup::getRightsAllocatedToGroup($this->groupId);
        foreach ($rightArray as $val) {
            $this->rights[] = $val['GROUP_RIGHTS_NAME'];
        }
    }

    /**
     * This methods checks whether the email id is regsitered with our system.
     * @param type $emailId
     * @return boolean true if email id is regsitered otherwise false
     */
    public static function isEmailIdRegistered($emailId) {
        $criteria = new Criteria();
        $criteria->add(UsersPeer::EMAIL_ID, $emailId, Criteria::EQUAL);
        $user = UsersPeer::doSelectOne($criteria);
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public static function getUserNameFromID($userId) {
        $criteria = new Criteria();
        $criteria->add(UsersPeer::USER_ID, $userId, Criteria::EQUAL);
        $user = UsersPeer::doSelectOne($criteria);
        if ($user) {
            return ucfirst($user->getFirstname()) . ' ' . ucfirst($user->getLastname());
        } else {
            return false;
        }
    }

}

?>
