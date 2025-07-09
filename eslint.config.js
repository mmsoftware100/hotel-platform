export default [
  {
    files: ['resources/js/**/*.js'],
    languageOptions: {
      ecmaVersion: 2022,
      sourceType: 'module',
    },
    plugins: {
      import: require('eslint-plugin-import'),
      prettier: require('eslint-plugin-prettier'),
    },
    extends: [
      'eslint:recommended',
      'plugin:import/recommended',
      'plugin:prettier/recommended',
    ],
    rules: {
      'no-unused-vars': ['warn', { args: 'none', ignoreRestSiblings: true }],
      'no-console': 'warn',
      'import/order': ['warn', { 'newlines-between': 'always' }],
      'prettier/prettier': [
        'error',
        {
          semi: true,
          singleQuote: true,
          printWidth: 150,
          tabWidth: 4,
        },
      ],
    },
  },
];
