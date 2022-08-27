const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        // "./node_modules/flowbite/**/*.js",
    ],

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("daisyui"),
        // require("flowbite/plugin"),
    ],

    daisyui: {
        styled: true,
        // themes: true,
        themes: [
            {
                gifdark: {
                    primary: "#dc2626",
                    secondary: "#f3f4f6",
                    accent: "#b91c1c",
                    neutral: "#ef4444",
                    "base-100": "#0f0f0f",
                    info: "#3D72F0",
                    success: "#84cc16",
                    warning: "#eab308",
                    error: "#ef4444",
                },
                giflight: {
                    primary: "#dc2626",
                    secondary: "#f3f4f6",
                    accent: "#b91c1c",
                    neutral: "#ef4444",
                    "base-100": "#fafafa",
                    info: "#3D72F0",
                    success: "#84cc16",
                    warning: "#eab308",
                    error: "#ef4444",
                },
            },
        ],
        base: true,
        utils: true,
        logs: true,
        rtl: false,
        prefix: "",
        darkTheme: "gifdark",
    },
};
