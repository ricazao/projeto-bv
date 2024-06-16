export default {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
        "postcss-sort-media-queries": {},
        "postcss-combine-duplicated-selectors": {
            removeDuplicatedProperties: true,
        },
    },
};
