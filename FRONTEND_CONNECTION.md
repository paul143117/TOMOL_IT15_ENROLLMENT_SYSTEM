# Connect Your Frontend to This Backend

## Backend URL
- **Base URL:** `http://127.0.0.1:8000`
- **API base URL:** `http://127.0.0.1:8000/api`

Run the backend with:
```bash
cd TOMOL_IT15_ENROLLMENT_SYSTEM
php artisan serve
```

## Login (fixes 404)

Use **one** of these endpoints from your React/frontend:

| Endpoint | Method | Body |
|----------|--------|------|
| `http://127.0.0.1:8000/api/login` | POST | `{ "email": "admin@example.com", "password": "password" }` |
| `http://127.0.0.1:8000/api/auth/login` | POST | Same |
| `http://127.0.0.1:8000/login`      | POST | Same |

**Success response (200):**
```json
{
  "user": { "id": 1, "name": "Admin", "email": "admin@example.com" },
  "token": "<long token string>",
  "token_type": "Bearer"
}
```

**Then send the token on every authenticated request:**
- Header: `Authorization: Bearer <token>`
- Get current user: `GET http://127.0.0.1:8000/api/user` (with that header)

## Register
- `POST http://127.0.0.1:8000/api/register` or `POST http://127.0.0.1:8000/register`
- Body: `{ "name": "Your Name", "email": "you@example.com", "password": "yourpassword", "password_confirmation": "yourpassword" }`

## Frontend config (e.g. React / axios)

1. **Base URL**  
   Set your API base to `http://127.0.0.1:8000` or `http://127.0.0.1:8000/api` depending on whether your paths include `/api` or not.

2. **Login request**  
   - URL: `/api/login` or `/login` (see table above)  
   - Method: POST  
   - Body: JSON `{ email, password }`  
   - Headers: `Content-Type: application/json`, `Accept: application/json`

3. **After login**  
   - Store the `token` (e.g. localStorage or state).  
   - For every request that requires auth, add header:  
     `Authorization: Bearer <token>`

4. **CORS**  
   Backend allows origin from `.env` `FRONTEND_URL` (default `http://localhost:3000`). If your app runs on another port, set `FRONTEND_URL` in `.env` and restart `php artisan serve`.

## Database
- Backend uses **SQLite** by default: `database/database.sqlite`
- To use **MySQL** instead: in `.env` set `DB_CONNECTION=mysql`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, then run `php artisan migrate --force`

## Test user
- **Email:** `admin@example.com`
- **Password:** `password`
