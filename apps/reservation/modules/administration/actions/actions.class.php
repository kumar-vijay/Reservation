<?php

/**
 * administration actions.
 *
 * @package    reservation
 * @subpackage administration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class administrationActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeGroups(sfWebRequest $request) {
        // if (sfContext::getInstance()->getUser()->hasCredential('ADD_EDIT_GROUP')) {
        $groupName = $request->getParameter('groupName', '');
        $groupStatus = $request->getParameter('groupStatus', '');
        $fromDate = $request->getParameter('fromDate', '');
        $toDate = $request->getParameter('toDate', '');
        //Saving this last search criteria
        $lastSearchCriteria = array(
            'groupName' => $groupName,
            'groupStatus' => $groupStatus,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        );
        $criteria = MyGroup::getSearchCriteria($lastSearchCriteria);
        $this->lastSearchCriteria = json_encode($lastSearchCriteria);
        $this->numberofResults = GroupsPeer::doCount($criteria);
        $this->pager = new sfPropelPager('Groups', sfConfig::get('app_pagination_groups', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        // } else {
        //   $this->redirect('@unauthorised_access');
        //}  
    }

    public function executeAddGroup(sfWebRequest $request) {
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $group = new MyGroup();
            $result = $group->saveGroup($postArray);
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', 'Group has been created successfully');
                $this->redirect('/admin/groups');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
        //Fetching all group rights
        $this->groupRights = Right::getAllRightsFromTable();
    }

    public function executeEditGroup(sfWebRequest $request) {
        if ($request->getParameter('groupId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $group = new MyGroup();
                $updateResponse = $group->saveGroup($postArray);
                if ($updateResponse['success'] == true) {
                    $this->getUser()->setFlash('success', 'Group has been updated successfully');
                    $this->redirect('/admin/groups');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            $this->groupRights = Right::getAllRightsFromTable();
            $this->groupInfo = MyGroup::getGroupInfo($request->getParameter('groupId'));
            if (!$this->groupInfo) {
                $this->redirect('/admin/groups');
            }
        } else {
            $this->redirect('/admin/groups');
        }
    }

    public function executeViewGroup(sfWebRequest $request) {
        if ($request->getParameter('groupId') != '') {
            $this->groupInfo = MyGroup::getGroupInfo($request->getParameter('groupId'));
            if (!$this->groupInfo) {
                $this->redirect('/admin/groups');
            }
        } else {
            $this->redirect('/admin/groups');
        }
    }

    public function executeAddUser(sfWebRequest $request) {
        $groupList = new UserFunctions;
        $this->groupDetails = $groupList->groupList();
        if ($request->isMethod('POST')) {
            $userDetails = $request->isMethod('POST');
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $user = new User();
            $result = $user->CreateUser($postArray);
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', 'User has been created successfully');
                $this->redirect('/admin/users');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
    }

    public function executeEditUser(sfWebRequest $request) {
        $this->userId = $this->getRequestParameter('userId');
        $userList = new UserFunctions;
        $this->groupDetails = $userList->groupList();
        if ($this->userId) {
            $this->userDetails = $userList->userEditInfo($this->userId);
            $this->currentUserGroupId = $this->getUser()->getAttribute('groupId');
        } else {
            $this->errMsg = "User is not exist";
        }
        if ($request->isMethod('POST')) {
            $userDetails = $request->isMethod('POST');
            $postArray = $request->getPostParameters();
            $user = new User();
            $postArray['userId'] = $this->getRequestParameter('userId');
            $postArray['adminId'] = $this->getUser()->getAttribute('id');
            $result = $user->EditUser($postArray);
            if ($result == true) {
                $this->getUser()->setFlash('success', 'User has been updated successfully');
                $this->redirect('/admin/users');
            } else {
                $this->errorArr = 'User is not create due to some error';
            }
        }
    }

    public function executeViewUser(sfWebRequest $request) {
        $this->userId = $this->getRequestParameter('userId');
        $userList = new UserFunctions;
        if ($this->userId) {
            $this->userDetails = $userList->userEditInfo($this->userId);
            $this->currentUserGroupId = $this->userDetails['0']['GROUP_ID'];
            $this->groupDetails = $userList->getGroupName($this->currentUserGroupId);
        } else {
            $this->errMsg = "User does not exist";
        }
    }

    public function executeUsers(sfWebRequest $request) {
        //Saving this last search criteria
        $userSearchCriteria = array(
            'userName' => $request->getParameter('userName'),
            'userStatus' => $request->getParameter('userStatus'),
            'fromDate' => $request->getParameter('fromDate'),
            'toDate' => $request->getParameter('toDate')
        );
        $userList = new UserFunctions;
        $criteria = $userList->userList($userSearchCriteria);
        $this->lastSearchCriteria = json_encode($userSearchCriteria);
        $this->currentUserGroupId = $this->getUser()->getAttribute('groupId');
        $this->numberofResults = UsersPeer::doCount($criteria);
        $this->pager = new sfPropelPager('Users', sfConfig::get('app_pagination_users', 5));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeAdmin() {
        
    }

    public function executeInsured($request) {
        $obj = new InsuredFunctions();
        $this->country = $obj->getInsuredCountryName();
        $this->states = $obj->getInsuredStateName();
        $this->city = $obj->getInsuredCityName();
        $this->status = $obj->getLookUpTypeList('InsuredStatus');
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        //Saving this last search criteria
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $insuredName = $request->getParameter('insuredname', '');
            $insuredDBNumber = $request->getParameter('insureddbnumber', '');
            $InsuredAddress = $request->getParameter('insuredaddress', '');
            $insuredCountry = $request->getParameter('insuredcountry', '');
            $insuredState = $request->getParameter('insuredstate', '');
            $insuredCity = $request->getParameter('insuredcity', '');
            $advisenId = $request->getParameter('advisenid', '');
            $insuredStatus = $request->getParameter('insuredstatus', '');
            $this->lastSearchCriteria = array(
                'insuredName' => $insuredName,
                'insuredDBNumber' => $insuredDBNumber,
                'insuredaddress' => $InsuredAddress,
                'insuredCountry' => $insuredCountry,
                'insuredState' => $insuredState,
                'insuredCity' => $insuredCity,
                'advisenID' => $advisenId,
                'insuredStatus' => $insuredStatus
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }
        $criteria = $obj->insuredList($this->lastSearchCriteria);
        $this->numberofResults = InsuredSearchPeer::doCount($criteria);
        $this->pager = new sfPropelPager('InsuredSearch', sfConfig::get('app_pagination_insured', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeAddInsured($request) {
        $obj = new InsuredFunctions();
        $this->country = $obj->getGUPCountryName();
        $this->states = $obj->getGUPStateName();
        $this->city = $obj->getGUPCityName();
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $check = $obj->validateInsured($postArray);
            $emptyValues = '';
            if (count($check) > 1) {
                $emptyValues = implode(", ", $check);
            }
            if (empty($emptyValues)) {
                $result = $obj->CreateInsured($postArray);
                if ($result['success'] == true) {
                    $this->getUser()->setFlash('success', 'Insured has been created successfully');
                    $this->redirect('/admin/insured');
                } else {
                    $this->errorArr = $result['msg'];
                }
            } else {
                $this->emptyValues = $emptyValues;
            }
        }
    }

    public function executeEditInsured($request) {
        $insuredObj = new InsuredFunctions();
        $this->country = $insuredObj->getGUPCountryName();
        $this->states = $insuredObj->getGUPStateName();
        $this->city = $insuredObj->getGUPCityName();
        $this->status = $insuredObj->getLookUpTypeList('InsuredStatus');
        if ($request->getParameter('insuredId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $insuredObj = new InsuredFunctions();
                $check = $insuredObj->validateEditInsured($postArray);
                $emptyValues = '';
                if (count($check) > 1) {
                    $emptyValues = implode(", ", $check);
                }
                if (empty($emptyValues)) {
                    $updateResponse = $insuredObj->CreateInsured($postArray, $insuredCount);
                    if ($updateResponse['success'] == true) {
                        $this->getUser()->setFlash('success', 'Insured has been updated successfully');
                        $this->redirect('/admin/insured');
                    } else {
                        $this->errorArr = $updateResponse['msg'];
                    }
                } else {
                    $this->emptyValues = $emptyValues;
                }
            }
            $this->induredInfo = InsuredFunctions::GetInsuredInfo($request->getParameter('insuredId'));
            $insuredData = $this->induredInfo;
            $this->Parent = InsuredFunctions::GetParentInsured($insuredData->InsuredParentId);
            if (!$this->induredInfo) {
                $this->redirect('/admin/insured');
            }
        } else {
            $this->redirect('/admin/insured');
        }
    }

    public function executeViewInsured($request) {
        if ($request->getParameter('insuredId') != '') {
            $this->induredInfo = InsuredFunctions::GetInsuredInfo($request->getParameter('insuredId'));
            $insuredData = $this->induredInfo;
            $this->Parent = InsuredFunctions::GetParentInsured($insuredData->InsuredParentId);
            if (!$this->induredInfo) {
                $this->redirect('/admin/insured');
            }
        } else {
            $this->redirect('/admin/insured');
        }
    }

    public function executeCloneInsured($request) {
        $insuredObj = new InsuredFunctions();
        $this->country = $insuredObj->getGUPCountryName();
        $this->states = $insuredObj->getGUPStateName();
        $this->city = $insuredObj->getGUPCityName();
        if ($request->getParameter('insuredId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $insuredObj = new InsuredFunctions();
                $updateResponse = $insuredObj->CreateCloneRecord($postArray);
                if ($updateResponse['success'] == true) {
                    $this->getUser()->setFlash('success', 'Child Insured has been created successfully');
                    $this->redirect('/admin/insured');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            $this->induredInfo = InsuredFunctions::GetInsuredInfo($request->getParameter('insuredId'));
            if (!$this->induredInfo) {
                $this->redirect('/admin/insured');
            }
        } else {
            $this->redirect('/admin/insured');
        }
    }

    public function executeGetState(sfWebRequest $request) {
        $arrStateData = json_decode(InsuredFunctions::getPostContent());
        $countryId = $arrStateData->body->data;
        $objSubmission = new InsuredFunctions();
        $data = $objSubmission->getStateName($countryId);
        echo json_encode($data);
        exit;
    }

    public function executeGetCity(sfWebRequest $request) {
        $arrCityData = json_decode(InsuredFunctions::getPostContent());
        $StateId = $arrCityData->body->data;
        $objSubmission = new InsuredFunctions ();
        $data = $objSubmission->getCityName($StateId);
        echo json_encode($data);
        exit;
    }

    public function executeBroker($request) {
        $obj = new InsuredFunctions();
        $bobj = new BrokerFunctions();
        $this->brokerType = $bobj->getLookUpTypeList('BrokerType');
        $this->country = $obj->getCountryName();
        $this->states = $obj->getStateName();
        $this->city = $obj->getCityName();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        //Saving this last search criteria
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $brokerName = $request->getParameter('brokername', '');
            $brokerType = $request->getParameter('brokertype', '');
            $brokerCode = $request->getParameter('brokercode', '');
            $brokerCountry = $request->getParameter('brokercountry', '');
            $brokerState = $request->getParameter('brokerstate', '');
            $brokerCity = $request->getParameter('brokercity', '');
            $this->lastSearchCriteria = array(
                'brokerName' => $brokerName,
                'brokerType' => $brokerType,
                'brokerCode' => $brokerCode,
                'brokerCountry' => $brokerCountry,
                'brokerState' => $brokerState,
                'brokerCity' => $brokerCity,
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }
        $criteria = $bobj->brokerList($this->lastSearchCriteria);
        $this->numberofResults = BrokerSearchPeer::doCount($criteria);
        $this->pager = new sfPropelPager('BrokerSearch', sfConfig::get('app_pagination_insured', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeAddBroker($request) {
        $obj = new InsuredFunctions();
        $bobj = new BrokerFunctions();
        $this->country = $obj->getCountryName();
        $this->brokerType = $bobj->getLookUpTypeList('BrokerType');
        $this->brokerSubType = $bobj->getLookUpTypeList('BrokerStatus');
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $result = $bobj->CreateBroker($postArray);
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', 'Broker added successfully');
                $this->redirect('/admin/broker');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
    }

    public function executeEditBroker($request) {
        $insuredObj = new InsuredFunctions();
        $bobj = new BrokerFunctions();
        $this->country = $insuredObj->getCountryName();
        $this->brokerType = $bobj->getLookUpTypeList('BrokerType');
        $this->brokerSubType = $bobj->getLookUpTypeList('BrokerStatus');
        if ($request->getParameter('brokerId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $postArray['brokerId'] = $request->getParameter('brokerId');
                $brokerObj = new BrokerFunctions();
                $updateResponse = $brokerObj->CreateBroker($postArray);
                if ($updateResponse['success']) {
                    $this->getUser()->setFlash('success', 'Broker has been updated successfully');
                    $this->redirect('/admin/broker');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            $this->brokerInfo = BrokerFunctions::GetBrokerInfo($request->getParameter('brokerId'));
            if (!$this->brokerInfo) {
                $this->redirect('/admin/broker');
            }
        } else {
            $this->redirect('/admin/broker');
        }
    }

    public function executeViewBroker($request) {
        $obj = new BrokerFunctions();
        if ($request->getParameter('brokerId') != '') {
            $data = BrokerFunctions::GetBrokerInfo($request->getParameter('brokerId'));
            $this->brokerInfo = $data;
            $this->country = $obj->getCountryName($data->Country);
            $this->state = $obj->getStateName($data->State);
            $this->city = $obj->getCityName($data->City);
            $this->brokerType = $obj->getLookUpdata($data->BrokerType);
            $this->brokerSubType = $obj->getLookUpdata($data->BrokerSubType);
            if (!$this->brokerInfo) {
                $this->redirect('/admin/broker');
            }
        } else {
            $this->redirect('/admin/broker');
        }
    }

    public function executeContactPerson($request) {
        $obj = new InsuredFunctions();
        $bobj = new ContactPerson();
        $this->partyType = $bobj->getLookUpTypeList('PartyType');
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        //Saving this last search criteria
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $partyType = $request->getParameter('partytype', '');
            $companyName = $request->getParameter('companyname', '');
            $contactPersonFirstName = $request->getParameter('contactpersonfirstname', '');
            $contactPersonLastName = $request->getParameter('contactpersonlastname', '');
            $this->lastSearchCriteria = array(
                'partyType' => $partyType,
                'companyName' => $companyName,
                'contactPersonFirstName' => $contactPersonFirstName,
                'contactPersonLastName' => $contactPersonLastName,
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }
        $criteria = $bobj->contactPersonList($this->lastSearchCriteria);
        $this->numberofResults = ContactpersonSearchPeer::doCount($criteria);
        $this->pager = new sfPropelPager('ContactpersonSearch', sfConfig::get('app_pagination_insured', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeAddContactPerson($request) {
        $obj = new BrokerFunctions();
        $bobj = new ContactPerson();
        $this->partyType = $obj->getLookUpTypeList('PartyType');
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $result = $bobj->CreateContactPerson($postArray);
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', 'Contact Person has been created successfully');
                $this->redirect('/admin/contactperson');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
    }

    public function executeEditContactPerson($request) {
        $obj = new BrokerFunctions();
        $this->partyType = $obj->getLookUpTypeList('PartyType');
        if ($request->getParameter('contactPersonId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $postArray['contactPersonId'] = $request->getParameter('contactPersonId');
                $contactPersonObj = new ContactPerson();
                $updateResponse = $contactPersonObj->CreateContactPerson($postArray);
                if ($updateResponse['success'] == true) {
                    $this->getUser()->setFlash('success', 'Contact Person has been updated successfully');
                    $this->redirect('/admin/contactperson');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            $this->contactPersonInfo = ContactPerson::GetContactPersonInfo($request->getParameter('contactPersonId'));
            $companyData = $this->contactPersonInfo;
            $this->company = ContactPerson::GetCompanyInfoData($companyData->PartyTypeId, $companyData->CompanyId);
            if (!$this->contactPersonInfo) {
                $this->redirect('/admin/contactperson');
            }
        } else {
            $this->redirect('/admin/contactperson');
        }
    }

    public function executeViewContactPerson($request) {
        $obj = new BrokerFunctions();
        if ($request->getParameter('contactPersonId') != '') {
            $data = ContactPerson::GetContactPersonInfo($request->getParameter('contactPersonId'));
            $this->contactPersonInfo = $data;
            $this->partyType = $obj->getLookUpdata($data->PartyTypeId);
            $this->company = ContactPerson::GetCompanyInfoData($data->PartyTypeId, $data->CompanyId);
            if (!$this->contactPersonInfo) {
                $this->redirect('/admin/contactperson');
            }
        } else {
            $this->redirect('/admin/contactperson');
        }
    }

    public function executeGetCompanyName(sfWebRequest $request) {
        $companyString = $request->getParameter('term');
        $data = $request->getParameter('data');
        $partyType = $data['myparam'];
        $objSubmission = new ContactPerson();
        $companyData = $objSubmission->GetCompanyInfo($companyString, $partyType);
        $json_response = array();
        if ($partyType == 97) {
            foreach ($companyData as $value) {
                $copData['value'] = $value['BrokerName'] . ' | ' . $value['Country'] . ' | ' . $value['State'] . ' | ' . $value['City'];
                array_push($json_response, $copData);
            }
        } else if ($partyType == 98) {
            foreach ($companyData as $value) {
                $copData['value'] = $value['InsuredName'] . ' | ' . $value['Country'] . ' | ' . $value['State'] . ' | ' . $value['City'] . ' | ' . $value['AddressLine1'];
                array_push($json_response, $copData);
            }
        }
        echo json_encode($json_response);
        exit;
    }

    public function executeGetBrokerName(sfWebRequest $request) {
        $brokerString = $request->getParameter('term');
        $companyData = BrokerFunctions::GetBrokerInformation($brokerString);
        $json_response = array();
        foreach ($companyData as $value) {
            $copData['value'] = $value['BrokerName'];
            array_push($json_response, $copData);
        }
        echo json_encode($json_response);
        exit;
    }

    public function executeGetBrokerInformation(sfWebRequest $request) {
        $jsonObj = json_decode(BrokerFunctions::getPostContent());
        $brokerName = $jsonObj->body->data;
        $brokerData = BrokerFunctions::GetBrokerDetails($brokerName);
        echo json_encode($brokerData);
        exit;
    }

    public function executeRenewalReference($request) {
        $bobj = new RenewalReference();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        //Saving this last search criteria
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $submissionNumber = $request->getParameter('submissionNumber', '');
            $accountName = $request->getParameter('accountName', '');
            $this->lastSearchCriteria = array(
                'submissionNumber' => $submissionNumber,
                'accountName' => $accountName,
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }
        $criteria = $bobj->renewalReferenceList($this->lastSearchCriteria);
        $this->numberofResults = RenewalSearchPeer::doCount($criteria);
        $this->pager = new sfPropelPager('RenewalSearch', sfConfig::get('app_pagination_insured', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeAddRenewalReference($request) {
        $obj = new BrokerFunctions();
        $bobj = new RenewalReference();
        $this->renewable = $obj->getLookUpTypeList('Renewable');
        $this->status = $bobj->getStatus();
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $result = $bobj->CreateRenewalReference($postArray);
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', 'Renewal Reference has been created successfully');
                $this->redirect('/admin/renewalreference');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
    }

    public function executeEditRenewalReference($request) {
        $obj = new BrokerFunctions();
        $referenceReferenceObj = new RenewalReference();
        $this->renewable = $obj->getLookUpTypeList('Renewable');
        $this->status = $referenceReferenceObj->getStatus();
        if ($request->getParameter('referalReferanceId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $postArray['referalReferanceId'] = $request->getParameter('referalReferanceId');
                $updateResponse = $referenceReferenceObj->CreateRenewalReference($postArray);
                if ($updateResponse['success'] == true) {
                    $this->getUser()->setFlash('success', 'Renewal Reference has been updated successfully');
                    $this->redirect('/admin/renewalreference');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            $this->renewalReferenceInfo = RenewalReference::GetRenewalReferenceInfo($request->getParameter('referalReferanceId'));
            $submissionNumber = $this->renewalReferenceInfo[0][SubmissionNumber];
            $this->accountName = RenewalReference::GetAccountDetails($submissionNumber);
            if (!$this->renewalReferenceInfo) {
                $this->redirect('/admin/renewalreference');
            }
        } else {
            $this->redirect('/admin/renewalreference');
        }
    }

    public function executeViewRenewalReference($request) {
        $obj = new BrokerFunctions();
        if ($request->getParameter('referalReferanceId') != '') {
            $data = RenewalReference::GetRenewalReferenceInfo($request->getParameter('referalReferanceId'));
            $this->renewalReferenceInfo = $data;
            $this->accountName = RenewalReference::GetInsuredInfo($data[0]['InsuredId']);
            $this->renewable = $obj->getLookUpdata($data[0]['Renewable']);
            if (!$this->renewalReferenceInfo) {
                $this->redirect('/admin/renewalreference');
            }
        } else {
            $this->redirect('/admin/renewalreference');
        }
    }

    public function executeGetAccount(sfWebRequest $request) {
        $jsonObj = json_decode(RenewalReference::getPostContent());
        $submissionNumber = $jsonObj->body->data;
        $brokerData = RenewalReference::GetAccountDetails($submissionNumber);
        $statusDate = RenewalReference::getCurrentStatus($submissionNumber);
        $finalArrya = array();
        $finalArrya['Accountdata'] = $brokerData;
        $finalArrya['Statusdata'] = $statusDate;
        echo json_encode($finalArrya);
        exit;
    }

    public function executeMasterDataManagement() {
        
    }

    public function executeUnderwriter($request) {
        $obj = new UnderwriterFunction();
        $this->branchOffice = $obj->getBranchOffice();
        $this->productLine = $obj->getLob();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        //Saving this last search criteria
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $underwriterName = $request->getParameter('listunderwritername', '');
            $branchOffice = $request->getParameter('listbranchoffice', '');
            $productLine = $request->getParameter('listproductline', '');
            $this->lastSearchCriteria = array(
                'underwriterName' => trim($underwriterName),
                'branchOffice' => $branchOffice,
                'productLine' => $productLine,
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }
        $criteria = $obj->UnderwriterList($this->lastSearchCriteria);
        $this->numberofResults = UnderwriterSearchPeer::doCount($criteria);
        $this->pager = new sfPropelPager('UnderwriterSearch', sfConfig::get('app_pagination_insured', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeAddUnderwriter($request) {
        $obj = new UnderwriterFunction();
        $this->branchOffice = $obj->getBranchOffice();
        $this->productLine = $obj->getLob();
        $this->productLineSubType = $obj->getLobSubTypeForExecutiveProf();
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $lobSubTypeData = $postArray['product_line_sub'];
            foreach ($lobSubTypeData as $val) {
                $data = $obj->getLobSubTypeByName($val);
                $id[] = $data[0]['Id'];
            }
            $lobsub_comma_separated = implode(",", $id);
            $postArray['productLineSubType'] = $lobsub_comma_separated;
            $result = $obj->CreateUnderwriter($postArray);
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', 'Underwriter has been created successfully');
                $this->redirect('/admin/underwriter');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
    }

    public function executeEditUnderwriter($request) {
        $obj = new UnderwriterFunction();
        $this->branchOffice = $obj->getBranchOffice();
        $this->productLine = $obj->getLob();
        $this->productLineSubType = $obj->getLobSubTypeForExecutiveProf();
        if ($request->getParameter('underwriterId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $postArray['underwriterId'] = $request->getParameter('underwriterId');
                $lobSubTypeData = $postArray['editlobsubtype'];
                foreach ($lobSubTypeData as $val) {
                    $data = $obj->getLobSubTypeByName($val);
                    $id[] = $data[0]['Id'];
                }
                $lobsub_comma_separated = implode(",", $id);
                $postArray['editlobsubtype'] = $lobsub_comma_separated;
                $updateResponse = $obj->CreateUnderwriter($postArray);
                if ($updateResponse['success']) {
                    $this->getUser()->setFlash('success', 'Underwriter has been updated successfully');
                    $this->redirect('/admin/underwriter');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            $this->underwriterInfo = $obj->UnderwriterInfo($request->getParameter('underwriterId'));
            $lobData = explode(',', $this->underwriterInfo[0]['LOBSubTypeId']);
            $this->underwriterInfo[0]['LOBSubTypeId'] = $lobData;
            foreach ($this->underwriterInfo[0]['LOBSubTypeId'] as $value){
                $data = $obj->lobSubTypeById($value);
                $name[] = $data[0]['ProductLineSubType'];
            }
            $lobsub_comma_separated = implode(" & ", $name);
            $this->displaylobsubtype = $lobsub_comma_separated;
            if (!$this->underwriterInfo) {
                $this->redirect('/admin/underwriter');
            }
        } else {
            $this->redirect('/admin/underwriter');
        }
    }

    public function executeViewUnderwriter($request) {
        $obj = new UnderwriterFunction();
        if ($request->getParameter('underwriterId') != '') {
            $data = $obj->UnderwriterInfo($request->getParameter('underwriterId'));
            $this->UnderwriterInfo = $data;
            $lobData = explode(',', $this->UnderwriterInfo[0]['LOBSubTypeId']);
            $this->UnderwriterInfo[0]['LOBSubTypeId'] = $lobData;
            foreach ($this->UnderwriterInfo[0]['LOBSubTypeId'] as $value){
                $data = $obj->lobSubTypeById($value);
                $name[] = $data[0]['ProductLineSubType'];
            }
            $lobsub_comma_separated = implode(" & ", $name);
            $this->displaylobsubtype = $lobsub_comma_separated;
            $this->branch = $obj->getBranchOffice($data[0]['BranchId']);
            $this->porductLine = $obj->getLob($data[0]['LOBId']);
            if (!$this->UnderwriterInfo) {
                $this->redirect('/admin/underwriter');
            }
        } else {
            $this->redirect('/admin/underwriter');
        }
    }

    public function executeCountry($request) {
        $obj = new CountryFunction();
        $this->country = $obj->CountryInfo();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        //Saving this last search criteria
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $countryName = $request->getParameter('listcountryname', '');
            $this->lastSearchCriteria = array(
                'countryName' => $countryName
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }
        $criteria = $obj->CountryList($this->lastSearchCriteria);
        $this->numberofResults = CountrySearchPeer::doCount($criteria);
        $this->pager = new sfPropelPager('CountrySearch', sfConfig::get('app_pagination_insured', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeAddCountry($request) {
        $obj = new CountryFunction();
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $result = $obj->CreateCountry($postArray);
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', 'Country has been created successfully');
                $this->redirect('/admin/country');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
    }

    public function executeEditCountry($request) {
        $obj = new CountryFunction();
        if ($request->getParameter('countryId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $postArray['countryId'] = $request->getParameter('countryId');
                $updateResponse = $obj->CreateCountry($postArray);
                if ($updateResponse['success']) {
                    $this->getUser()->setFlash('success', 'Country has been updated successfully');
                    $this->redirect('/admin/country');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            $this->countryInfo = $obj->CountryInfo($request->getParameter('countryId'));
            $countryData = explode('-', $this->countryInfo[0]['InsuredCountry']);
            $this->countryCode = trim($countryData[0]);
            $this->countryName = trim($countryData[1]);
            if (!$this->countryInfo) {
                $this->redirect('/admin/country');
            }
        } else {
            $this->redirect('/admin/country');
        }
    }

    public function executeViewCountry($request) {
        $obj = new CountryFunction();
        if ($request->getParameter('countryId') != '') {
            $data = $obj->CountryInfo($request->getParameter('countryId'));
            $this->CountryInfo = $data;
            $countryData = explode('-', $data[0]['InsuredCountry']);
            $this->countryName = $countryData[1];
            $this->countryCode = $countryData[0];
            if (!$this->CountryInfo) {
                $this->redirect('/admin/country');
            }
        } else {
            $this->redirect('/admin/country');
        }
    }

    public function executeState($request) {
        $obj = new StateFunction();
        $this->country = $obj->getCountry();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        //Saving this last search criteria
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $countryName = $request->getParameter('listcountryname', '');
            $stateName = $request->getParameter('liststatename', '');
            $this->lastSearchCriteria = array(
                'countryName' => $countryName,
                'stateName' => $stateName
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }
        $criteria = $obj->StateList($this->lastSearchCriteria);
        $this->numberofResults = StateSearchPeer::doCount($criteria);
        $this->pager = new sfPropelPager('StateSearch', sfConfig::get('app_pagination_insured', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeAddState($request) {
        $obj = new StateFunction();
        $this->country = $obj->getCountry();
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $result = $obj->CreateState($postArray);
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', 'State has been created successfully');
                $this->redirect('/admin/state');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
    }

    public function executeEditState($request) {
        $obj = new StateFunction();
        $this->country = $obj->getCountry();
        if ($request->getParameter('stateId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $postArray['stateId'] = $request->getParameter('stateId');
                $updateResponse = $obj->CreateState($postArray);
                if ($updateResponse['success']) {
                    $this->getUser()->setFlash('success', 'State has been updated successfully');
                    $this->redirect('/admin/state');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            $this->stateInfo = $obj->StateInfo($request->getParameter('stateId'));
            if (!$this->stateInfo) {
                $this->redirect('/admin/state');
            }
        } else {
            $this->redirect('/admin/state');
        }
    }

    public function executeViewState($request) {
        $obj = new StateFunction();
        if ($request->getParameter('stateId') != '') {
            $data = $obj->StateInfo($request->getParameter('stateId'));
            $this->countryData = $obj->getCountry($data[0]['CountryId']);
            $this->StateInfo = $data;
            if (!$this->StateInfo) {
                $this->redirect('/admin/state');
            }
        } else {
            $this->redirect('/admin/state');
        }
    }

    public function executeCity($request) {
        $obj = new CityFunction();
        $this->state = $obj->getState();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        //Saving this last search criteria
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $stateName = $request->getParameter('liststatename', '');
            $cityName = $request->getParameter('listcityname', '');
            $this->lastSearchCriteria = array(
                'stateName' => $stateName,
                'cityName' => $cityName
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }
        $criteria = $obj->CityList($this->lastSearchCriteria);
        $this->numberofResults = CitySearchPeer::doCount($criteria);
        $this->pager = new sfPropelPager('CitySearch', sfConfig::get('app_pagination_insured', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeAddCity($request) {
        $obj = new CityFunction();
        $this->state = $obj->getState();
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $result = $obj->CreateCity($postArray);
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', 'City has been created successfully');
                $this->redirect('/admin/city');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
    }

    public function executeEditCity($request) {
        $obj = new CityFunction();
        $this->state = $obj->getState();
        if ($request->getParameter('cityId') != '') {
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $postArray['cityId'] = $request->getParameter('cityId');
                $updateResponse = $obj->CreateCity($postArray);
                if ($updateResponse['success']) {
                    $this->getUser()->setFlash('success', 'City has been updated successfully');
                    $this->redirect('/admin/city');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            $this->cityInfo = $obj->CityInfo($request->getParameter('cityId'));
            if (!$this->cityInfo) {
                $this->redirect('/admin/city');
            }
        } else {
            $this->redirect('/admin/city');
        }
    }

    public function executeViewCity($request) {
        $obj = new CityFunction();
        if ($request->getParameter('cityId') != '') {
            $data = $obj->CityInfo($request->getParameter('cityId'));
            $this->CityInfo = $data;
            if (!$this->CityInfo) {
                $this->redirect('/admin/city');
            }
        } else {
            $this->redirect('/admin/city');
        }
    }

    public function executeInsuredList($request) {
        $jsonObj = json_decode(InsuredFunctions::getPostContent());
        $insuredParentId = $jsonObj->body->data;
        $data = InsuredFunctions::FetchInsuredList($insuredParentId);
        echo json_encode($data);
        exit;
    }

}
