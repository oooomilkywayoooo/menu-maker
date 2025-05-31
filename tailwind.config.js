/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.{blade.php,js}", "./node_modules/flowbite/**/*.js"],
  theme: {
    fontFamily: {
      Kiwi: ['Kiwi Maru', 'sans-serif'],
    },
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')  // ←これも追加！
  ],
}
