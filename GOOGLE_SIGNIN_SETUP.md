# Google Sign In Setup Instructions

This guide will help you set up Google Sign In for the FurryTails application.

## Prerequisites

- Laravel Socialite package (already installed)
- Google Cloud Console account

## Step 1: Create Google OAuth Credentials

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Navigate to **APIs & Services** > **Credentials**
4. Click **Create Credentials** > **OAuth client ID**
5. Configure the OAuth consent screen if you haven't already:
   - Choose **External** user type
   - Fill in the required information (App name, user support email, etc.)
   - Add your email to test users during development
6. For Application type, select **Web application**
7. Set the following:
   - **Name**: FurryTails App (or any name you prefer)
   - **Authorized JavaScript origins**: `http://localhost` (for development)
   - **Authorized redirect URIs**: 
     - `http://localhost/auth/google/callback`
     - `http://localhost:8000/auth/google/callback` (if using `php artisan serve`)
     - Add your production URL when deploying (e.g., `https://yourdomain.com/auth/google/callback`)

8. Click **Create**
9. Copy the **Client ID** and **Client Secret**

## Step 2: Configure Your Application

1. Open your `.env` file
2. Add the following credentials (replace with your actual values):

```env
GOOGLE_CLIENT_ID=your-client-id-here.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-client-secret-here
GOOGLE_REDIRECT_URI=http://localhost/auth/google/callback
```

3. If you're using a different base URL, update `GOOGLE_REDIRECT_URI` accordingly

## Step 3: Update Authorized Domains (for Production)

When deploying to production:

1. Go back to Google Cloud Console > **APIs & Services** > **Credentials**
2. Edit your OAuth 2.0 Client ID
3. Add your production domain to:
   - **Authorized JavaScript origins**: `https://yourdomain.com`
   - **Authorized redirect URIs**: `https://yourdomain.com/auth/google/callback`
4. Update your `.env` file with production URLs

## How It Works

### User Flow

1. User clicks "Continue with Google" on the login page
2. User is redirected to Google's authentication page
3. User authorizes the application
4. Google redirects back to your application with user data
5. Application creates a new user or logs in existing user
6. User is redirected to dashboard (or admin dashboard if admin)

### New User Registration

When a user signs in with Google for the first time:
- Their Google profile information is used to create an account
- First name and last name are extracted from their Google name
- Username is automatically generated from their email
- Phone number will need to be updated later in account settings
- No password is required (OAuth users don't need passwords)

### Existing User Login

If a user already exists with the same email:
- They are logged in automatically
- Their `google_id` is saved for future logins
- Their avatar is updated with their Google profile picture

## Database Changes

The following columns were added to the `users` table:
- `google_id` - Stores the unique Google user identifier
- `avatar` - Stores the Google profile picture URL
- `password` - Now nullable to support OAuth users

## Security Notes

- **Never commit your `.env` file** - It contains sensitive credentials
- Keep your Client Secret secure
- Use HTTPS in production
- Regularly review authorized redirect URIs in Google Console
- Consider implementing email verification for OAuth users

## Troubleshooting

### "redirect_uri_mismatch" Error
- Ensure the redirect URI in your `.env` file exactly matches what's configured in Google Console
- Check for trailing slashes
- Verify the protocol (http vs https)

### "Access blocked" Error
- Add your email to test users in the OAuth consent screen (during development)
- Verify your app is not in production mode if still testing

### User Already Exists Error
- If a user registered with email/password and tries Google Sign In, they'll be linked automatically
- The system checks both `google_id` and `email` to find existing users

## Testing

1. Clear your browser cache and cookies
2. Visit `/login`
3. Click "Continue with Google"
4. Authorize the application
5. Verify you're redirected to the dashboard

## Additional Resources

- [Google OAuth 2.0 Documentation](https://developers.google.com/identity/protocols/oauth2)
- [Laravel Socialite Documentation](https://laravel.com/docs/socialite)
- [Google Cloud Console](https://console.cloud.google.com/)
