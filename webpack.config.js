const path = require("path");

module.exports = {
    resolve: {
        alias: {
            "@": path.resolve("resources/js"),
            "@r": path.resolve("resources"),
            "@p": path.resolve("public"),
        },
    },
};
