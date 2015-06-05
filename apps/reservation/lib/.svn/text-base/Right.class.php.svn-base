<?php


class Right{
    
    public static function getAllRightsFromTable(){
        $con=Propel::getConnection();
        $criteria=new Criteria();
        return $result=  GroupRightsPeer::doSelectStmt($criteria)->fetchAll(PDO::FETCH_ASSOC);        
        
    }
    
    public static function createHtmlView($name=NULL, $remove=NULL){
        
        $result=NULL;
        if($name!=NULL){
            $result=  str_replace('_', ' ', $name); 
            
        }
        if($name!=NULL){
            $result=  str_replace($remove, '', $result); 
            
        }
        
        return $result; 
        
    }
    
}
?>