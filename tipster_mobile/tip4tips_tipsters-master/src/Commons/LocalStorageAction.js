import * as LocalStorageType from './LocalStorageType';

//Leads
export const setLeadsList = (leads) => {
    localStorage.setItem(LocalStorageType.LOCAL_LEADS_LIST, JSON.stringify(leads));
}

export const getLeadsList = () => {
    return JSON.parse(localStorage.getItem(LocalStorageType.LOCAL_LEADS_LIST));
}

export const getLeadNotSync = () =>{
    let leads = getLeadsList();
    let leadsNotSync = [];
    if (leads) {
        for (let index in leads) {
            let lead = leads[index];
            if(lead.new_offline){
                leadsNotSync.push(lead);
            }
        }
    }
    return leadsNotSync;
}

export const setLeadSync = (lead) =>{
    let leads = getLeadsList();
    if (leads) {
        for (let index in leads) {
            if (leads[index].id == lead.id) {
                leads[index].new_offline = null;
                leads[index].new_offline_text = null;
                break;
            }
        }
        setLeadsList(leads);
    }
}

export const getLeadDetail = (leadId) => {
    let leads = getLeadsList();
    if (leads) {
        for (let index in leads) {
            let lead = leads[index];
            if (lead.id == leadId) {
                return lead;
            }
        }
    }
    return {};
}

export const setLeadDetail = (lead) =>{
    let leads = getLeadsList();
    if (leads) {
        for (let index in leads) {
            if (leads[index].id == lead.id) {
                leads[index] = lead;
                break;
            }
        }
        setLeadsList(leads);
    }
}

const getMaxLeadId = () =>{
    let leads = getLeadsList();
    if (leads) {
        return leads[0].id;
    }
    return 1;
}

//Create lead

export const createLeads = (lead) => {
    if(lead.product_id != ""){
        let arrayProduct = lead.product_id.split(',');
        for(let i = 0 ; i < arrayProduct.length ; i++){
            let leadItem = {...lead};
            leadItem.product_id = arrayProduct[i];
            createLead(leadItem);
        }
    }
}

export const createLead = (lead) =>{
    let regions = getRegionsList();
    let products = getProductsList();
    let tipsters = getTipstersList();
    let leads = getLeadsList();
    var today = new Date(),
    date =  today.getDate() + "/" + (today.getMonth() + 1) + "/" + today.getFullYear();
    lead.date = date;
    //set region
    lead.region_id = lead.region_id;
    let regionDetail = getRegionDetail(lead.region_id);
    if(regionDetail){
        lead.region = regionDetail.name;
    }
    //set product
    lead.product_id = lead.product_id;
    let productDetail = getProductDetail(lead.product_id);
    if(productDetail){
        lead.product = productDetail.name;
    }
    //set tipster
    lead.tipster_id = lead.tipster_id;
    let tipsterDetail = getTipsterDetail(lead.tipster_id);
    if(tipsterDetail){
        lead.tipster = tipsterDetail.fullname;
    }
    //set status
    lead.status = 0;
    lead.status_color = "#00c0ef";
    lead.status_text = "New";
    //set id
    lead.id = getMaxLeadId() + 1;
    lead.new_offline = true;
    lead.new_offline_text = "(synchronize)";
    leads = [lead,...leads];
    setLeadsList(leads);
}

export const updateLead = (lead) =>{
    let regions = getRegionsList();
    let products = getProductsList();
    let tipsters = getTipstersList();
    let leads = getLeadsList();
    var today = new Date(),
    date =  today.getDate() + "/" + (today.getMonth() + 1) + "/" + today.getFullYear();
    lead.updated_at = date;
    //set region
    lead.region_id = lead.region_id;
    let regionDetail = getRegionDetail(lead.region_id);
    if(regionDetail){
        lead.region = regionDetail.name;
    }
    //set product
    lead.product_id = lead.product_id;
    let productDetail = getProductDetail(lead.product_id);
    if(productDetail){
        lead.product = productDetail.category;
    }
    //set tipster
    lead.tipster_id = lead.tipster_id;
    let tipsterDetail = getTipsterDetail(lead.tipster_id);
    if(tipsterDetail){
        lead.tipster = tipsterDetail.fullname;
    }

    if(lead.new_offline){
        if(lead.new_offline !== true){
            lead.update_offline = true;
        }
    }else{
        lead.update_offline = true;
    }
    setLeadDetail(lead);
    return true;
}

export const deleteLead = (leadId) =>{
    let leads = getLeadsList();
    if (leads) {
        for (let index in leads) {
            if (leads[index].id == leadId) {
                leads.splice(index, 1);
                break;
            }
        }
        console.log(leads);
        setLeadsList(leads);
    }
    return true;
}

//Regions
export const setRegionsList = (regions) =>{
    localStorage.setItem(LocalStorageType.LOCAL_REGIONS_LIST, JSON.stringify(regions));
}

export const getRegionsList = () => {
    let regions = localStorage.getItem(LocalStorageType.LOCAL_REGIONS_LIST);
    if(regions){
        regions = JSON.parse(regions);
    }
    return regions;
}

export const getRegionDetail = (regionId) =>{
    let regions = getRegionsList();
    if (regions) {
        for (let index in regions) {
            let region = regions[index];
            if (region.id == regionId) {
                return region;
            }
        }
    }
    return {};
}

//Products
export const setProductsList = (products) =>{
    localStorage.setItem(LocalStorageType.LOCAL_PRODUCTS_LIST, JSON.stringify(products));
}

export const getProductsList = () => {
    let products = localStorage.getItem(LocalStorageType.LOCAL_PRODUCTS_LIST);
    if(products){
        products = JSON.parse(products);
    }
    return products;
}

export const getProductDetail = (productId) =>{
    let products = getProductsList();
    if (products) {
        for (let index in products) {
            let product = products[index];
            if (product.id == productId) {
                return product;
            }
        }
    }
    return {};
}

//Tipsters
export const setTipstersList = (tipsters) =>{
    localStorage.setItem(LocalStorageType.LOCAL_TIPSTER_LIST, JSON.stringify(tipsters));
}

export const getTipstersList = () => {
    let tipsters = localStorage.getItem(LocalStorageType.LOCAL_TIPSTER_LIST);
    if(tipsters){
        tipsters = JSON.parse(tipsters);
    }
    return tipsters;
}

export const getTipsterDetail = (tipsterId) =>{
    let tipsters = getTipstersList();
    if (tipsters) {
        for (let index in tipsters) {
            let tipster = tipsters[index];
            if (tipster.id == tipsterId) {
                return tipster;
            }
        }
    }
    return {};
}

//Messages
export const setMessagesList = (messages) =>{
    localStorage.setItem(LocalStorageType.LOCAL_MESSAGE_LIST, JSON.stringify(messages));
}

export const getMessagesList = () => {
    let messages = localStorage.getItem(LocalStorageType.LOCAL_MESSAGE_LIST);
    if(messages){
        messages = JSON.parse(messages);
    }
    return messages;
}

export const getMessageDetail = (messageId) =>{
    let messages = getMessagesList();
    if (messages) {
        for (let index in messages) {
            let message = messages[index];
            if (message.id == messageId) {
                return message;
            }
        }
    }
    return {};
}
//Home
export const setHome = (home) =>{
    localStorage.setItem(LocalStorageType.LOCAL_HOME, JSON.stringify(home));
}

export const getHome = () => {
    let home = localStorage.getItem(LocalStorageType.LOCAL_HOME);
    if(home){
        home = JSON.parse(home);
    }
    return home;
}

//User
export const setUserInfo = (userInfo) =>{
    if(userInfo){
        localStorage.setItem(LocalStorageType.LOCAL_USER_INFO, JSON.stringify(userInfo));
    }
}

export const getUserInfo = () =>{
    let userInfo = localStorage.getItem(LocalStorageType.LOCAL_USER_INFO);
    if(userInfo){
        userInfo = JSON.parse(userInfo);
    }
    return userInfo;
}