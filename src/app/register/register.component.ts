import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

  registerUserData;
  passwordMessage : string;
  userData;

  emailFormControl : FormControl;

  constructor(private _auth : AuthService){ 
    this.registerUserData = {};
    this.userData = {};
  }

  ngOnInit(){
    this.emailFormControl = new FormControl('', [
      Validators.required,
      Validators.email
    ]);
  }

  registerUser(){

    if(this.registerUserData.password == this.registerUserData.password_verify){
      this._auth.registerUser(this.registerUserData).subscribe(
        res => console.log(res), 
        err => console.log(err)
      );
    }else{
      this.passwordMessage = "Passwords must match.";
      return false;
      //console.log("No match");
    }
    
    console.log(this.registerUserData);
  }

}
