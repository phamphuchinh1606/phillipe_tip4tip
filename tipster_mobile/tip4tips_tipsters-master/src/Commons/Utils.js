import { Redirect } from 'react-router-dom';
import i18n from "../I18n/index";

export const Network = require('react-network').default;

export const checkLogin = () => {
    let userInfoRoot = localStorage.getItem("userInfo");
    if (userInfoRoot === null) {
        return false;
    } else {
        let userInfo = JSON.parse(userInfoRoot);
        console.log(userInfo);
        if(userInfo.preferredLang){
            i18n.changeLanguage(userInfo.preferredLang);
        }else{
            localStorage.removeItem("userInfo");
            return false;
        }

        if (!userInfo.loginState) {
            return false;
        } else {
            return true;
        }
    }
    return true;
}

export const getLogin =() =>{
    let isLogin = checkLogin();
    if(isLogin){
        return JSON.parse(localStorage.getItem("userInfo"));
    }
    return null;
}