const path = require("path");

module.exports = {
    resolve: {
        alias: {
            "@": path.resolve("resources/js"),
            "@r": path.resolve("resources"),
            "@p": path.resolve("public"),
        },
    },
    output: {
        chunkFilename: "js/[name].js?id=[chunkhash]",
    },
};
