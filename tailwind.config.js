const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors:{
                current: colors.current,
                transparent: colors.transparent,
                black: colors.black,
                white: colors.white,
                slate: colors.slate,
                gray: colors.trueGray,
                'gray-background': '#f7f8fc',
                'blue': '#328af1',
                'blue-hover': '#2879bd',
                'yellow': '#ffc73c',
                'red': '#ec454f',
                'green': '#1aab8b',
                'purple': '#8b60ed',
            },
            spacing: {
                70: '17.5rem',
                175: '43.75rem',
                44: '11rem'
            },
            maxWidth:{
                custom: '62.5rem'
            },
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
            },
            fontSize:{
                xxs: ['0.625rem', {lineHeight: '1rem'}]
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};
