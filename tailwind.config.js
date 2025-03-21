/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './template-parts/**/*.php',
    './templates/**/*.php',
    './*.php',
    './inc/**/*.php',
    './js/**/*.js'
  ],
  theme: {
    extend: {
      fontFamily: {
        'bangla': ['Noto Sans Bengali', 'Arial', 'sans-serif'],
      },
      colors: {
        'primary': '#1e73be',
        'primary-dark': '#0d47a1',
        'secondary': '#e53935',
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}