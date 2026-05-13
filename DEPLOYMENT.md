# Deployment Guide for Render

This Laravel application can be deployed to Render using Docker. Here are the step-by-step instructions.

## Prerequisites

1. **Render Account**: Sign up at [https://render.com](https://render.com)
2. **GitHub Repository**: Push your code to GitHub (Render integrates with GitHub for auto-deployment)
3. **Neon Database**: Your database is already on Neon (org-misty-grass-08174331, project summer-night-29514102)

## Step 1: Prepare Your Repository

1. Commit the new Docker files to your repository:
   ```bash
   git add Dockerfile .dockerignore render.yaml DEPLOYMENT.md
   git commit -m "Add Docker and Render configuration for deployment"
   git push origin feature/deployment
   ```

2. Make sure your `.env.example` is up-to-date with all required variables:
   ```bash
   git add .env.example
   git commit -m "Update .env.example"
   git push
   ```

## Step 2: Create a New Web Service on Render

1. Log in to [Render Dashboard](https://dashboard.render.com)
2. Click **"New +"** and select **"Web Service"**
3. Connect your GitHub account if you haven't already
4. Select your repository (`aura-studio-tuna-ecommerce`)
5. Choose the branch you want to deploy (e.g., `feature/deployment`)

## Step 3: Configure the Service

1. **Name**: Enter `aura-ecommerce-api`
2. **Runtime**: Select **"Docker"**
3. **Region**: Choose `Oregon` or your preferred region
4. **Plan**: Start with **"Standard"** ($12/month)
5. **Auto-deploy**: Enable it so deployments happen on every push
6. Click **"Create Web Service"**

## Step 4: Set Environment Variables

After creating the service, go to the **"Environment"** tab and add these variables:

| Key | Value |
|-----|-------|
| `APP_NAME` | `AURA E-Commerce` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_KEY` | *(Generate via `php artisan key:generate` locally, copy the base64 value)* |
| `DB_URL` | `postgresql://neondb_owner:npg_SvHEGuPn25YW@ep-restless-silence-apm4b1sa.c-7.us-east-1.aws.neon.tech/neondb?sslmode=require&channel_binding=require` |
| `DB_CONNECTION` | `pgsql` |
| `LOG_CHANNEL` | `stack` |
| `LOG_LEVEL` | `error` |
| `CACHE_STORE` | `database` |
| `QUEUE_CONNECTION` | `database` |
| `SESSION_DRIVER` | `database` |

## Step 5: Get Your App Key

If you don't have an APP_KEY:

```bash
# Locally
php artisan key:generate
# Copy the value from .env (it starts with "base64:...")
```

Then add it to the Render environment variables.

## Step 6: Monitor the Deployment

1. The build should start automatically after you create the service
2. Watch the **"Logs"** tab to see the build progress
3. The build will:
   - Install Composer dependencies
   - Run Laravel migrations (`php artisan migrate --force`)
   - Start the Apache server

## Step 7: Verify the Deployment

Once the service is deployed:

1. Go to the **"Settings"** tab and find your service URL (e.g., `https://aura-ecommerce-api.onrender.com`)
2. Test the health endpoint:
   ```bash
   curl https://aura-ecommerce-api.onrender.com/
   ```
3. Check logs if there are any issues in the **"Logs"** tab

## Common Issues & Fixes

### Issue: "Could not find driver" Error
- **Cause**: PHP extensions not installed
- **Fix**: The Dockerfile already includes `pdo_pgsql`. If the issue persists, check the build logs.

### Issue: Migrations Failed
- **Cause**: Database connection string issues or schema problems
- **Fix**: 
  1. Check that `DB_URL` is correctly set in environment variables
  2. View the build logs for the specific SQL error
  3. Run migrations locally first to debug: `php artisan migrate --force`

### Issue: Service Keeps Crashing (Spinning)
- **Cause**: Often a port binding issue or missing environment variables
- **Fix**:
  1. Verify all required environment variables are set
  2. Check logs for specific error messages
  3. Ensure `APP_KEY` is set (Laravel won't start without it)

### Issue: Static Assets Not Loading (if frontend is bundled)
- **Fix**: Run `npm run build` locally and commit the `public/build` directory, or add this to the Dockerfile build command

## Scaling and Optimization

Once your service is running:

1. **Enable Auto-Scaling**: In the service settings, enable "Autoscaling" to scale based on CPU/memory usage
2. **Upgrade Plan**: Move from Standard to Premium if you need higher performance
3. **Add Cron Jobs**: Use Render Cron Jobs for scheduled tasks (if needed)
4. **Database Optimization**: Monitor Neon database usage in the Neon console

## Deployment Workflow

After initial setup, deployments are automatic:

1. Make changes locally
2. Commit and push to GitHub
3. Render automatically triggers a new build
4. Service redeploys (no downtime with proper scaling)

## Next Steps

- **Frontend**: If you have a frontend (Vite), consider deploying it to Vercel or Netlify with your Render backend as the API
- **Monitoring**: Set up error tracking (e.g., Sentry) for production debugging
- **Backups**: Ensure Neon backups are enabled for your database
- **SSL/TLS**: Render provides free SSL certificates automatically

---

For more details on Render, visit: [https://render.com/docs](https://render.com/docs)
