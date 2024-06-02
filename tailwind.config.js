/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    ...colors.gray,
                    DEFAULT: colors.gray['300'],
                },
                secondary: {
                    ...colors.gray,
                    DEFAULT: colors.gray['800']
                },
                tertiary : {
                    ...colors.orange,
                    DEFAULT: colors.orange['500']
                }
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
    darkMode: [
        'media'
    ]
};
