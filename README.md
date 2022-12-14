### Update

<h4>Changes Overview</h4>

<p>Clone option added to dropdown on main page</p>
<p>Clone functionality added using a new route which uses an activity ID like the edit page does. Form then posts to /store just as the create page does.</p>

<p>Test cases added for functionality and validation</p>

<p>Repeated code in ActivityController refactored.</p>
<p>Repeated code in the 3 views (create, edit and clone) refactored to use Blade Components instead</p>


### Original

This is a base install of Laravel 9 with a few custom routes, a controller, a model and some blade views.

The user interface lists "activity" and allows users to create new activity records or edit existing records. There is a migration and a seeder to create the database structure and some example data.

### Instructions
- Please create the ability for a user to "clone" an existing record, whilst being able to change any fields before saving
- Make any improvements to the code as you see fit
- If you run out of time, please write comments to describe what you would improve/change and how you would do it
- Commit your changes to your own repository as if it was a real project