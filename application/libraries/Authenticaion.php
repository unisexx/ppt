<?php 
class Authentication {
    function __construct() {
        //सत्र प्रारंभ करें
        session_start();
    }
    
    private $_loginpage;
    function setLoginPage($loginpage) {
        //सत्रारंभ हेतु पृष्ठ का निर्धारण करें
        $this->_loginpage = $loginpage;
    }
    function getLoginPage() {
        //सत्रारंभ हेतु पृष्ठ का नाम प्राप्त करें
        return $this->_loginpage;
    }
    
    private $_useracls;
    function setUserACLs($a) {
        //एसीएल अर्थात एक्सेस कंट्रोल लिस्ट इसे आप पद के समान भी मान सकते हैं
        //array("admin","author","editor","worker","manager");
        $this->_useracls = $a;
    }
    function requireACL($req_roles) {
        //यह निश्चित करें कि उपयोगकर्ता के लिए कोई विशेष पद होना आवश्यक है, अन्यथा उसे सत्रारंभ वाले पृष्ठ पर पहुंचा दें
        if (!$this->_requireACL($req_roles)) {
            $this->destroyUserInfo();
            redirect($this->_loginpage);
        }
    }
    private function _requireACL($req_roles) {
        foreach ($req_roles as $req_role) {
            if ($this->checkACL($req_role)) {
                return true;
            }
        }
        return false;
    }
    function checkACL($role) {
        //उपयोगकर्ता के पास कोई विशेष पद है अथवा नही यह जांचें
        $roles = $this->getUserACLs();
        if ($roles != false) {
            foreach ($roles as $r) {
                if ($r == $role) {
                    return true;
                }
            }
        }
        return false;
    }
    function getUserACLs() {
        //उपयोगकर्ता के पद प्राप्त करें।
        if (isset($_SESSION["roles"])) {
            return $_SESSION["roles"];
        } else {
            return false;
        }
    }
    function setUserToken($token) {
        //उपयोगकर्ता के लिए एक टोकन निर्धारित करें। यह उसका यूजर आईडी, ईमेल या कुछ भी हो सकता है
        if (is_array($this->_useracls)) {
            $_SESSION["token"] = $token;
            $_SESSION["roles"] = $this->_useracls;
        } else {
            $_SESSION["token"] = $token;
        }
    }
    function getUserToken() {
        //उपयोगकर्ता का टोकन प्राप्त करें
        if (isset($_SESSION["token"])) {
            return $_SESSION["token"];
        } else {
            return false;
        }
    }
    function getSessionId() {
        //सत्र की पहचान संख्या (आईडी) प्राप्त करें
        return session_id();
    }
    function requireLoggedIn() {
        //सत्रारंभ की आवश्यकता को निर्धारित करें
        if ($this->checkLoggedIn() == false) {
            redirect($this->_loginpage);
        }
    }
    function checkLoggedIn() {
        //जांचे कि क्या उपयोगकर्ता ने सत्र आरंभ किया है अथवा नही?
        if ($this->getUserToken() == false) {
            return false;
        } else {
            return true;
        }
    }
    function destroyUserInfo() {
    
        session_destroy();
    }
}
﻿ 
