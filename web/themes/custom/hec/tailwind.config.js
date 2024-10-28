/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './{templates,components}/**/*.{twig,js}'
  ],
  theme: {
    extend: {
      fontFamily: {
        'rubik-wet': '"Rubik Wet Paint", system-ui;'
      }
    }
  },
  plugins: [],
}

