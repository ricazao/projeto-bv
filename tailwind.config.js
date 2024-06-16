import presetQuick from "franken-ui/shadcn-ui/preset-quick";

/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    presets: [presetQuick],
    theme: {
        extend: {},
    },
    plugins: [],
};
