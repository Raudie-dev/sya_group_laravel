import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Colores base de la marca
                blue: "#0367a6",
                "blue-dark": "#025283",
                "blue-light": "#0480cc",
                orange: "#ff8c42",
                "orange-dark": "#e67a31",
                green: "#86bf30",
                "green-light": "#8ebf45",
                red: "#f24130",
                "red-dark": "#d13222",
                
                // Colores semánticos para notificaciones
                success: {
                    DEFAULT: "#86bf30",      // verde base
                    light: "#8ebf45",        // verde-light
                    dark: "#6b9926",          // tono más oscuro
                },
                error: {
                    DEFAULT: "#f24130",       // rojo base
                    light: "#f45f4f",          // rojo más claro
                    dark: "#d13222",            // rojo-dark
                },
                warning: {
                    DEFAULT: "#ff8c42",        // naranja base
                    light: "#ffa365",           // naranja más claro
                    dark: "#e67a31",             // naranja-dark
                },
                info: {
                    DEFAULT: "#0367a6",         // azul base
                    light: "#0480cc",            // azul-light
                    dark: "#025283",              // azul-dark
                },
            },
        },
    },
    plugins: [],
};