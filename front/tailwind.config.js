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
        "yellow" : "#C6C759",
        "white" : "#fff",
      }
    },
  },
  plugins: [],
}

