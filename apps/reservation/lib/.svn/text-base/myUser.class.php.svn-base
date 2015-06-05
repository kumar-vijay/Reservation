<?php

class myUser extends sfBasicSecurityUser
{
    
    
    /**
     *
     * @var type represents the MyReservationUser object 
     */
    protected $MyReservationUser = null;
    
    /**
     * This method sets the variable MyLmsUser
     * 
     * @param MyLmsUser $user 
     */
    public function setMyReservationUser(MyReservationUser $user) {
        $this->MyReservationUser = $user;
    }

    /**
     * This method returns the MyLmsUser object
     * @return type object of MyLmsUser class
     */
    public function getMyReservationUser() {
        return $this->MyReservationUser;
    }

    /**
     * This method set the MyLmsUser variable to null 
     */
    public function removeMyReservationUser() {
        $this->MyReservationUser = null;
    }

    /**
     * This method sets the crdentials for user
     * @return boolean 
     */
    public function setCredentials() {
            //todo in future written earlier
            //Future is here buddy :)
            if($this->MyReservationUser->getRights()!=false){
                $this->addCredentials($this->MyReservationUser->getRights());
            }
            
           // This is left as it to perform curren functionality
//            echo '<pre>';
//            print_r($this->getCredentials());
//            echo '</pre>';
//            die;
            $this->addCredentials('AuthenticatedUser');
    }
    
 
}
