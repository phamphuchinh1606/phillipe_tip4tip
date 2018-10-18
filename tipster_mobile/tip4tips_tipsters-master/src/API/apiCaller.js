import axios from 'axios';
import * as URL from './URL';

export default function callApi(endpoint,method='GET',body){
	return axios({
		method:method,
		url:`${URL.URL_PAGE}${endpoint}`,
		data:body,
		headers: {
			"Accept": 'application/json',
			"Content-Type": "application/x-www-form-urlencoded"
		   
        }
	}).catch(err =>{
		console.log(err);
	});
}

