<?php

/**
 * user actions.
 *
 * @package    reservation
 * @subpackage user
 * @author     Aniket Kumar,Rohit Choudhary
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $groupId = $this->getUser()->getAttribute('groupId');
        $this->userGroup = UsersBasicFunctions::getUserGroup($groupId);
    }

    public function executeSignIn(sfWebRequest $request) {
        if ($this->getUser()->isAuthenticated()) {
            $this->redirect('/user/home');
        }
        if ($request->isMethod('post')) {
            $userEmail = $this->getRequestParameter('userEmail');
            $password = $this->getRequestParameter('userPass');

            /**
             * Validate username/password for data integrity
             */
            $usernameValidationResult = ValidateForm::forEmail($userEmail);
            $passwordValidationResult = ValidateForm::forPassword($password);

            if (!$usernameValidationResult) {
                $this->errorMsg = 'Email is not valid';
            } else if (!$passwordValidationResult) {
                $this->errorMsg = 'Password is not valid';
            } else {
                $user = new MyReservationUser($userEmail, $password);
                if (!$user->isValid()) {
                    $this->errorMsg = 'Invalid Username or Password/Inactive user';
                } else {
                    $this->getUser()->setAuthenticated(true);
                    $this->getUser()->setMyReservationUser($user);
                    $this->getUser()->setCredentials();
                    $this->getUser()->setAttribute('groupId', $user->getGroupId());
                    $this->getUser()->setAttribute('id', $user->getId());
                    $this->getUser()->setAttribute('name', $user->getUserNameFromID($user->getId()));
                    $this->redirect('/user/home');
                }
            }
        }
    }

    public function executeSignOut(sfWebRequest $request) {
        $flag = 0;
        if ($this->getUser()->isAuthenticated()) {
            $this->getUser()->clearCredentials();
            $this->getUser()->setAuthenticated(false);
        }
        $this->redirect('/');
    }

    public function executeForgotPassword(sfWebRequest $request) {
        $this->errorMsg = '';
        if ($request->isMethod('post')) {
            $emailId = $request->getParameter('email');
            $isValidEmail = ValidateForm::forEmail($emailId);
            if ($isValidEmail) {
                $userObj = new User;
                $user = $userObj->isEmailRegistered($emailId);
                if ($user) {
                    $generatePassword = $userObj->generateUserPassword();
                    $forgotPassword = $userObj->saveForgotPassword($user['0']['USER_ID'], $generatePassword);
                    if ($forgotPassword) {
                        $userObj->sendPasswordResetEmail($user, $generatePassword);
                        $this->errorMsg = 'Your Password Has Been Sent To Your Email Address.';
                        //  $this->setTemplate('forgotPasswordDone');
                    } else {
                        $this->errorMsg = 'Cannot send password to your e-mail address';
                    }
                } else {
                    $this->errorMsg = 'Not found your email in our database or Inactive';
                    //  exit;
                }
            } else {
                //$this->errorMsg = 'Invalid Email ID';
                //exit;
            }
        } else {
            $this->errorMsg = '';
        }
    }

    public function executeChangePassword(sfWebRequest $request) {
        $this->errorArr = '';
        if ($request->isMethod('post')) {
            $oldpassword = $request->getParameter('oldpassword');
            $newpassword = $request->getParameter('newpassword');
            $repeatnewpassword = $request->getParameter('repeatnewpassword');

            $userChangePasswordInfo = array(
                'oldpassword' => $oldpassword,
                'newpassword' => $newpassword,
                'repeatnewpassword' => $repeatnewpassword,
                'userId' => $this->getUser()->getAttribute('id')
            );
            $UsersBasicFunctions = new UsersBasicFunctions;
            $changePass = $UsersBasicFunctions->userChangePassword($userChangePasswordInfo);
            if ($changePass['success'] == true) {
                $this->errorArr = $changePass['msg'][0];
            } else {
                $this->errorArr = $changePass['msg'][0];
            }
        }
    }

}
