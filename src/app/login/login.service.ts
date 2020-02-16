import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  private __loginUrl : string;
  
  constructor(private http : HttpClient) {
    this.__loginUrl = "/api/user/login";
  }

  loginUser(user){
    //this.http.post(this.__loginUrl, user)
  }

}
