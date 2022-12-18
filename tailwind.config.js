const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./templates/**",
      "./public/assets/scripts/**/*.js",
  ],
  theme: {
    fontFamily: {
      'sans': ['futura-pt', ...defaultTheme.fontFamily.sans]
    },
    extend: {
      colors: {
        'green': {
          light: '#9CC9B3',
          DEFAULT: '#339966',
          dark: '#196E46'
        },
        'white': '#fff',
        'gray': {
          light: '#EFEFEF',
          DEFAULT: '#727272',
          dark: '#434343'
        },
        'error': {
          DEFAULT: '#DB243D'
        }
      }
    },
  },
  plugins: [],
}
