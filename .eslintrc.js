module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  extends: [
    'airbnb-base',
  ],
  parser: '@babel/eslint-parser',
  parserOptions: {
    requireConfigFile: false,
    ecmaVersion: 13,
    sourceType: 'module',
  },
  rules: {
    'max-len': ['error', { ignoreComments: true }],
  },
};
