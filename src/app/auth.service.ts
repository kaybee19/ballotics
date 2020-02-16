import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private _loginUrl : string = "./api/user/login.php";
  //private _loginUrl : string = "http://127.0.0.1:80/ballotics/api/user/login.php";
  //private _registerUrl : string ="http://127.0.0.1:80/ballotics/api/user/register.php";
  private _registerUrl : string = "./api/user/register.php";

  constructor( private http : HttpClient) { }

  loginUser(user){
    return this.http.post<any>(this._loginUrl, user);
  }

  registerUser(user){
    return this.http.post<any>(this._registerUrl, user);
  }
  loggedIn(){
    return !!localStorage.getItem('email');
  }
}
