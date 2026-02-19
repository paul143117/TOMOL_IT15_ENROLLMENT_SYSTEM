import React, { useState } from 'react';
import './Login.css';

function App() {
  // State to track if password is shown or hidden
  const [showPassword, setShowPassword] = useState(false);

  // Function to toggle the state
  const togglePasswordVisibility = () => {
    setShowPassword(!showPassword);
  };

  return (
    <div className="login-page">
      <div className="login-card">
        
        <div className="image-container">
          <div className="inner-image-wrapper">
            <img 
              src="https://images.unsplash.com/photo-1614359833911-59722934003f?q=80&w=1000&auto=format&fit=crop" 
              alt="Pink Desert Landscape" 
            />
          </div>
        </div>

        <div className="form-container">
          <h1 className="form-title">Login</h1>
          
          <form className="login-form" onSubmit={(e) => e.preventDefault()}>
            {/* Email Field */}
            <div className="input-group">
              <label>Email</label>
              <div className="input-wrapper">
                <input type="email" placeholder="example@mail.com" />
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" className="icon"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
              </div>
            </div>

            {/* Password Field */}
            <div className="input-group">
              <label>Password</label>
              <div className="input-wrapper">
                {/* Type changes based on showPassword state */}
                <input 
                  type={showPassword ? "text" : "password"} 
                  placeholder="••••••••" 
                />
                
                {/* Clickable Icon */}
                <div onClick={togglePasswordVisibility} style={{ cursor: 'pointer', display: 'flex' }}>
                  {showPassword ? (
                    /* Eye Icon (Show) */
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" className="icon"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                  ) : (
                    /* Eye-Off Icon (Hide) - This matches your Figma lock style but for visibility */
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" className="icon"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                  )}
                </div>
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
}

export default App;