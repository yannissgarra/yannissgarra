module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  extends: [
    'airbnb-base',
    'plugin:vue/vue3-recommended',
  ],
  parser: 'vue-eslint-parser',
  parserOptions: {
    parser: '@babel/eslint-parser',
    requireConfigFile: false,
    ecmaVersion: 13,
    sourceType: 'module',
  },
  rules: {
    'no-param-reassign': ['error', {
      props: false,
    }],
    'import/no-extraneous-dependencies': ['error', {
      devDependencies: true,
    }],
    'max-len': 'off',
    'vue/max-len': ['error', {
      code: 120,
      template: 9000,
      ignoreComments: true,
      ignoreTemplateLiterals: true,
      ignoreUrls: true,
      ignoreStrings: true,
    }],
    'vue/max-attributes-per-line': 'off',
    'vue/singleline-html-element-content-newline': ['error', {
      ignoreWhenNoAttributes: false,
    }],
  },
};
