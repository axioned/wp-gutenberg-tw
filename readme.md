# AXIONED WordPress ACF - Gutenberg with Tailwind Boilerplate

## Prerequisites

- Node version 18.16+ ( If you have different node version use `nvm` and install the required version )
- Using WP CLI install the WP setup [Please refer Axioned starter repo](https://github.com/axioned/axioned-wordpress-starter)
- Clone this current theme repo and move to WP setup theme folder

## Project Config files Includes
- `package.json` File contains required dependencies for the webpack, to install run `npm install` from this theme directory
- `webpack.config.js` - This file compiles and minifies your CSS and JS file
- `tailwind.config.js` - This file contains Tailwind configuration for your project

---

## Folder structure to be followed.

*High level overview of file & folder Structure inside our theme folder*

    ├── function.php
    │
    ├── header.php
    │
    ├── footer.php
    │
    ├── home.php
    │   
    ├── functions
    │         ├── func-acf-options.php
    │         ├── func-config.php
    │         └── func-cpt.php
    │         
    │         
    ├── inc
    │   ├── blocks
    │   │     ├── content-banner.php
    │   │     ├── content-slider.php
    │   │     └── content-two-column-layout.php
    │   │     
    │   ├── partials
    │   │     └── content-button.php
    │   │
    │   └── template-parts
    │           ├──home
    │           │    ├── content-about-us.php
    │           │    ├── content-banner.php
    │           │    └── content-customer-reviews.php
    │           │
    │           └── modules
    │                ├── header
    │                │    ├── content-header-message.php
    │                │    └── content-primary-navigation.php
    │                │
    │                └──footer
    │                     ├── content-header-message.php
    │                     └── content-primary-navigation.php
    │ 
    ├── src
    │   ├── js
    │   │   ├── script.js
    │   │   └── main.js
    │   │ 
    │   └── tailwind
    │        ├── components
    │        │   └── button.css
    │        │
    │        ├── base.css
    │        ├── admin.css
    │        └── global.css
    │
    ├── build
    │       ├── js
    │       │   ├── script.min.js
    │       │   └── main.min.js
    │       │ 
    │       └── css
    │            ├── style.min.css
    │            └── style.min.css.map  
    │   
    │
    ├── assets
    │   ├── images
    │   │       └── image.[jpg|jpeg|png]
    │   │
    │   ├── icons
    │   │       └── image.svg
    │   │
    │   └──fonts
    │           └── sans.woff2
    │
    ├── webpack.config.js
    │
    ├── single-product.php
    │
    ├── taxonomy-product-category.php
    │
    └── Other folder and files


## Folder Structure and instruction
1. Change the name of the Axioned theme to the project theme and make any necessary name modifications in the code file.
2. Delete the `.gitignore and .git` file and folder from this theme folder
3. Change localhoast `folder-name` to your respective folder in webpack.config.js file
     ```js
        proxy: 'http://localhost/[folder-name]/',
        port: 3000,
        files: [
          './[folder-name]/wp-content/themes/*.php',
          './[folder-name]/wp-content/themes/*.js',
        ],
    ```
4. Change the ***axioned*** from function/hooks name to `project-name`
5. All the function file code is bifercated inside `functions` folder, Review the folder structure before starting
6. For creating/registering new blocks add code inside `functions/func-acf-block-register`
7. For Block development use `inc` folder and add global blocks code file inside `blocks` folder and for components use `partials` folder
8. For writing css and js use `src` folder and webpack will compile and add the minified code inside `build` folder
9. If you want to minify multiple js file add the path of file inside `entry` variable, For development use this `npm run dev` command and for production use `npm run build`, production command will minify the code
10. For adding base styling use `base.css` and for backend use `admin.css` for styling individual components create file inside components folder, and import the created file inside `global.css`


***Note:*** *Blocks/Pages/templateparts added on this theme are placeholder file change it with respect to projects*

### Reference

1. For webpack configuration you can refer below Youtube videos 
    - [Part One](https://youtu.be/6DknOk_NrG4?si=Nep_QHxmWQY7HoPh) 
    - [Part Two](https://youtu.be/TlJT5ZDWZSc?si=jx2-9ZRlUE0Hif9j) 
2. For using default Tailwind typography styling refer this [@tailwindcss/typography](https://tailwindcss.com/docs/typography-plugin) documentation
3. We can also modify the existing typography styling and create our own styling. For doing this please refer the above mentioned doc
