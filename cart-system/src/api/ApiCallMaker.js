import { API_URL, API_TOKEN } from "../../config/constants";
import Axios from "axios";

export const ApiCallMaker = async (method, url, data = [], token = "",params="") => {
   
    //const API_URL = "http://localhost/testcart/back/public/api";
    token = API_TOKEN;
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer '+token
    }
    try {
        const response = await Axios({
            method: method,
            url: API_URL+url,
            // baseURL: API_URL,
            data: data,
            headers: headers,
            params: params,
    
        });
        return response;
    } catch (e) {
        console.log("Error:");
        console.log(e);
        return null;
    }
}