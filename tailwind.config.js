/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#C1121F', // merah utama (button, aksen, heading bar)
          dark:    '#8E0D17', // hover / state aktif
          light:   '#F7E4E6', // background section lembut (flat, bukan gradient)
        },
        ink:  '#111111',      // teks utama
        body: '#4B4B4B',      // teks paragraf
        line: '#E5E5E5',      // border / divider
        surface: '#FFFFFF',   // background kartu
        canvas:  '#F7F7F7',   // background section abu netral
      },
    },
  },
  plugins: [],
}
