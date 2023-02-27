const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: 'jit',
  content: [
      "./app/Views/**/*.php",
      "./public/assets/scripts/**/*.js",
  ],
  theme: {
    fontFamily: {
      'sans': ['roboto', ...defaultTheme.fontFamily.sans]
    },
    extend: {
      colors: {
        'green': {
          light: '#43E89B',
          DEFAULT: '#1E9C61',
          hover: '#198251',
          dark: '#146941',
          darker: '#0F4E31',
        },
        'orange': {
          DEFAULT: '#E86E15',
        },
        'blue': {
          DEFAULT: '#2492DB',
        }
      },
      boxShadow: {
        'border': "rgba(99, 99, 99, 0.2) 0 2px 8px 0",
        'underlined': "rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px",
      },
      flexBasis: {
        '1/8': '12.5%',
      },
      transitionDuration: {
        '400': '400ms',
        '600': '600ms',
        '800': '800ms',
        '900': '900ms'
      },
      transitionTimingFunction: {
        'fill': 'cubic-bezier(.56,.41,.45,.82)'
      }
    },
  },
  plugins: [],
}
