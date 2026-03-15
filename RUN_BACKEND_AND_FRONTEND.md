# Where to run Backend vs Frontend

## 1. Backend (Laravel API)

**Folder:** `TOMOL_IT15_ENROLLMENT_SYSTEM` (this project root)

**Commands:**
```bash
cd C:\Users\nelyn\TOMOL_IT15_ENROLLMENT_SYSTEM
php artisan serve
```
- Server runs at **http://127.0.0.1:8000**
- Leave this terminal open while testing.

---

## 2. Option A – Test frontend (included here)

**Folder:** `TOMOL_IT15_ENROLLMENT_SYSTEM\frontend`

**Commands:**
1. Start the backend first (see above).
2. Open the login page:
   - Double‑click `frontend\index.html`, or
   - From repo root: `start frontend\index.html` (Windows), or
   - Drag `frontend\index.html` into your browser.

This page has:
- Login and **Create an account**
- **Password show/hide** (eye icon) on all password fields
- API base URL: `http://127.0.0.1:8000`

**Test login:** Email `admin@example.com`, Password `password`.

---

## 3. Option B – Your own React app (e.g. tomol-react-app)

**Frontend folder:** wherever your React app lives (e.g. `tomol-react-app` or another repo).

**To fix “Login failed (404)”:**

1. **Start the backend** from the Laravel project:
   ```bash
   cd C:\Users\nelyn\TOMOL_IT15_ENROLLMENT_SYSTEM
   php artisan serve
   ```

2. **Point your frontend to this backend:**
   - Set the API base URL to: **`http://127.0.0.1:8000`**
   - Login request must be one of:
     - `POST http://127.0.0.1:8000/api/login`
     - `POST http://127.0.0.1:8000/api/auth/login`
     - `POST http://127.0.0.1:8000/login`
   - Body (JSON): `{ "email": "admin@example.com", "password": "password" }`
   - Headers: `Content-Type: application/json`, `Accept: application/json`

3. **Where to set the base URL** (depends on your stack):
   - **Axios:** `axios.create({ baseURL: 'http://127.0.0.1:8000' })` then `axios.post('/api/login', { email, password })`
   - **Fetch:** `fetch('http://127.0.0.1:8000/api/login', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ email, password }) })`
   - **.env (Create React App / Vite):**  
     `REACT_APP_API_URL=http://127.0.0.1:8000` or `VITE_API_URL=http://127.0.0.1:8000`  
     Then in code: `const apiUrl = import.meta.env.VITE_API_URL || process.env.REACT_APP_API_URL;`

4. **Create account (register):**
   - `POST http://127.0.0.1:8000/api/register` or `POST http://127.0.0.1:8000/api/auth/register`
   - Body: `{ "name": "Your Name", "email": "you@example.com", "password": "yourpassword", "password_confirmation": "yourpassword" }`

5. **Password show/hide icon:**  
   In your React component, add state (e.g. `showPassword`) and a button that toggles it and switches the input type between `"password"` and `"text"`, and swap between “eye” and “eye-off” icons.

---

## 4. If you still get 404 or “Login failed”

- **Backend:** Run and leave running in **`TOMOL_IT15_ENROLLMENT_SYSTEM`** with `php artisan serve`.
- **Frontend:** Use one of the URLs above exactly (including `http://127.0.0.1:8000` and `/api/login` or `/api/auth/login`).
- **CORS:** Backend allows `FRONTEND_URL` from `.env` (default `http://localhost:3000`). If your app is on another origin, set `FRONTEND_URL` in `.env` and restart `php artisan serve`.
- **Quick check:** Open `frontend\index.html` in this repo with the backend running; if that works, the backend is fine and the issue is the URL or CORS in your React app.
