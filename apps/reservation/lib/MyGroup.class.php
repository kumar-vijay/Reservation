<?php

/**
 * @author Rohit  Choudhary <rohit.choudhary@berkshireindia.com>
 * @Description This class is used to operate with Group information
 * 
 * 
 */
class MyGroup extends BaseGroups {

    //Constructor function
    public function __construct() {
        parent::__construct();
    }

    public static function getGroupInfo($groupId) {

        $criteria = new Criteria();
        $criteria->add(GroupsPeer::GROUP_ID, $groupId, Criteria::EQUAL);
        if (GroupsPeer::doCount($criteria) > 0) {
            $groupInfo = GroupsPeer::doSelectStmt($criteria)->fetch(PDO::FETCH_ASSOC);
            $RightArray = self::getRightsAllocatedToGroup($groupId);
            $result['groupInfo'] = $groupInfo;
            $result['RightArray'] = $RightArray;
            return $result;
        } else {
            return false;
        }
    }

    public static function getSearchCriteria(array $input) {

        $criteria = new Criteria();
        $isFilterChoosen = false;

        if ($input['groupName'] != '') {
            $filterCriteria = $criteria->add(GroupsPeer::GROUP_NAME, trim($input['groupName']) . '%', Criteria::LIKE);
            $isFilterChoosen = true;
        }

        if ($input['groupStatus'] != '') {
            if ($input['groupStatus'] != 1) {
                $filterCriteria = $criteria->add(GroupsPeer::STATUS, trim($input['groupStatus']), Criteria::EQUAL);
                $isFilterChoosen = true;
            }
        } else {
            if ($input['groupStatus'] != 1) {
                $criteria->add(GroupsPeer::STATUS, array('active', 'inactive'), Criteria::IN);
            }
        }
        $isDateFilterChoosen = false;
        if ($input['fromDate'] != '' && $input['toDate'] != '') {
            $isDateFilterChoosen = true;
            $dateCriteria = $criteria->getNewCriterion(GroupsPeer::CREATED_ON, date("Y-m-d H:i:s", strtotime($input['fromDate'])), Criteria::GREATER_EQUAL);
            $endDateCriteria = $criteria->getNewCriterion(GroupsPeer::CREATED_ON, date("Y-m-d H:i:s", strtotime($input['toDate'] . ' + 1 day')), Criteria::LESS_THAN);
            $dateCriteria->addAnd($endDateCriteria);
        } else if ($input['fromDate'] != '') {
            $isDateFilterChoosen = true;
            $dateCriteria = $criteria->add(GroupsPeer::CREATED_ON, date("Y-m-d H:i:s", strtotime($input['fromDate'])), Criteria::GREATER_EQUAL);
        } else if ($input['toDate'] != '') {
            $isDateFilterChoosen = true;
            $dateCriteria = $criteria->add(GroupsPeer::CREATED_ON, date("Y-m-d H:i:s", strtotime($input['toDate'] . ' + 1 day')), Criteria::LESS_THAN);
        }

        if ($isFilterChoosen) {
            $criteria->add($filterCriteria);
        }

        if ($isDateFilterChoosen) {
            $criteria->add($dateCriteria);
        }

        $criteria->addAscendingOrderByColumn(GroupsPeer::GROUP_NAME);
        // echo $criteria->toString();
        //        die;
        return $criteria;
    }

    public function saveGroup(array $data) {

        $errFlag = false;
        $error = array();

        if (empty($data)) {
            $errFlag = true;
            $response['msg'][] = 'You did not fill the form correctly';
            $response['success'] = false;
        } else {
            $errFlag = false;
            if (!ValidateForm::forGroupName($data['groupName'])) {
                $errFlag = true;
                $response['msg'][] = 'Please enter a valid group name';
                $response['success'] = false;
            }

            if ($data['groupId'] == '' && !isset($data['groupId'])) {
                if (self::isGroupNameExists(strtolower(trim($data['groupName'])))) {
                    $errFlag = true;
                    $response['msg'][] = 'Group name already registered';
                    $response['success'] = false;
                }
            }

            if ($data['groupStatus'] == '0') {
                $errFlag = true;
                $response['msg'][] = 'Please enter a valid group status';
                $response['success'] = false;
            }
            if (empty($data['groupRights'])) {
                $errFlag = true;
                $response['msg'][] = 'Group right is not valid';
                $response['success'] = false;
            }
            if ($errFlag == false) {

                if ($data['groupId'] != NULL) {
                    $modifiedBy = sfContext::getInstance()->getUser()->getAttribute('id');
                    $con = Propel::getConnection();
                    $Recorderquery = "UPDATE groups SET STATUS = '".$data['groupStatus']."', MODIFIED_ON = GetDate(), MODIFIED_BY_ID = '" . $modifiedBy . "' WHERE GROUP_ID = '" . $data['groupId'] . "'";
                    $updateRecorderData = $con->prepare($Recorderquery);
                    try {
                        if ($updateRecorderData->execute()) {
                            $groupRight = array();
                            $this->_setGroupRights($data['groupRights'], $data['groupId']);
                        } else {
                            throw new PropelException();
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at updating group:" . $e->getMessage();
                        $response['success'] = false;
                    }
                } else {
                    $groupName = strtolower(trim($data['groupName']));
                    $groupStatus = $data['groupStatus'];
                    //$createdOn = date('Y-m-d H:i:s');
                    $createdBy = sfContext::getInstance()->getUser()->getAttribute('id');

                    $con = Propel::getConnection();
                    $query = "INSERT INTO GROUPS 
                             (GROUP_NAME,STATUS, CREATED_ON, CREATED_BY_ID, MODIFIED_BY_ID) 
                             VALUES 
                             ('" . $groupName . "','" . $groupStatus . "', GetDate(), '" . $createdBy . "', '0')";
                    $insert = $con->prepare($query);
                    //Setting this to default as 1
                    try {
                        if ($insert->execute()) {
                            $STH = $con->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
                            $STH->execute();
                            $result = $STH->fetch();
                            $groupId = $result[0];
                            $this->_setGroupRights($data['groupRights'], $groupId);
                        } else {
                            throw new PropelException();
                        }
                    } catch (Exception $e) {
                        $errFlag = true;
                        $response['msg'][] = "Exception error at creating group:" . $e->getMessage() . 'At line number ' . __LINE__;
                        $response['success'] = false;
                    }
                }
            }
        }

        if ($errFlag == false) {
            $response['msg'] = 'Saved Successfully';
            $response['success'] = true;
            return $response;
        } else {
            return $response;
        }
    }

    /**
     * @author: Rohit Choudhary
     * @description : This class method will be used to check whether a group name already registered in our system or not
     * @created on: 20:02:2013
     * @param: $groupName
     * @return: boolean
     */
    public static function isGroupNameExists($groupName) {
        $con = Propel::getConnection();
        $criteria = new Criteria();
        $criteria->add(GroupsPeer::GROUP_NAME, strtolower($groupName), Criteria::EQUAL);
        if (GroupPeer::doCount($criteria) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function _setGroupRights(array $rightArray, $groupId) {

        if (!empty($rightArray)) {
            $con = Propel::getConnection();
            $sql = "DELETE FROM  group_rights_mapper WHERE GROUP_ID = " . $groupId;
            // Delete previous group right Ids
            $con->query($sql);
            // Insert new group right Ids
            $sql = "INSERT INTO  group_rights_mapper (GROUP_ID, GROUP_RIGHTS_ID) VALUES";
            $count = count($rightArray);
            $i = 1;
            foreach ($rightArray as $val) {
                $sql.="($groupId, $val)";
                if ($count != $i) {
                    $sql.=",";
                }
                $i++;
            }
            $con->query($sql);
        }
    }

    public static function getRightsAllocatedToGroup($groupId) {
        $criteria = new Criteria();
        $criteria->clearSelectColumns();
        $criteria->addSelectColumn(GroupRightsPeer::GROUP_RIGHTS_NAME);
        $criteria->addSelectColumn(GroupRightsPeer::GROUP_RIGHTS_ID);
        $criteria->addJoin(GroupRightsMapperPeer::GROUP_RIGHTS_ID, GroupRightsPeer::GROUP_RIGHTS_ID, Criteria::INNER_JOIN);
        $criteria->add(GroupRightsMapperPeer::GROUP_ID, $groupId, Criteria::EQUAL);
        return $result = GroupRightsMapperPeer::doSelectStmt($criteria)->fetchAll(PDO::FETCH_ASSOC);
    }

}
