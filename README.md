Plugin repository, which covers functonalities:
- adds CPT Book and Genre tax Task #3
- create dummy data for books to show the effects of the plugin
- covers adding custom js (Task #2) which also displays other books with AJAX (Task #4)
- adds Gutenberg dynamic FAQ block created with @wordpress/create-block base (Task #5)

Code divided into two repositories (this and https://github.com/okrezymon/twentytwentyfive-child).
I wanted to keep theme related changes in the child theme and added functionalites in this plugin repository. This way client can change the theme without loosing functionalities. 

How to launch this plugin? 

**Requirements**: 
- PHP >= 7.4 (8.0+ advised)
- WordPress >= 6.0
- Node.js >= 16 
- npm >= 8

**Installation**:
- clone the repository
- go into plugin folder
- run commands
  `npm install` or `composer install`

**Development workflow**
- `npm start` to watch
- `npm run build` to build production files
