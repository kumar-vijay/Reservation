<?php

/**
 * submission actions.
 *
 * @package    reservation
 * @subpackage submission
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class policyActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executePolicy($request) {
        
    }
    
    public function executeExportPolicyDetails() {
        $niddle = $this->getUser()->getAttribute('searchNiddle');
        $objSubmission = new PolicyManagement();
        $objSubmission->exportPolicyDetailsCSV($niddle);
        exit;
    }

    public function executePolicyList(sfWebRequest $request) {
        $obj = new CreatePolicyNumber();
        $this->underwriter = $obj->getUnderwriter();
        if ($request->getParameter('niddle')) {
            $this->lastSearchCriteria = $this->getUser()->getAttribute('searchNiddle');
        } else {
            $this->getUser()->setAttribute('searchNiddle', '');
        }
        //Saving this last search criteria
        if ($request->isMethod('POST')) {
            $this->getUser()->setAttribute('searchNiddle', '');
            $insuredName = $request->getParameter('insuredname', '');
            $masterpolicynumber = $request->getParameter('masterpolicynumber', '');
            $policynumber = $request->getParameter('policynumber', '');
            $underwriter = $request->getParameter('underwriter', '');
            $this->lastSearchCriteria = array(
                'insuredName' => $insuredName,
                'masterpolicynumber' => $masterpolicynumber,
                'policynumber' => $policynumber,
                'underwriter' => $underwriter
            );
            $this->getUser()->setAttribute('searchNiddle', $this->lastSearchCriteria);
        }
        $criteria = $obj->PolicyNumberList($this->lastSearchCriteria);
        $this->numberofResults = PolicySearchPeer::doCount($criteria);
        $this->pager = new sfPropelPager('PolicySearch', sfConfig::get('app_pagination_insured', 1));
        $this->pager->setCriteria($criteria);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeCreatePolicyNumber($request) {
        $obj = new CreatePolicyNumber();
        $this->region = $obj->getRegion();
        $this->directAssumed = $obj->getLookUpTypeList('DirectAssumed');
        $this->admitted = $obj->getLookUpTypeList('AdmittedNonAdmitted');
        $this->company = $obj->getLookUpTypeList('Company');
        $this->companyNumber = $obj->getLookUpTypeList('CompanyNumber');
        $this->newRenewal = $obj->getLookUpTypeList('NewRenewal');
        $this->premiumCurrency = $obj->getLookUpTypeList('PremiumCurrency');
        if ($request->isMethod('POST')) {
            $postArray = $request->getPostParameters();
            $postArray['userId'] = $this->getUser()->getAttribute('id');
            $result = $obj->CreatePolicyNumberDetails($postArray);
            $message = 'Policy Number '.$result['data'][0]['MasterPolicyNumber'].' has been reserved for '.$result['data'][0]['InsuredName'].'.';
            if ($result['success'] == true) {
                $this->getUser()->setFlash('success', $message);
                $this->redirect('/policy/PolicyList');
            } else {
                $this->errorArr = $result['msg'];
            }
        }
    }

    public function executeEditPolicyNumber($request) {
        $obj = new CreatePolicyNumber();
        $this->productLine = $obj->getProductLine();
        $this->productLineSubType = $obj->getProductLineSubType();
        $this->underwriter = $obj->getUnderwriter();
        $this->region = $obj->getRegion();
        $this->directAssumed = $obj->getLookUpTypeList('DirectAssumed');
        $this->admitted = $obj->getLookUpTypeList('AdmittedNonAdmitted');
        $this->company = $obj->getLookUpTypeList('Company');
        $this->companyNumber = $obj->getLookUpTypeList('CompanyNumber');
        $this->newRenewal = $obj->getLookUpTypeList('NewRenewal');
        $this->prefix = $obj->getPrefix();
        $this->premiumCurrency = $obj->getLookUpTypeList('PremiumCurrency');
        if ($request->getParameter('policyId') != '') {
            $this->policyId = $request->getParameter('policyId');
            $this->policyInfo = EditPolicyNumber::PolicyNumberInfo($request->getParameter('policyId'));
            if ($request->isMethod('POST')) {
                $postArray = $request->getPostParameters();
                $postArray['userId'] = $this->getUser()->getAttribute('id');
                $policyObj = new EditPolicyNumber();
                EditPolicyNumber::SavePolicyHistory($postArray, $this->policyInfo[0], $this->policyId);
                $updateResponse = $policyObj->UpdatePolicyNumberDetails($postArray, $this->policyId);
                if ($updateResponse['success'] == true) {
                    $this->getUser()->setFlash('success', 'Policy Details has been updated successfully');
                    $this->redirect('/policy/PolicyList');
                } else {
                    $this->errorArr = $updateResponse['msg'];
                }
            }
            if (!$this->policyInfo) {
                $this->redirect('/policy/PolicyList');
            }
        } else {
            $this->redirect('/policy/PolicyList');
        }
    }

    public function executeViewPolicyNumber($request) {
        if ($request->getParameter('policyId') != '') {
            $this->policyId = $request->getParameter('policyId');
            $obj = new EditPolicyNumber();
            $this->recorderData = $obj->GetDatarecorderMetaData($this->policyId);
            $data = ViewPolicyNumber::GetPolicyInfo($request->getParameter('policyId'));
            $this->result = $data;
            if (!$this->result) {
                $this->redirect('/policy/PolicyList');
            }
        } else {
            $this->redirect('/policy/PolicyList');
        }
    }

    public function executeViewPolicyHistory($request) {
        $this->policyId = $request->getParameter('policyId');
        $obj = new EditPolicyNumber();
        $this->recorderData = $obj->GetDatarecorderMetaData($this->policyId);
        $this->historyData = $obj->getPolicyHistory($this->policyId);
    }

    public function executePolicyHistory($request) {
        $this->policyId = $request->getParameter('policyId');
        $obj = new EditPolicyNumber();
        $this->recorderData = $obj->GetDatarecorderMetaData($this->policyId);
        $this->historyData = $obj->getPolicyHistory($this->policyId);
    }

    public function executeGetBranchOffice(sfWebRequest $request) {
        $jsonObj = json_decode(CreatePolicyNumber::getPostContent());
        $regionId = $jsonObj->body->data;
        $objSubmission = new CreatePolicyNumber();
        $branchOffice = $objSubmission->getBranchOffice($regionId);
        $productLine = $objSubmission->getProductLineByRegion($regionId);
        $underwriter = $objSubmission->getUnderwriterByRegion($regionId);
        $data = array('BranchOffice' => $branchOffice, 'ProductLine' => $productLine, 'Underwriter' =>$underwriter);
        echo json_encode($data);
        exit;
    }

    public function executeGetAdmittedDetails(sfWebRequest $request) {
        $jsonObj = json_decode(CreatePolicyNumber::getPostContent());
        $admittedLookupId = $jsonObj->body->data;
        $objSubmission = new CreatePolicyNumber();
        $data = $objSubmission->getAdmittedDetails($admittedLookupId);
        echo json_encode($data);
        exit;
    }
    public function executeGetCompanyNumber(sfWebRequest $request) {
        $jsonObj = json_decode(CreatePolicyNumber::getPostContent());
        $companyId = $jsonObj->body->data;
        $objSubmission = new CreatePolicyNumber();
        $data = $objSubmission->getCompanyNumber($companyId);
        echo json_encode($data);
        exit;
    }
    
    public function executeGetPrefix(sfWebRequest $request) {
        $jsonObj = json_decode(CreatePolicyNumber::getPostContent());
        $productLine = $jsonObj->body->data;
        $region = $jsonObj->body->region;
        $objSubmission = new CreatePolicyNumber();
        $data = $objSubmission->getPrefixByRegionAndProductLine($productLine,$region);
        echo json_encode($data);
        exit;
    }
    
    public function executeGetProductLineSubType(sfWebRequest $request) {
        $jsonObj = json_decode(CreatePolicyNumber::getPostContent());
        $productLine = $jsonObj->body->data;
        $objSubmission = new CreatePolicyNumber();
        $data = $objSubmission->getProductLineSubType($productLine);
        echo json_encode($data);
        exit;
    }
    

}
