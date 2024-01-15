/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {}
  },
  plugins: [
    'postcss-preset-env',
    require('tailwindcss'),
    require('autoprefixer'),
    require('@tailwindcss/typography'),
  ],
  purge: [
    './**/*.php',
    './assets/src/**/*.js'
  ]
}