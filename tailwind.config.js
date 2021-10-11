module.exports = {
  purge: {
    enabled: false,
    content: [
      '*.php',
      'includes/*.php'
    ],
    options: {
      keyframes: true, // removes unused keyframes
    }
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        'rucrypto': '#C436C7',
        'rucrypto-dark': '#89268B',
        'rucrypto-light': '#D672D8'
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
