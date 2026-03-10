# Local HTTPS setup

The project is now configured to use:

- https://localhost/furrytails_project/public

## What was configured

- Apache virtual hosts were added for `localhost` on ports `80` and `443`
- A trusted local certificate was generated with `mkcert`
- Laravel `APP_URL` was changed to `https://localhost/furrytails_project/public`
- Session cookies were moved back to the default host-scoped behavior

## Final steps

1. Restart Apache from XAMPP Control Panel
2. Open:
   - https://localhost/furrytails_project/public
3. Clear old cookies for `localhost` and `furrytails.test` if login behaves strangely

## Google OAuth

The callback URL is now:

- https://localhost/furrytails_project/public/auth/google/callback

Add that exact URL to the Google Cloud OAuth client allowed redirect URIs.
