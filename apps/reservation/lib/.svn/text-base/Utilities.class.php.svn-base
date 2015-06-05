<?php

/**
 * Description of validate
 *
 * @author bhawna
 */
class Utilities {

    public static function getDateDifference($DateArr1, $DateArr2, $inQuantity = 'day', $includeCurrentDate = false) {


        $d1_year = $DateArr1['y'];
        $d1_month = $DateArr1['m'];
        $d1_day = $DateArr1['d'];

        $d2_year = $DateArr2['y'];
        $d2_month = $DateArr2['m'];
        $d2_day = $DateArr2['d'];



        if ($d2_year > $d1_year) {
            // If date2 is greater than date1 then the result is not valid
            return false;
        } elseif ($d2_year == $d1_year && $d2_month > $d1_month) {
            return false;
        } elseif ($d2_year == $d1_year && $d2_month == $d1_month && $d2_day > $d1_day) {
            return false;
        }


        if ($inQuantity == 'day') {

            if (self::isInSameMonth($d1_month, $d1_year, $d2_month, $d2_year)) {
                $result = $d1_day - $d2_day;
            } elseif (self::isInAdjacentMonths($d1_month, $d1_year, $d2_month, $d2_year)) {
                $max_days = self::monthMaxDays($d2_month, $d2_year);
                $result = ($max_days - $d2_day) + $d1_day;
            } else {
                $max_days = self::monthMaxDays($d2_month, $d2_year);
                $result = ($max_days - $d2_day) + $d1_day;
                // We need to calculate the days in months in between
                $nextMonth = self::getNextMonth($d2_month, $d2_year);
                do {
                    $result += self::monthMaxDays($nextMonth['m'], $nextMonth['y']);
                    $nextMonth = self::getNextMonth($nextMonth['m'], $nextMonth['y']);
                } while ($nextMonth['m'] != $d1_month || $nextMonth['y'] != $d1_year);
                // Break the loop if the last month reached
            }
            $result = $result + ($includeCurrentDate? 1 : 0);
        } elseif ($inQuantity == 'month') {
            $di = self::getDiff($DateArr1, $DateArr2);
            $result = $di['m'] + ($di['y'] * 12);
        } elseif ($inQuantity == 'year') {
            $di = self::getDiff($DateArr1, $DateArr2);
            $result = $di['y'];
        }

        return $result;
    }

    public static function getDiff($DateArr1, $DateArr2) {
        $d1_year = $DateArr1['y'];
        $d1_month = $DateArr1['m'];
        $d1_day = $DateArr1['d'];

        $d2_year = $DateArr2['y'];
        $d2_month = $DateArr2['m'];
        $d2_day = $DateArr2['d'];
        $dayDiff = $d1_day - $d2_day;
        if ($dayDiff < 0) {
            // so now we have to take carry days from previous months
            $carryDays = self::getCarryDays($d1_month, $d1_year);
            $d1_day = $d1_day + $carryDays;
            $d1_month = $d1_month - 1;
            if ($d1_month < 0) {
                $d1_year = $d1_year - 1;
                $d1_month = 11;
            }
            // Updated date diff
            $dayDiff = $d1_day - $d2_day;
        }

        $monthDiff = $d1_month - $d2_month;
        if ($monthDiff < 0) {
            // so now we have to take carry days from previous months
            $carryMonths = 12;
            $d1_month = $d1_month + $carryMonths;
            $d1_year = $d1_year - 1;

            // updated month diff
            $monthDiff = $d1_month - $d2_month;
        }

        $yearDiff = $d1_year - $d2_year;
        $Diff['y'] = $yearDiff;
        $Diff['m'] = $monthDiff;
        $Diff['d'] = $dayDiff;

        return $Diff;
    }

    public static function getAge($dobArr,$ageTillDate='') 
    {
        $statusAgeTillDate = '';
        if($ageTillDate){
            $statusAgeTillDate = Validate::forDate($ageTillDate);
        }
        
        $statusDOB = Validate::forDate($dobArr);
         
        $currDate['y'] = date('Y');
        $currDate['m'] = date('m');
        $currDate['d'] = date('d');
        $monthDiff = '';

        if($ageTillDate && $statusAgeTillDate == Validate::$INVALID) {
            return false;
        }

        
        if ($statusDOB == Validate::$VALID) 
        {
            if($ageTillDate){
                $yearDiff = self::getDateDifference($ageTillDate, $dobArr, 'year');
            }else{
                $yearDiff = self::getDateDifference($currDate, $dobArr, 'year');
            }
            
            
            if ($yearDiff === false){
                return false;
            }else if ($yearDiff < 1) {
                
                if($ageTillDate){
                    $monthDiff = self::getDateDifference($ageTillDate, $dobArr, 'month');
                }else{
                    $monthDiff = self::getDateDifference($currDate, $dobArr, 'month');
                }
                
            }
            
            $age['y'] = $yearDiff;
            $age['m'] = $monthDiff;
            
            return $age;
            
        } else {
            
            return false;
        }
    }

    public static function monthMaxdays($month, $year) {
        if ($year % 4 == 0) {
            $monthLookUp = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        } else {
            $monthLookUp = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        }
        if ($month > 0) {
            return $monthLookUp[$month - 1];
        }
    }

    private static function getCarryDays($presentMonth, $presentYear) {
        if ($presentMonth == 0) {
            return 31; // Return all days for month of dec
        } else {
            $temp = $presentMonth - 1;
            return self::monthMaxDays($temp, $presentYear);
        }
    }

    private static function isInSameMonth($month1, $year1, $month2, $year2) {
        if ($month1 == $month2 && $year1 == $year2) {
            return true;
        } else {
            return false;
        }
    }

    private static function isInAdjacentMonths($month1, $year1, $month2, $year2) {

        $nextMonth = $month2 + 1;
        if ($nextMonth > 12) {
            $nextMonth = 0;
            $nextYear = $year2 + 1;
        } else {
            $nextYear = $year2;
        }

        if ($nextMonth == $month1 && $year1 == $nextYear) {
            return true;
        } else {
            return false;
        }
    }

    private static function getNextMonth($presentMonth, $presentYear) {
        // if ($presentMonth == 11) {   // Its not javascript in which the month starts from 0
                                        // , so the last month will be 12 not 11
        if ($presentMonth == 12) {
            $nextMonth = 0;
            $nextYear = $presentYear + 1;
        } else {
            $nextMonth = $presentMonth + 1;
            $nextYear = $presentYear;
        }

        $arr['y'] = $nextYear;
        $arr['m'] = $nextMonth;
        return $arr;
    }

    public static function multiArraySearch($needle, $haystack) {

        $in_multi_array = false;
        if ($key = array_search($needle, $haystack)) {
            $in_multi_array = $key;
        } else {
            foreach ($haystack as $key => $val) {
                $first_key = $key;
                if (is_array($val)) {
                    if ($key = self::multiArraySearch($needle, $val)) {
                        $in_multi_array[] = $first_key;
                        $in_multi_array[] = $key;
                        break;
                    }
                }
            }
        }
        return $in_multi_array;
    }

    public static function createDateObject($date) {
        $date_arr = explode('-', $date);
        $date = array('y' => $date_arr[0], 'm' => $date_arr[1], 'd' => $date_arr[2]);
        return $date;
    }

    public static function getfrontEndConstantValues($key) {
        $frontendvalue = TravelConstants::$FrontEndToBackendVarNameConvertArray[$key];
        return $frontendvalue;
    }

    public static function encodeId($id) {
        if($id)
        { 
        $identifier = time();
        $salt = sfConfig::get('app_encodingkey');
        $salt = $identifier . $salt;
        $encodedid = trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $id, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
        return array(
            'id' => $encodedid,
            'identifier' => $identifier
        );
        }
    }

    public static function decodeId($id, $identifier) {
        if($id && $identifier)
        {
        $salt = sfConfig::get('app_encodingkey');;
        $salt = $identifier . $salt;
        //$id= $id;
        $id = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($id), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
       
        return $id;
        }
    }

    public static function deleteCookie($cookieName, $path) {
        setCookie($cookieName, '', time() - 3600, $path);
    }
    
  /**
   * @author Rohit Chouhdary <rohit.chouhdary@berkshireindia.com>
   * @param type $needle
   * @param type $haystack
   * @param string $keyName 
   * @return bool 
   */  
  public static function inRightArray($needle,$haystack, $keyName){
        
      $return=false;
      foreach($haystack as $key=>$value){
          if($value[$keyName]==$needle){
               $return=true;
              //echo $value[$keyName];
              //exit;
          }
      }
      return $return;
    }
    
    
    
}

?>
