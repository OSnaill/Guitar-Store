/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        "black" : "#000000",
        "dark" : "#0F353E",
        "dark-yellow" : "#E0CE64",
        "white" : "#fff",
      }
    },
  },
  plugins: [],
}

