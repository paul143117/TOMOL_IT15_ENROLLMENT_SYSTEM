import React from 'react';
import { Mail, Lock } from 'lucide-react';
import './Login.css';

const Login = () => {
  return (
    <div className="login-page">
      <div className="login-card">
        
        {/* Left Section: Image */}
        <div className="image-container">
          <div className="inner-image-wrapper">
            <img 
              src="https://images.unsplash.com/photo-1509316785289-025f54846b4a?auto=format&fit=crop&q=80&w=1000" 
              alt="Aesthetic Desert" 
            />
          </div>
        </div>

        {/* Right Section: Form */}
        <div className="form-container">
          <h1 className="form-title">Login</h1>
          
          <form className="login-form">
            <div className="input-group">
              <label>Email</label>
              <div className="input-wrapper">
                <input type="email" placeholder="example@mail.com" />
                <Mail size={18} className="icon" />
              </div>
            </div>

            <div className="input-group">
              <label>Password</label>
              <div className="input-wrapper">
                <input type="password" placeholder="••••••••" />
                <Lock size={18} className="icon" />
              </div>
            </div>

            <button type="submit" className="login-btn">Login</button>
          </form>

          <div className="form-footer">
            <a href="#">Create an account</a>
            <a href="#">Forgot password</a>
          </div>
        </div>

      </div>
    </div>
  );
};

export default Login;