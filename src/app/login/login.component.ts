import { Component, OnInit } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { AuthService } from '../auth.service';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  loginUserData;
  userData;
  constructor(private _auth : AuthService, private _route : Router) { 
    this.loginUserData = {};
    this.userData = {};
  }

  openDialog(): void{

  }

  ngOnInit() {
  }

  loginUser(){
    this._auth.loginUser(this.loginUserData).subscribe(
      res => {
        console.log(res)
        localStorage.setItem('email', res[0].email)
        this._route.navigate(['/dashboard'])
      },
      err => {
        console.log(err)
      }
    )
  }

}
