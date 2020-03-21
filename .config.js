module.exports = {
    "environment": process.env.NODE_ENV || "production",
    "imgPath": "./src/images",
    "fontPath": "./src/fonts",
    "jsPath": "./src/js",
    "jsAdminPath": "./src/js-admin",
    "sassPath": "./src/sass",
    "vendorPath": "./src/vendor",
    "destPath": "./assets",
    "devUrl": process.env.DEVELOPMENT_URL || "",
    "jsName": "minimal-md-theme.js",
    "jsNameMin": "minimal-md-theme.min.js",
    "vendor": {
        "sass": [
            './node_modules/bootstrap/scss'
        ],
        "css": [],
        "js": [
            './node_modules/bootstrap/dist/js/bootstrap.min.js'
        ],
        "fonts": []
    }
};
