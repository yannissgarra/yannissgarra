const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  mode: 'jit',
  purge: [
    './templates/**/*.html.twig',
    './assets/**/*.{js,vue}',
  ],
  darkMode: 'class',
  theme: {
    screens: {
      xs: '414px',
      ...defaultTheme.screens,
    },
    fontFamily: {
      sans: ['Inter', ...defaultTheme.fontFamily.sans],
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
