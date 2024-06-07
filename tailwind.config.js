/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/tw-elements/dist/js/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                inter: "Inter, sans-serif",
            },
            colors: {
                "orange-primary": "#E55604",
                "dark-transparent": "rgba(0,0,0,0.3)",
            },
            boxShadow: {
                sidebar:
                    "23.72781px -2.37278px 71.18343px 0px rgba(0, 0, 0, 0.25)",
            },
        },
    },
    darkMode: "class",
    plugins: [require("tw-elements/dist/plugin.cjs")],
};
