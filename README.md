## How to Run
1. After cloning the project, please run "composer install" 
2. Then run this command for database migration: "php artisan migrate"

## Roles
1. There are two types of roles implemented in this application: admin and user. 
2. In registration page: I kept a select option for those roles so that both roles can be checked 

## Admin 
1. Admin can see all users posts and can update their status (Active or Inactive).
2. Admin can also delete and view posts

## User
1. User can create a post, initially it will be inactive in status. an admin must make it "active" in order to make it visible at the front page.
2. User can also create, update and delete his post.
3. User can see/modify his posts only. User can see other users posts from the front page, but from dashboard.

## API
The blog post list is processed using it's corresponding API, the API is protected using sanctum (token).

## Authentication
Laravel in build auth system is implemented. Middleware is used to process Auth. 
